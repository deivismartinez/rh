<?php

require_once("conectar.php");
require_once("helpers.php");

class Estudios extends conectar {

    private $db;

    //crear nuestro constructor - metodo magico
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

    public function getPregrados($usuario) {
        $id = $usuario->getId();
        $sql = "SELECT 'PREGRADO' as tipo,nombre,institucion,id FROM pregrado where docente_id=" . $id . ";";
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

    public function getMaestrias($usuario) {
        $id = $usuario->getId();
        $sql = "SELECT 'MAESTRIA' as tipo,titulo as nombre,institucion,id FROM maestria where docente_id=" . $id . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getDoctorados($usuario) {
        $id = $usuario->getId();
        $sql = "SELECT 'DOCTORADO' as tipo,titulo as nombre,institucion,id FROM doctorado where docente_id=" . $id . ";";
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

    public function getDatosPregradoId($id) {
        try {
            $sql = "SELECT tipo,nombre,institucion,tarjetaprofesional,fechagrado FROM pregrado where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setTipo($row['tipo']);
                $curso->setNombre($row['nombre']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['tarjetaprofesional']);
                $curso->setFechaFin($row['fechagrado']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosEspecializacionId($id) {
        try {
            $sql = "SELECT tipo,titulo,institucion,duracion,fechagrado FROM especializacion where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setTipo($row['tipo']);
                $curso->setNombre($row['titulo']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['duracion']);
                $curso->setFechaFin($row['fechagrado']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosMaestriaId($id) {
        try {
            $sql = "SELECT titulo,institucion,duracion,fechagrado FROM maestria where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setNombre($row['titulo']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['duracion']);
                $curso->setFechaFin($row['fechagrado']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosDoctoradoId($id) {
        try {
            $sql = "SELECT titulo,institucion,duracion,fechagrado FROM doctorado where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/CursoVO.php');
            $curso = new CursoVO();
            while ($row = pg_fetch_array($datos)) {
                $curso->setNombre($row['titulo']);
                $curso->setInstitucion($row['institucion']);
                $curso->setDuracion($row['duracion']);
                $curso->setFechaFin($row['fechagrado']);
                return $curso;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }

    public function insertarCurso() {
        require_once './vo/UsuarioVO.php';
        session_start();
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
                $tipoCurso = strtoupper(filter_input(INPUT_POST, 'tipoCursoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombre = strtoupper(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $institucion = strtoupper(filter_input(INPUT_POST, 'institucionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $duracion = strtoupper(filter_input(INPUT_POST, 'duracionNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
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
            }
        }
    }

    public function insertarPregrado() {
        require_once './vo/UsuarioVO.php';
        session_start();
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
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                $sql = "INSERT INTO pregrado(tipo, docente_id, nombre, institucion, tarjetaprofesional, fechagrado, fecharegistro, usuario) 
          VALUES('" . $tipoPregrado . "', " . $usuarioId . ", '" . $nombre . "', '" . $institucion . "', '"
                        . $tarjeta . "', '" . $fechaFinalizacion . "', now(), '" . $usuarioId . "'); select last_value from pregrado_id_seq;";
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
            }
        }
    }

    public function insertarEspecializacion() {
        require_once './vo/UsuarioVO.php';
        session_start();
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
                $fechaFinalizacion = filter_input(INPUT_POST, 'fechaFinalizacionDte', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarioId = $id;
                $status = "Archivo subido";
                $sql = "INSERT INTO especializacion(tipo, docente_id, titulo, institucion, duracion, fechagrado, fecharegistro, usuario) 
          VALUES('" . $tipoPregrado . "', " . $usuarioId . ", '" . $nombre . "', '" . $institucion . "', "
                        . $duracion . ", '" . $fechaFinalizacion . "', now(), '" . $usuarioId . "'); select last_value from especializacion_id_seq;";
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
            }
        }
    }
    
    public function insertarMaestria() {
        require_once './vo/UsuarioVO.php';
        session_start();
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
                $usuarioId = $id;
                $status = "Archivo subido";
                $sql = "INSERT INTO maestria(docente_id, titulo, institucion, duracion, fechagrado, fecharegistro, usuario) 
          VALUES(" . $usuarioId . ", '" . $nombre . "', '" . $institucion . "', "
                        . $duracion . ", '" . $fechaFinalizacion . "', now(), '" . $usuarioId . "'); select last_value from maestria_id_seq;";
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
            }
        }
    }
    
    public function insertarDoctorado() {
        require_once './vo/UsuarioVO.php';
        session_start();
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
                $usuarioId = $id;
                $status = "Archivo subido";
                $sql = "INSERT INTO doctorado(docente_id, titulo, institucion, duracion, fechagrado, fecharegistro, usuario) 
          VALUES(" . $usuarioId . ", '" . $nombre . "', '" . $institucion . "', "
                        . $duracion . ", '" . $fechaFinalizacion . "', now(), '" . $usuarioId . "'); select last_value from doctorado_id_seq;";
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
            }
        }
    }
    
    public function eliminarPregrado($id) {
        $sql = "DELETE FROM pregrado where id=" . $id . ";";
        pg_query($this->db, $sql);
    }

    public function eliminarEspecializacion($id) {
        $sql = "DELETE FROM especializacion where id=" . $id . ";";
        pg_query($this->db, $sql);
    }

    public function eliminarMaestria($id) {
        $sql = "DELETE FROM maestria where id=" . $id . ";";
        pg_query($this->db, $sql);
    }

    public function eliminarDoctorado($id) {
        $sql = "DELETE FROM doctorado where id=" . $id . ";";
        pg_query($this->db, $sql);
    }

    public function eliminarCurso($id) {
        $sql = "DELETE FROM curso where id=" . $id . ";";
        pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
    }

    public function eliminarDatos() {
        $sql = "delete from usuarios
            where id='" . $_GET["id"] . "'";

        $this->db->query($sql);
    }

}
?>

