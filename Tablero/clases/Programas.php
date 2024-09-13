<?php

require_once("conectar.php");
require_once("helpers.php");

class Programas extends conectar {

    private $db;

    //crear nuestro constructor - metodo magico
    public function __construct() {
        $this->db = parent::conectar(); //parent p' hacer referencia a la clase padre
        parent::setNames();
    }

    public function getProgramaUsuario($usuario) {
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

        public function getEvaluador() {
        $sql = "SELECT  nombre, correo, facultad_id, tipo, estado, sede FROM usuario";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getProgramaUsuarioPerfil($usuario) {
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

    public function getProgramaUsuarioPerfilPost($usuario) {
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

    public function getFacultades() {
        $sql = "SELECT id,nombre FROM facultad;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getFacultadesDocentePostgrado() {                      ///// FACULTAD 3 ES LA UNICA QUE TIENE POSTGRADOS POR AHORA
        //$sql = "SELECT id,nombre FROM facultad where estado='ACTIVA'and id = ANY (ARRAY[3]);";
        $sql = "SELECT id,nombre FROM facultad where estado='ACTIVA'and posgrado=true";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getProgramasDocentePostgrado($facultad) {
        $sql = "SELECT id,nombre FROM programa where facultad_id=" . $facultad . " and nombre != '' and estado='ACTIVA' and postgrado=true";
        ///                                                    cambiar el 3 por $facultad
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getFacultadesDocente() {
        $sql = "SELECT id,nombre FROM facultad where estado='ACTIVA';";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getProgramas($facultad) {

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

    public function getProgramasVer() {
        $sql = "SELECT p.nombre,f.nombre, CASE when postgrado = 'true' then 'POSGRADO' else 'PREGRADO' end, p.id FROM programa p inner join facultad f on (p.facultad_id=f.id) order by p.id desc";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getFacultadVer() {
        $sql = "SELECT nombre,estado,CASE WHEN posgrado = 't' THEN 'Posgrado' WHEN posgrado = 'f' THEN 'Pregrado' END,id FROM facultad  order by id desc";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getProgramasJefe($facultad) {
        $sql = "SELECT id,nombre FROM programa where id=" . $facultad . " and nombre != '';";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getProgramasDocente($facultad) {
        $sql = "SELECT id,nombre FROM programa where facultad_id=" . $facultad . " and nombre != '' and estado='ACTIVA';";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getNombreArea($id) {
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

    public function existeInscripcion($id) {
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


       public function existeFacultad($facultad) {
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


      public function existeUsuario($usuario) {
        try {
            $sql = "SELECT usuario FROM usuario WHERE usuario='" . $usuario . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                 return true;
            }
        } catch (Exception $error) {
        
        }
         return false;
    }

    public function existeInscripcionPostgrado($id) {
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

    public function getAsignaturas($area) {
        $sql = "SELECT asignatura,asignatura FROM perfil where area1='" . $area . "';";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getAreas($departamento) {
        $sql = "SELECT DISTINCT ON (area1)area1, id FROM perfil where programa_id=" . $departamento . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function esPostgrados($id) {
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

    public function existeTresAreas($id) {
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

    public function existeInscripcionMismoDepartamento($id, $departamento) {
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

    public function existeInscripcionMismoDepPost($id, $departamento) {
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


     public function insertarEvaluador() {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $nombreCompletoTxt = strtoupper(filter_input(INPUT_POST, 'nombreCompletoTxt', FILTER_SANITIZE_SPECIAL_CHARS));
        $emailEml = strtoupper(filter_input(INPUT_POST, 'emailEml', FILTER_SANITIZE_SPECIAL_CHARS));
        $facultadCmb = strtoupper(filter_input(INPUT_POST, 'facultadCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $rolCmb = strtoupper(filter_input(INPUT_POST, 'rolCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $sedeCmb = strtoupper(filter_input(INPUT_POST, 'sedeCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        $usuarioTxt = strtoupper(filter_input(INPUT_POST, 'usuarioTxt', FILTER_SANITIZE_SPECIAL_CHARS));
        $seguridadTxt = strtoupper(filter_input(INPUT_POST, 'seguridadTxt', FILTER_SANITIZE_SPECIAL_CHARS));
        
        $sql = "INSERT INTO usuario(usuario, clave, nombre, correo, habilitado, facultad_id, tipo, estado, sede)" 
        ." VALUES('" . $usuarioTxt . "', '" . $seguridadTxt . "', '" . $nombreCompletoTxt . "', '" . $emailEml . "', '1', '" . $facultadCmb . "', '" . $rolCmb . "', 'ACTIVO', '" . $sedeCmb . "')";
            pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        
       header('Location: NewEvaluador.php');
        
    }

    public function insertar() {
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

    public function insertarProgPostgrado() {
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

    public function existeAreaPost($id, $idArea) {
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
    
    public function existProgram($name) {
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
    
    public function insertProgram() {
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
                        . " VALUES('".$nombrePrograma."', '".$facultadId."', 'ACTIVO','".$posgrado."')";
                $oid = pg_query($this->db, $sql);
                header("Location: NuevoPrograma.php");
                exit;
    }

    public function insertarArea($usuarioId, $docenteId, $idArea) {
        $sql = "INSERT INTO docenteperfil(perfil_id, docente_id, fecharegistro, usuario) VALUES(" . $idArea . ", " . $docenteId . ", now(), " . $usuarioId . ");";
        pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        ///cambia el estado de la calificacion a reevaluar
        $this->reevaluar($idUsuario);
        header("Location: Programa.php");
        exit;
    }

    public function insertarAreaPostgrado($programaId, $docenteId, $idArea) {
        $sql = "INSERT INTO docenteperfilposgrado(perfil_id, docente_id, fecharegistro, programa_id) VALUES(" . $idArea . ", " . $docenteId . ", now(), " . $programaId . ");";
        pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        ///cambia el estado de la calificacion a reevaluar
        $this->reevaluar($idUsuario);
        header("Location: ProgramaPostgrado.php");
        exit;
    }

    public function eliminarPrograma($idPrograma, $idUsuario) {
        $sql = "DELETE FROM docente_programa where programa_id=" . $idPrograma . " and docente_id=" . $idUsuario . ";";
        pg_query($this->db, $sql);
        $this->eliminarArea($idUsuario);
    }

    public function eliminarProgramaPostgrado($idPrograma, $idUsuario) {
        $sql = "DELETE FROM docente_programaposgrado where programa_id=" . $idPrograma . " and docente_id=" . $idUsuario . ";";
        pg_query($this->db, $sql);
        $this->eliminarAreaPostgrado($idUsuario);
    }

    public function eliminarAreaPostgrado($idUsuario) {
        $sql = "DELETE FROM docenteperfilposgrado where docente_id=" . $idUsuario . ";";
        pg_query($this->db, $sql);
        ///cambia el estado de la calificacion a reevaluar
        $this->reevaluar($idUsuario);
    }

    public function eliminarArea($idUsuario) {
        $sql = "DELETE FROM docenteperfil where docente_id=" . $idUsuario . ";";
        pg_query($this->db, $sql);
        ///cambia el estado de la calificacion a reevaluar
        $this->reevaluar($idUsuario);
    }

    public function reevaluar($id) {
        ////////////////// cambia el estado de la calificacion si existe para que sea reevaluada
        try {
            $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
            pg_query($this->db, $sql);
        } catch (SintaxError $e) {
            echo "9";
        }
        ///////////////////
    }
    
     public function insertArea() {
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
                        . "asignatura,perfil,fecharegistro,usuario,periodo_id) VALUES('GRUPO','".$area."', ".$idPrograma.",'','PERFIL',now(),".$usuarioId.",2);";
                pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                header("Location: NewArea.php");
                exit;
    }

}
