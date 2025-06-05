<?php
require_once("conectar.php");
require_once("helpers.php");
require_once $_SERVER['DOCUMENT_ROOT'] .'/rh/Tablero/vo/UsuarioVO.php';
///se dehabilitó porque da un warning de doble inicio de sesion
if (isset($_SESSION['usuario'])) {
///session_start();
}else{ session_start();}
class Estudios extends conectar {
    private $db;
    public function __construct() {
        $this->db = parent::conectar(); //parent p' hacer referencia a la clase padre
        parent::setNames();
    }

    public function getCursos($usuario) {
        $sql = "SELECT tipo,nombre,institucion,id FROM curso where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    // public function isCalificado($usuario) {
    //     $sql = "SELECT id FROM calificacion where estado='CALIFICADO' and docente_id=" . $usuario->getId() . ";";
    //     $datos = pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
    //     $arreglo = array();
    //     while ($row = pg_fetch_array($datos)) {
    //         return true;
    //     }
    //     return false;
    // }

    public function pertenecePregrado($id_docente='0', $idEstudio) {
        //$id = $usuario->getId();
        try{
        $sql = "SELECT id FROM pregrado where docente_id= " . $id_docente . " AND id=".$idEstudio.";";
        $datos = pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            return true;
        }
    }catch (Exception $error){

    }

        return false;
    }
    public function getPregrados($usuario) {
        $id = $usuario->getId();
        $sql = "SELECT 'PREGRADO' as tipo,nombre,institucion,id, cualitativa, comentario FROM pregrado where docente_id=" . $id . ";";
        $datos = pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getEspecializaciones($usuario) {
        $sql = "SELECT 'ESPECIALIZACIÓN' as tipo,titulo as nombre,institucion,id FROM especializacion where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getEspecializacionesNormales($usuario) {
        $sql = "SELECT 'ESPECIALIZACIÓN' as tipo,titulo as nombre,institucion,id,cualitativa,comentario FROM especializacion where docente_id=" . $usuario->getId() . " and tipo = 0;";
        $datos = pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getEspecializacionesEspeciales($usuario) {
        $sql = "SELECT 'ESPECIALIZACIÓN' as tipo,titulo as nombre,institucion,id, cualitativa, comentario FROM especializacion where docente_id=" . $usuario->getId() . " and tipo = 1;";
        $datos = pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getMaestrias($usuario) {
        $id = $usuario->getId();
        $sql = "SELECT 'MAESTRIA' as tipo,titulo as nombre,institucion,id, cualitativa, comentario FROM maestria where docente_id=" . $id . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getDoctorados($usuario) {
        $id = $usuario->getId();
        $sql = "SELECT 'DOCTORADO' as tipo,titulo as nombre,institucion,id, cualitativa, comentario FROM doctorado where docente_id=" . $id . ";";
        $datos = pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getDatosCursoId($id) {
        try {
            $sql = "SELECT tipo,nombre,institucion,duracionhoras,fechafin FROM curso where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setTipo($row['tipo']);
                $curso->setNombre($row['nombre']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['duracionhoras']);
                $curso->setFechaFin($row['fechafin']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosCursoIdModificar($id) {
        try {
            $sql = "SELECT tipo,nombre,institucion,duracionhoras,fechafin FROM curso where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setTipo($row['tipo']);
                $curso->setNombre($row['nombre']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['duracionhoras']);
                $curso->setFechaFin($row['fechafin']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }

    public function getDatosPregradoId($id) {
        try {
            $sql = "SELECT tipo,nombre,institucion,tarjetaprofesional,fechagrado, 
            id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
            FROM pregrado where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setTipo($row['tipo']);
                $curso->setNombre($row['nombre']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['tarjetaprofesional']);
                $curso->setFechaFin($row['fechagrado']);
                //id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
                $curso->setPais($row['id_pais_inst_estudio']);
                $curso->setConvalidado($row['tconvalidado']);
                $curso->setMetodologia($row['id_metodologia_p']); 
                $curso->setFechaIngreso($row['fecha_ingreso_p']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosPregradoIdActualizar($id) {
        try {
            $sql = "SELECT tipo,nombre,institucion,tarjetaprofesional,fechagrado,
            id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p 
            FROM pregrado where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setTipo($row['tipo']);
                $curso->setNombre($row['nombre']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['tarjetaprofesional']);
                $curso->setFechaFin($row['fechagrado']);
                //id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
                $curso->setPais($row['id_pais_inst_estudio']);
                $curso->setConvalidado($row['tconvalidado']);
                $curso->setMetodologia($row['id_metodologia_p']); 
                $curso->setFechaIngreso($row['fecha_ingreso_p']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosEspecializacionId($id) {
        try {
            $sql = "SELECT tipo,titulo,institucion,duracion,fechagrado,
            id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
             FROM especializacion where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setTipo($row['tipo']);
                $curso->setNombre($row['titulo']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['duracion']);
                $curso->setFechaFin($row['fechagrado']);
                 //id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
                 $curso->setPais($row['id_pais_inst_estudio']);
                 $curso->setConvalidado($row['tconvalidado']);
                 $curso->setMetodologia($row['id_metodologia_p']); 
                 $curso->setFechaIngreso($row['fecha_ingreso_p']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosEspecializacionIdModificar($id) {
        try {
            $sql = "SELECT tipo,titulo,institucion,duracion,fechagrado,
            id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
             FROM especializacion where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setTipo($row['tipo']);
                $curso->setNombre($row['titulo']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['duracion']);
                $curso->setFechaFin($row['fechagrado']);
                //id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
                $curso->setPais($row['id_pais_inst_estudio']);
                $curso->setConvalidado($row['tconvalidado']);
                $curso->setMetodologia($row['id_metodologia_p']); 
                $curso->setFechaIngreso($row['fecha_ingreso_p']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosMaestriaId($id) {
        try {
            $sql = "SELECT titulo,institucion,duracion,fechagrado,
            id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
            FROM maestria where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setNombre($row['titulo']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['duracion']);
                $curso->setFechaFin($row['fechagrado']);
                //id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
                $curso->setPais($row['id_pais_inst_estudio']);
                $curso->setConvalidado($row['tconvalidado']);
                $curso->setMetodologia($row['id_metodologia_p']); 
                $curso->setFechaIngreso($row['fecha_ingreso_p']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosMaestriaIdModificar($id) {
        try {
            $sql = "SELECT titulo,institucion,duracion,fechagrado,
            id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
             FROM maestria where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setNombre($row['titulo']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['duracion']);
                $curso->setFechaFin($row['fechagrado']);
                //id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
                $curso->setPais($row['id_pais_inst_estudio']);
                $curso->setConvalidado($row['tconvalidado']);
                $curso->setMetodologia($row['id_metodologia_p']); 
                $curso->setFechaIngreso($row['fecha_ingreso_p']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosDoctoradoId($id) {
        try {
            $sql = "SELECT titulo,institucion,duracion,fechagrado,
            id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
             FROM doctorado where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setNombre($row['titulo']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['duracion']);
                $curso->setFechaFin($row['fechagrado']);
                //id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
                $curso->setPais($row['id_pais_inst_estudio']);
                $curso->setConvalidado($row['tconvalidado']);
                $curso->setMetodologia($row['id_metodologia_p']); 
                $curso->setFechaIngreso($row['fecha_ingreso_p']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosDoctoradoIdModificar($id) {
        try {
            $sql = "SELECT titulo,institucion,duracion,fechagrado,
            id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
             FROM doctorado where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setNombre($row['titulo']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['duracion']);
                $curso->setFechaFin($row['fechagrado']);
                //id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p
                $curso->setPais($row['id_pais_inst_estudio']);
                $curso->setConvalidado($row['tconvalidado']);
                $curso->setMetodologia($row['id_metodologia_p']); 
                $curso->setFechaIngreso($row['fecha_ingreso_p']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }

    public function insertarCurso() {
//        if (isset($_SESSION['usuario'])) {
           $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
//        } else {
//            header('Location: AccesoNoautorizado.html');
//        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $tipoCurso = strtoupper(filter_input(INPUT_POST, 'tipoCursoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                ////////////////// cambia el estado de la calificacion si existe
                $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                ///////////////////
                $sql = "INSERT INTO curso(tipo, docente_id, nombre, institucion, duracionhoras, fechafin, fecharegistro, usuario) 
          VALUES('" . $tipoCurso . "', " . $usuarioId . ", '" . $nombre . "', '" . $institucion . "', "
                        . $duracion . ", '" . $fechaFinalizacion . "', now(), '" . $usuarioId . "'); select last_value from curso_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/ec" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Academica.php?" . $idCurso);
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function actualizarCurso() {
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $tipoCurso = strtoupper(filter_input(INPUT_POST, 'tipoCursoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE curso SET tipo='".$tipoCurso."', nombre='".$nombre."', institucion='"
                        .$institucion."', duracionhoras=".$duracion.", fechafin='".$fechaFinalizacion."' WHERE id =".$idTraido.";" ;
          
                $oid = pg_query($this->db, $sql);
               
                $destino = "Soportes/ec" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Academica.php?" . $idCurso);
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }

    public function insertarPregrado() {
        session_start();
        $id=0;
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $tipoPregrado = strtoupper(filter_input(INPUT_POST, 'tipoPregradoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $tarjeta = strtoupper(filter_input(INPUT_POST, 'tarjetaTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                ////Nuevos campos
                $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////////
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO 
                pregrado(tipo, docente_id, nombre, institucion, tarjetaprofesional, 
                        fechagrado, fecharegistro, usuario, id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p) 
          VALUES('" . $tipoPregrado . "', " . $usuarioId . ", '" . $nombre . "', '" . $institucion . "', '"
                        . $tarjeta . "', '" . $fechaFinalizacion . "', now(), '" . $usuarioId . "', ".$pais.", '".$convalidado."', ".$metodologia.", '".$fechaInicio."');
                         select last_value from pregrado_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idPregrado = $row[0];
                    break;
                }
                $destino = "Soportes/ep" . $idPregrado . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Academica.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    public function actualizarPregrado() {
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $tipoPregrado = strtoupper(filter_input(INPUT_POST, 'tipoPregradoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $tarjeta = strtoupper(filter_input(INPUT_POST, 'tarjetaTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                ////Nuevos campos
                $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////////
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE pregrado SET tipo = '".$tipoPregrado."', nombre ='".$nombre."', institucion='".$institucion."', tarjetaprofesional='".$tarjeta."',
                 fechagrado ='".$fechaFinalizacion."', id_pais_inst_estudio=".$pais.", tconvalidado='".$convalidado."', id_metodologia_p=".$metodologia.",
                 fecha_ingreso_p='".$fechaInicio."'  WHERE docente_id=".$id.";";  
                
                $oid = pg_query($this->db, $sql);
                
                $destino = "Soportes/ep" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Academica.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }else {
            $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $tipoPregrado = strtoupper(filter_input(INPUT_POST, 'tipoPregradoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $tarjeta = strtoupper(filter_input(INPUT_POST, 'tarjetaTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                ////Nuevos campos
                $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////////
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE pregrado SET tipo = '".$tipoPregrado."', nombre ='".$nombre."', institucion='".$institucion."', tarjetaprofesional='".$tarjeta."',
                 fechagrado ='".$fechaFinalizacion."', id_pais_inst_estudio=".$pais.", tconvalidado='".$convalidado."', id_metodologia_p=".$metodologia.",
                 fecha_ingreso_p='".$fechaInicio."'  WHERE docente_id=".$id.";";  
                
                $oid = pg_query($this->db, $sql);
                header("Location: Academica.php");
                exit;
        }
    }
    
    public function insertarEspecializacion() {
        session_start();
        $id=0;
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $tipoPregrado = strtoupper(filter_input(INPUT_POST, 'tipoEspecializacionCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                ////Nuevos campos
                $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////////
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO especializacion(tipo, docente_id, titulo, institucion, duracion, fechagrado, fecharegistro, usuario,
                id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p) 
          VALUES('" . $tipoPregrado . "', " . $usuarioId . ", '" . $nombre . "', '" . $institucion . "', "
                        . $duracion . ", '" . $fechaFinalizacion . "', now(), '" . $usuarioId . "', ".$pais.", '".$convalidado."', ".$metodologia.", '".$fechaInicio."'); select last_value from especializacion_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idEspecializacion = $row[0];
                    break;
                }
                $destino = "Soportes/ee" . $idEspecializacion . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Academica.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function actualizarEspecializacion() {
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $tipoPregrado = strtoupper(filter_input(INPUT_POST, 'tipoEspecializacionCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                ////Nuevos campos
                $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////////
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE especializacion SET tipo = '".$tipoPregrado."', titulo='".
                        $nombre."', institucion='".$institucion."', duracion=".$duracion.", fechagrado='".$fechaFinalizacion.
                        "', id_pais_inst_estudio=".$pais.", tconvalidado='".$convalidado."', id_metodologia_p=".$metodologia.",
                        fecha_ingreso_p='".$fechaInicio."' WHERE id = ".$idTraido.";" ;
          
                $oid = pg_query($this->db, $sql);
               
                $destino = "Soportes/ee" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Academica.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }else {
            $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
            $tipoPregrado = strtoupper(filter_input(INPUT_POST, 'tipoEspecializacionCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
            ////Nuevos campos
            $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
            ////////
            $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
            $usuarioId = $id;
            $status = "Archivo subido";
             ////////////////// cambia el estado de la calificacion si existe
             $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
             pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
             ///////////////////
             $sql = "UPDATE especializacion SET tipo = '".$tipoPregrado."', titulo='".
             $nombre."', institucion='".$institucion."', duracion=".$duracion.", fechagrado='".$fechaFinalizacion.
             "', id_pais_inst_estudio=".$pais.", tconvalidado='".$convalidado."', id_metodologia_p=".$metodologia.",
             fecha_ingreso_p='".$fechaInicio."' WHERE id = ".$idTraido.";" ;
      
            $oid = pg_query($this->db, $sql);
            header("Location: Academica.php");
                exit;
        }
    }
    
    public function insertarMaestria() {
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                ////Nuevos campos
                $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////////
                $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO maestria(docente_id, titulo, institucion, duracion, fechagrado, fecharegistro, usuario,
                id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p) 
          VALUES(" . $usuarioId . ", '" . $nombre . "', '" . $institucion . "', "
                . $duracion . ", '" . $fechaFinalizacion . "', now(), '" . $usuarioId . "', ".$pais.", '".$convalidado."', ".$metodologia.", '".$fechaInicio."'); select last_value from maestria_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idEspecializacion = $row[0];
                    break;
                }
                $destino = "Soportes/em" . $idEspecializacion . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Academica.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function actualizarMaestria() {
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                ////Nuevos campos
                $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////////
                $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE maestria SET titulo='".$nombre."', institucion='".$institucion
                        ."', duracion=".$duracion.", fechagrado='".$fechaFinalizacion.
                        "', id_pais_inst_estudio=".$pais.", tconvalidado='".$convalidado."', id_metodologia_p=".$metodologia.",
             fecha_ingreso_p='".$fechaInicio."' WHERE id=".$idTraido.";";
                $oid = pg_query($this->db, $sql);
               
                $destino = "Soportes/em" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Academica.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }else {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                ////Nuevos campos
                $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////////
                $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE maestria SET titulo='".$nombre."', institucion='".$institucion
                        ."', duracion=".$duracion.", fechagrado='".$fechaFinalizacion.
                        "', id_pais_inst_estudio=".$pais.", tconvalidado='".$convalidado."', id_metodologia_p=".$metodologia.",
             fecha_ingreso_p='".$fechaInicio."' WHERE id=".$idTraido.";";
                $oid = pg_query($this->db, $sql);
                header("Location: Academica.php");
                exit;

        }
    }
    
    public function insertarDoctorado() {
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////Nuevos campos
                $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////////
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO doctorado(docente_id, titulo, institucion, duracion, fechagrado, fecharegistro, usuario,
                id_pais_inst_estudio, tconvalidado, id_metodologia_p, fecha_ingreso_p) 
          VALUES(" . $usuarioId . ", '" . $nombre . "', '" . $institucion . "', "
                        . $duracion . ", '" . $fechaFinalizacion . "', now(), '" . $usuarioId . "', ".$pais.", '".$convalidado."', ".$metodologia.", '".$fechaInicio."'); select last_value from doctorado_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idEspecializacion = $row[0];
                    break;
                }
                $destino = "Soportes/ed" . $idEspecializacion . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Academica.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function actualizarDoctorado() {
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////Nuevos campos
                $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////////
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE doctorado SET titulo='".$nombre."', institucion='".$institucion
                        ."', duracion=".$duracion.", fechagrado='".$fechaFinalizacion."', id_pais_inst_estudio=".$pais.", tconvalidado='".$convalidado."', id_metodologia_p=".$metodologia.",
                        fecha_ingreso_p='".$fechaInicio."' WHERE id = ".$idTraido.";";
         
                $oid = pg_query($this->db, $sql);
                
                $destino = "Soportes/ed" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Academica.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }else {
            $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////Nuevos campos
                $convalidado = strtoupper(filter_input(INPUT_POST, 'convalidadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $pais = strtoupper(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $metodologia = strtoupper(filter_input(INPUT_POST, 'metodologiaPCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicio = filter_input(INPUT_POST, 'fechaInicioDte', FILTER_SANITIZE_SPECIAL_CHARS);
                ////////
                $usuarioId = $id;
                $status = "Archivo subido";
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE doctorado SET titulo='".$nombre."', institucion='".$institucion
                        ."', duracion=".$duracion.", fechagrado='".$fechaFinalizacion."', id_pais_inst_estudio=".$pais.", tconvalidado='".$convalidado."', id_metodologia_p=".$metodologia.",
                        fecha_ingreso_p='".$fechaInicio."' WHERE id = ".$idTraido.";";
         
                $oid = pg_query($this->db, $sql);
                header("Location: Academica.php");
                exit;
        }
    }
    
    public function eliminarPregrado($id) {

        $sql = "DELETE FROM pregrado where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }

    public function eliminarEspecializacion($id) {
        $sql = "DELETE FROM especializacion where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }

    public function eliminarMaestria($id) {
        $sql = "DELETE FROM maestria where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }

    public function eliminarDoctorado($id) {
        $sql = "DELETE FROM doctorado where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }

    public function eliminarCurso($id) {
        $sql = "DELETE FROM curso where id=" . $id . ";";
        pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    public function eliminarDatos() {
        $sql = "delete from usuarios
            where id='" . $_GET["id"] . "'";

        $this->db->query($sql);
    }
}