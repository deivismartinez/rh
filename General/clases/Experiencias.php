<?php

require_once("conectar.php");
require_once("helpers.php");

class Experiencias extends conectar {

    private $db;

    public function __construct() {
        $this->db = parent::conectar();
        parent::setNames();
    }

    public function getExperiencia($usuario) {
        $sql = "SELECT  CASE WHEN tipoexperiencia=1 THEN 'DOCENTE CATEDRATICO' WHEN tipoexperiencia=2 THEN 'DOCENTE TIEMPO COMPLETO' WHEN tipoexperiencia=3 THEN 'EXPERIENCIA PROFESIONAL' ELSE '' END ,institucion,cargo, fechainicio, fechafin,id FROM expcalificada where docenteid=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getDatosExperiencia($id) {
        $sql = "SELECT CASE WHEN tipoexperiencia=1 THEN 'DOCENTE CATEDRATICO' WHEN tipoexperiencia=2 "
                . "THEN 'DOCENTE TIEMPO COMPLETO' WHEN tipoexperiencia=3 THEN 'EXPERIENCIA PROFESIONAL' ELSE '' END as tipo ,"
                . "institucion,cargo, direccion,telefono,correoe,fechainicio, fechafin,numeroperiodos FROM expcalificada where id=" . $id . ";";
        $datos = pg_query($this->db, $sql);
        require_once('../../Tablero/vo/ExperienciaVO.php');
            $experiencia = new ExperienciaVO();
        while ($row = pg_fetch_array($datos)) {
            $experiencia->setTipo($row['tipo']);
            $experiencia->setInstitucion($row['institucion']);
            $experiencia->setCargo($row['cargo']);
            $experiencia->setDireccion($row['direccion']);
            $experiencia->setTelefono($row['telefono']);
            $experiencia->setCorreo($row['correoe']);
            $experiencia->setFechainicio($row['fechainicio']);
            $experiencia->setFechafin($row['fechafin']);
            $experiencia->setNumeroPeriodos($row['numeroperiodos']);
        }
        return $experiencia;
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
    
    public function getProgramas($facultad) {
        $sql = "SELECT id,nombre FROM programa where facultad_id=".$facultad.";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }


    public function insertar() {
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
                $empresa = strtoupper(filter_input(INPUT_POST, 'empresaTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $tipoExperiencia = strtoupper(filter_input(INPUT_POST, 'tipoExperienciaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $cargo = strtoupper(filter_input(INPUT_POST, 'cargoTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $direccion = strtoupper(filter_input(INPUT_POST, 'direccionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $telefono = strtoupper(filter_input(INPUT_POST, 'telefonoTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $correo = strtoupper(filter_input(INPUT_POST, 'correoTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaInicial = strtoupper(filter_input(INPUT_POST, 'fechaInicialDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaFinalDtp = strtoupper(filter_input(INPUT_POST, 'fechaFinalDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroPeriodos = strtoupper(filter_input(INPUT_POST, 'numeroPeriodosTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                $sql = "INSERT INTO expcalificada(tipoexperiencia, institucion, numeroperiodos, "
                        . "fechainicio, fechafin, direccion, telefono, correoe, cargo, docenteid, "
                        . "fechacambio, actual) VALUES(".$tipoExperiencia.", '".$empresa."', ".$numeroPeriodos.", '"
                        .$fechaInicial."', '".$fechaFinalDtp."', '".$direccion."', '".$telefono."', '"
                        .$correo."', '".$cargo."', ".$usuarioId.", now(), 0); select last_value from expcalificada_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/exp" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Experiencia.php");
                exit;
            }
        }
    }

    public function eliminarExperiencia($id,$idUsuario) {
        $sql = "DELETE FROM expcalificada where id=" . $id . " and docenteid=".$idUsuario.";";
        pg_query($this->db, $sql);
    }
}


