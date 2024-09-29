<?php

require_once("conectar.php");
require_once("helpers.php");


class Programas extends conectar
{

    private $db;

    //crear nuestro constructor - metodo magico
    public function __construct()
    {
        $this->db = parent::conectar(); //parent p' hacer referencia a la clase padre
        parent::setNames();
    }

    public function getProgramaUsuario($usuario)
    {
        $sql = "SELECT facultad.nombre as facultad, programa.nombre as programa, programa_id "
            . "FROM docente_programa, programa, facultad where programa_id = programa.id and "
            . "facultad_id = facultad.id and docente_id =" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

   

    public function getEvaluador()
    {
        $sql = "SELECT   u.nombre, u.correo, p.nombre, u.tipo, u.estado, u.sede, u.id FROM usuario as u inner join programa as p on p.id =u.facultad_id";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;

        
    }

   

    public function getProgramaUsuarioPerfil($usuario)
    {
        $sql = "SELECT facultad.nombre as facultad, programa.nombre as programa, perfil.area1, docente_programa.programa_id "
            . " FROM docente_programa, programa, facultad, docenteperfil, perfil "
            . " where docenteperfil.docente_id = docente_programa.docente_id and docente_programa.programa_id = programa.id "
            . " and facultad_id = facultad.id and perfil.id = docenteperfil.perfil_id "
            . " and docente_programa.docente_id =" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getProgramaUsuarioPerfilPost($usuario)
    {
        $sql = "SELECT distinct facultad.nombre as facultad, programa.nombre as programa, perfil.area1, docente_programaposgrado.programa_id 
        FROM docente_programaposgrado, programa, facultad, docenteperfilposgrado, perfil 
        where docenteperfilposgrado.docente_id = docente_programaposgrado.docente_id and docenteperfilposgrado.programa_id=docente_programaposgrado.programa_id
        and docente_programaposgrado.programa_id = programa.id   
        and facultad_id = facultad.id and docenteperfilposgrado.perfil_id=perfil.id 
        and docente_programaposgrado.docente_id =" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getFacultades()
    {
        $sql = "SELECT id,nombre FROM facultad;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getFacultadesDocentePostgrado()
    {                      ///// FACULTAD 3 ES LA UNICA QUE TIENE POSTGRADOS POR AHORA
        //$sql = "SELECT id,nombre FROM facultad where estado='ACTIVA'and id = ANY (ARRAY[3]);";
        $sql = "SELECT id,nombre FROM facultad where estado='ACTIVA'and posgrado=true";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getProgramasDocentePostgrado($facultad)
    {
        $sql = "SELECT id,nombre FROM programa where facultad_id=" . $facultad . " and nombre != '' and estado='ACTIVA' and postgrado=true";
        ///                                                    cambiar el 3 por $facultad
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getFacultadesDocente()
    {
        $sql = "SELECT id,nombre FROM facultad where estado='ACTIVA';";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getProgramas($facultad)
    {

        $sql = "SELECT id,nombre FROM programa where ";
        if ($facultad == 0) {
            $sql = $sql . "nombre != '';";
        } else {
            $sql = $sql . "facultad_id=" . $facultad . " and nombre != '';";
        }
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getProgramasVer()
    {
        $sql = "SELECT p.nombre,f.nombre, CASE when postgrado = 'true' then 'POSGRADO' else 'PREGRADO' end, p.id FROM programa p inner join facultad f on (p.facultad_id=f.id) order by p.id desc";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getFacultadVer()
    {
        $sql = "SELECT nombre,estado,CASE WHEN posgrado = 't' THEN 'Posgrado' WHEN posgrado = 'f' THEN 'Pregrado' END,id FROM facultad  order by id desc";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getProgramasJefe($facultad)
    {
        $sql = "SELECT id,nombre FROM programa where id=" . $facultad . " and nombre != '';";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getProgramasDocente($facultad)
    {
        $sql = "SELECT id,nombre FROM programa where facultad_id=" . $facultad . " and nombre != '' and estado='ACTIVA';";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }


    
    public function getArea($facultad)
    {
        //$sql = "SELECT  DISTINCT f.nombre as nombre, p.area1 as area  FROM perfil as p inner join facultad as f on f.id=p.programa_id where facultad_id=" . $facultad . ";";
        $sql = "SELECT  DISTINCT f.nombre as nombre, p.area1 as area  FROM perfil as p inner join programa as f on f.id=p.programa_id where p.programa_id=" . $facultad . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getAsignatura($facultad, $area)
    {
        //$sql = "SELECT  DISTINCT f.nombre as nombre, p.area1 as area  FROM perfil as p inner join facultad as f on f.id=p.programa_id where facultad_id=" . $facultad . ";";
        $sql = "SELECT DISTINCT area1 as area, asignatura from perfil where area1='" . $area . "' and programa_id =" . $facultad . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getAreasPrograma($programa_id)
    {
        $sql = "SELECT SELECT DISTINCT ON (area1)area1, id FROM perfil where facultad_id=" . $programa_id . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getNombreArea($id)
    {
        try {
            $sql = "SELECT area1 FROM perfil where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return $row['area1'];
            }
        } catch (Exception $error) {
        }
        return '';
    }

    public function existeInscripcion($id)
    {
        try {
            $sql = "SELECT docente_id cantidad FROM docente_programa WHERE docente_id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
        }
        return false;
    }


    public function existeFacultad($facultad)
    {
        try {
            $sql = "SELECT nombre FROM facultad WHERE nombre='" . $facultad . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
        }
        return false;
    }


    public function existeUsuario($usuario)
    {
        try {
            $sql = "SELECT usuario FROM usuario WHERE usuario='" . $usuario . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
            return $error;
        }
        return false;
    }
    
      public function existeUsuarioExcluirPropio($usuario, $idusuario)
    {
        try {
            $sql = "SELECT usuario FROM usuario WHERE usuario='" . $usuario . "' and id != " . $idusuario . "  ;";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
            return $error;
        }
        return false;
    }

    public function existeInscripcionPostgrado($id)
    {
        try {
            $sql = "SELECT docente_id programa_id FROM docente_programaposgrado WHERE docente_id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
        }
        return false;
    }

    public function getAsignaturas($area)
    {
        $sql = "SELECT asignatura,asignatura FROM perfil where area1='" . $area . "';";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getAreas($departamento)
    {
        $sql = "SELECT DISTINCT ON (area1)area1, id FROM perfil where programa_id=" . $departamento . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function esPostgrados($id)
    {
        try {
            $sql = "SELECT id FROM docente where id = " . $id . " and sede = 'POSTGRADOS';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
        }
        return false;
    }

    public function existeTresAreas($id)
    {
        try {
            $sql = "SELECT count(docente_id) as cantidad FROM docenteperfil WHERE docente_id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                if ($row['cantidad'] > 2) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $error) {
        }
        return false;
    }

    public function existeInscripcionMismoDepartamento($id, $departamento)
    {
        try {
            $sql = "SELECT docente_id cantidad FROM docente_programa WHERE docente_id=" . $id . " and programa_id =" . $departamento . ";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
        }
        return false;
    }

    public function existeInscripcionMismoDepPost($id, $departamento)
    {
        try {
            $sql = "SELECT docente_id programa_id FROM docente_programaposgrado WHERE docente_id=" . $id . " and programa_id =" . $departamento . ";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
        }
        return false;
    }


    public function insertarEvaluador($nombreCompletoTxt, $emailEml, $programaCmb, $rolCmb, $sedeCmb, $usuarioTxt, $seguridadTxt)
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }

        $sql = "INSERT INTO usuario(usuario, clave, nombre, correo, habilitado, facultad_id, tipo, estado, sede)"
            . " VALUES('" . $usuarioTxt . "', '" . $seguridadTxt . "', '" . $nombreCompletoTxt . "', '" . $usuarioTxt . "', '1', '" . $programaCmb . "', '" . $rolCmb . "', 'ACTIVO', '" . $sedeCmb . "')";
        pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());

        //header('Location: NewEvaluador.php');

    }



    public function updateEvaluador($nombreCompletoTxt, $programaCmb, $rolCmb, $sedeCmb, $usuarioTxt, $idEvaluador, $estadoCmb)
    {
        
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }

        $sql = "UPDATE usuario SET nombre = '" . $nombreCompletoTxt . "', usuario = '" . $usuarioTxt . "' , facultad_id = '" . $programaCmb . "' , tipo = '" . $rolCmb . "' ,  sede = '" . $sedeCmb . "' ,  habilitado = '" . $estadoCmb . "' WHERE id = " . $idEvaluador . " ";
          // $sql = "UPDATE usuario SET nombre = 'hola8'  WHERE id =291";
              // $sql = "UPDATE usuario SET nombre = '" . $nombreCompletoTxt . "', usuario = '" . $usuarioTxt . "', facultad_id = '" . $programaCmb . "' , tipo = '" . $rolCmb . "' ,
                 //   tipo = '" . $rolCmb . "', 
                 //  sede = '" . $sedeCmb . "' 
             //   WHERE id = " . $idEvaluador . " ";
               
        pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
       
      

    }

    

    public function insertar()
    {
        require_once './vo/UsuarioVO.php';
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $idPrograma = strtoupper(filter_input(INPUT_POST, 'programaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $idArea = strtoupper(filter_input(INPUT_POST, 'areasCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $usuarioId = $id;
        if ($this->existeInscripcion($id)) {
            if ($this->existeInscripcionMismoDepartamento($id, $idPrograma)) {
            } else {
                header('Location: OtroDepartamento.php');
                exit;
            }
        } else {
            $sql = "INSERT INTO docente_programa(docente_id, programa_id) VALUES(" . $usuarioId . ", " . $idPrograma . ");";
            pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        }
        $this->insertarArea($usuarioId, $usuarioId, $idArea);
        header("Location: Programa.php");
        exit;
    }

    public function insertarProgPostgrado()
    {
        require_once './vo/UsuarioVO.php';
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $idPrograma = strtoupper(filter_input(INPUT_POST, 'programaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $idArea = strtoupper(filter_input(INPUT_POST, 'areasCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $usuarioId = $id;
        //if($this->existeInscripcionPostgrado($id)){
        if ($this->existeAreaPost($id, $idArea)) {


            header('Location: AreaYaInscrita.php');
            exit;
        } else {
            $sql = "INSERT INTO docente_programaposgrado(docente_id, programa_id) VALUES(" . $usuarioId . ", " . $idPrograma . ");";
            pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());

            $this->insertarAreaPostgrado($idPrograma, $usuarioId, $idArea);

            header("Location: ProgramaPostgrado.php");
            exit;
        }
    }

    public function existeAreaPost($id, $idArea)
    {
        try {
            $sql = "SELECT docente_id FROM docenteperfilposgrado WHERE perfil_id=" . $idArea . " and docente_id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
        }
        return false;
    }

    public function existProgram($name)
    {
        try {
            $sql = "SELECT nombre FROM programa WHERE nombre='" . $name . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
        }
        return false;
    }

    public function existArea($name, $programa_id)
    {
        try {
            $sql = "SELECT area1 FROM perfil WHERE area1='" . $name . "' and programa_id = " . $programa_id . ";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
        }
        return false;
    }

    public function existAsignatura($name, $area, $programa_id)
    {
        try {
            $areaName = $this->getNombreArea($area);
            $sql = "SELECT area1 FROM perfil WHERE asignatura='" . $name . "' and programa_id = " . $programa_id . " and area1 = '" . $areaName . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
        }
        return false;
    }

    public function insertNewArea()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $area = strtoupper(filter_input(INPUT_POST, 'areaTxt', FILTER_SANITIZE_SPECIAL_CHARS));
        $programaId = strtoupper(filter_input(INPUT_POST, 'programaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $sql = "INSERT INTO perfil(grupo, area1,programa_id, asignatura, perfil, fecharegistro, usuario, periodo_id) "
            . " VALUES('GRUPO', '" . $area . "'," . $programaId . ",'','PERFIL',now(),1,2)";
        $oid = pg_query($this->db, $sql);
        header("Location: NewArea.php");
        exit;
    }

    public function insertNewSubject()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $area_id = strtoupper(filter_input(INPUT_POST, 'areasCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $asignatura = strtoupper(filter_input(INPUT_POST, 'asignaturaTxt', FILTER_SANITIZE_SPECIAL_CHARS));
        $programa_id = strtoupper(filter_input(INPUT_POST, 'programaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $area = $this->getNombreArea($area_id);
        $idEmpty = $this->getIdArea($area, $programa_id);
        if ($idEmpty == 0) {
            $sql = "INSERT INTO perfil(grupo, area1,programa_id, asignatura, perfil, fecharegistro, usuario, periodo_id) "
                . " VALUES('GRUPO', '" . $area . "'," . $programa_id . ",'" . $asignatura . "','PERFIL',now(),1,2)";
        } else {
            $sql = "UPDATE perfil set asignatura = '" . $asignatura . "' where id=" . $idEmpty . ";";
        }
        $oid = pg_query($this->db, $sql);
        header("Location: NuevoPrograma.php");
        exit;
    }

    public function getIdArea($area, $programa_id)
    {
        try {
            $sql = "SELECT id FROM perfil where area1='" . $area . "' and programa_id = " . $programa_id . " and asignatura = '' limit 1;";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return $row['id'];
            }
        } catch (Exception $error) {
        }
        return 0;
    }

    public function insertProgram()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $facultadId = strtoupper(filter_input(INPUT_POST, 'facultadCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $nombrePrograma = strtoupper(filter_input(INPUT_POST, 'programTxt', FILTER_SANITIZE_SPECIAL_CHARS));
        $posgrado = strtoupper(filter_input(INPUT_POST, 'posgradoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $usuarioId = $id;
        $sql = "INSERT INTO programa(nombre, facultad_id, estado, postgrado) "
            . " VALUES('" . $nombrePrograma . "', '" . $facultadId . "', 'ACTIVO','" . $posgrado . "')";
        $oid = pg_query($this->db, $sql);
        header("Location: NuevoPrograma.php");
        exit;
    }

    public function insertarArea($usuarioId, $docenteId, $idArea)
    {
        $sql = "INSERT INTO docenteperfil(perfil_id, docente_id, fecharegistro, usuario) VALUES(" . $idArea . ", " . $docenteId . ", now(), " . $usuarioId . ");";
        pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        ///cambia el estado de la calificacion a reevaluar
        $this->reevaluar($idUsuario);
        header("Location: Programa.php");
        exit;
    }

    public function insertarAreaPostgrado($programaId, $docenteId, $idArea)
    {
        $sql = "INSERT INTO docenteperfilposgrado(perfil_id, docente_id, fecharegistro, programa_id) VALUES(" . $idArea . ", " . $docenteId . ", now(), " . $programaId . ");";
        pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        ///cambia el estado de la calificacion a reevaluar
        $this->reevaluar($idUsuario);
        header("Location: ProgramaPostgrado.php");
        exit;
    }

    public function eliminarPrograma($idPrograma, $idUsuario)
    {
        $sql = "DELETE FROM docente_programa where programa_id=" . $idPrograma . " and docente_id=" . $idUsuario . ";";
        pg_query($this->db, $sql);
        $this->eliminarArea($idUsuario);
    }

    public function eliminarProgramaPostgrado($idPrograma, $idUsuario)
    {
        $sql = "DELETE FROM docente_programaposgrado where programa_id=" . $idPrograma . " and docente_id=" . $idUsuario . ";";
        pg_query($this->db, $sql);
        $this->eliminarAreaPostgrado($idUsuario);
    }

    public function eliminarAreaPostgrado($idUsuario)
    {
        $sql = "DELETE FROM docenteperfilposgrado where docente_id=" . $idUsuario . ";";
        pg_query($this->db, $sql);
        ///cambia el estado de la calificacion a reevaluar
        $this->reevaluar($idUsuario);
    }

    public function eliminarArea($idUsuario)
    {
        $sql = "DELETE FROM docenteperfil where docente_id=" . $idUsuario . ";";
        pg_query($this->db, $sql);
        ///cambia el estado de la calificacion a reevaluar
        $this->reevaluar($idUsuario);
    }

    public function reevaluar($id)
    {
        ////////////////// cambia el estado de la calificacion si existe para que sea reevaluada
        try {
            $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
            pg_query($this->db, $sql);
        } catch (Error $e) {
            echo "9";
        }
        ///////////////////
    }

    public function insertArea()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $area = strtoupper(filter_input(INPUT_POST, 'areaTxt', FILTER_SANITIZE_SPECIAL_CHARS));
        $idPrograma = strtoupper(filter_input(INPUT_POST, 'programaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $usuarioId = $id;
        $sql = "INSERT INTO perfil(grupo,area1,programa_id,"
            . "asignatura,perfil,fecharegistro,usuario,periodo_id) VALUES('GRUPO','" . $area . "', " . $idPrograma . ",'','PERFIL',now()," . $usuarioId . ",2);";
        pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        header("Location: NewArea.php");
        exit;
    }
}
