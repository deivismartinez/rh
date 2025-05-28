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
        $sql = "SELECT  CASE WHEN tipoexperiencia=1 THEN 'DOCENTE CATEDRATICO' WHEN tipoexperiencia=2 THEN 'DOCENTE TIEMPO COMPLETO' WHEN tipoexperiencia=3 THEN 'EXPERIENCIA PROFESIONAL' WHEN tipoexperiencia=4 THEN 'DOCENTE MEDIO TIEMPO' ELSE '' END ,institucion,cargo, fechainicio, fechafin,id,esupc FROM expcalificada where docenteid=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getExperienciaAdm($usuario) {
//        $sql = "SELECT  CASE WHEN tipoexperiencia=1 THEN 'DOCENTE CATEDRATICO' WHEN tipoexperiencia=2 THEN 'DOCENTE TIEMPO COMPLETO' WHEN tipoexperiencia=3 THEN 'EXPERIENCIA PROFESIONAL' WHEN tipoexperiencia=4 THEN 'DOCENTE MEDIO TIEMPO' ELSE '' END ,institucion,cargo, fechainicio, fechafin,id,(fechafin - fechainicio) as dias FROM expcalificada where docenteid=" . $usuario->getId() . ";";
        $sql = "SELECT  CASE WHEN tipoexperiencia=1 THEN 'DOCENTE CATEDRATICO' WHEN tipoexperiencia=2 THEN 'DOCENTE TIEMPO COMPLETO' WHEN tipoexperiencia=3 THEN 'EXPERIENCIA PROFESIONAL' WHEN tipoexperiencia=4 THEN 'DOCENTE MEDIO TIEMPO' ELSE '' END ,institucion,cargo, fechainicio, CASE WHEN fechafin is null THEN TO_DATE('2018/06/01','yyyy/mm/dd') ELSE fechafin end,id,(CASE WHEN fechafin is null THEN TO_DATE('2018/06/01','yyyy/mm/dd') ELSE fechafin end - fechainicio) as dias, CASE WHEN esupc is null then 'NO INFORMA' else esupc end,cualitativa, comentario FROM expcalificada where docenteid=" . $usuario->getId() . ";";
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
    
    public function getDatosCalificacion($id) {
        $sql = " SELECT id, nombre, titulo, fecharegistro, docente_id, usuario_id, programa_id, categoria, estudios,"
                . " experiencia, investigacion, publicaciones, usuario, comentarioestudio,"
                . " comentariocategoria, comentarioexperiencia, comentarioinvestigacion,"
                . " comentariopublicaciones FROM public.calificacion where docente_id=" . $id . ";";
        $datos = pg_query($this->db, $sql);
        require_once('../../Tablero/vo/CalificacionVO.php');
            $calificacion = new CalificacionVO();
        while ($row = pg_fetch_array($datos)) {
            $calificacion->setId($row['id']);
            $calificacion->setNombre($row['nombre']);
            $calificacion->settitulo($row['titulo']);
            $calificacion->setfecharegistro($row['fecharegistro']);
            $calificacion->setdocente_id($row['docente_id']);
            $calificacion->setusuario_id($row['usuario_id']);
            $calificacion->setprograma_id($row['programa_id']);
            $calificacion->setcategoria($row['categoria']);
            $calificacion->setestudios($row['estudios']);
            $calificacion->setexperiencia($row['experiencia']);
            $calificacion->setinvestigacion($row['investigacion']);
            $calificacion->setpublicaciones($row['publicaciones']);
            $calificacion->setusuario($row['usuario']);
            $calificacion->setcomentarioestudio($row['comentarioestudio']);
            $calificacion->setcomentariocategoria($row['comentariocategoria']);
            $calificacion->setcomentarioexperiencia($row['comentarioexperiencia']);
            $calificacion->setcomentarioinvestigacion($row['comentarioinvestigacion']);
            $calificacion->setcomentariopublicaciones($row['comentariopublicaciones']);
        }
        return $calificacion;
    }
    
    public function getDatosExperienciaModificar($id) {
        $sql = "SELECT CASE WHEN tipoexperiencia=1 THEN 'DOCENTE CATEDRATICO' WHEN tipoexperiencia=2 "
                . "THEN 'DOCENTE TIEMPO COMPLETO' WHEN tipoexperiencia=3 THEN 'EXPERIENCIA PROFESIONAL' ELSE '' END as tipo ,"
                . "institucion,cargo, direccion,telefono,correoe,fechainicio, fechafin,numeroperiodos, esupc FROM expcalificada where id=" . $id . ";";
        $datos = pg_query($this->db, $sql);
        require_once('../Tablero/vo/ExperienciaVO.php');
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
            $experiencia->setEsUpc($row['esupc']);
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
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO expcalificada(tipoexperiencia, institucion, numeroperiodos, "
                        . "fechainicio, fechafin, direccion, telefono, correoe, cargo, docenteid, "
                        . "fechacambio, actual,esupc) VALUES(".$tipoExperiencia.", '".$empresa."', ".$numeroPeriodos.", '"
                        .$fechaInicial."', '".$fechaFinalDtp."', '".$direccion."', '".$telefono."', '"
                        .$correo."', '".$cargo."', ".$usuarioId.", now(), 0,'NO'); select last_value from expcalificada_id_seq;";
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
            }else{
                header("Location: SoloPdf.php");
            }
        }else{
            $upcCmb = strtoupper(filter_input(INPUT_POST, 'upcCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            if($upcCmb == 'SI'){
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
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO expcalificada(tipoexperiencia, institucion, numeroperiodos, "
                        . "fechainicio, fechafin, direccion, telefono, correoe, cargo, docenteid, "
                        . "fechacambio, actual,esupc) VALUES(".$tipoExperiencia.", '".$empresa."', ".$numeroPeriodos.", '"
                        .$fechaInicial."', '".$fechaFinalDtp."', '".$direccion."', '".$telefono."', '"
                        .$correo."', '".$cargo."', ".$usuarioId.", now(), 0,'SI');";
                $oid = pg_query($this->db, $sql);
                header("Location: Experiencia.php");
                exit;
            }else{
            header("Location: FaltaAdjunto.php");
                exit;
            }
        }
    }
    
    public function actualizar() {
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
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
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
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE expcalificada SET tipoexperiencia=".$tipoExperiencia.", institucion='".$empresa."', numeroperiodos=".$numeroPeriodos.", "
                        . "fechainicio='".$fechaInicial."', fechafin='".$fechaFinalDtp."', direccion='"
                        .$direccion."', telefono='".$telefono."', correoe='".$correo."', cargo='".$cargo."', "
                        . "fechacambio=now(), actual=0,esupc='NO' WHERE id=".$idTraido.";";
                $oid = pg_query($this->db, $sql);
                $destino = "Soportes/exp" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Experiencia.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }else{
            $upcCmb = strtoupper(filter_input(INPUT_POST, 'upcCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            if($upcCmb == 'SI'){
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
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
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE expcalificada SET tipoexperiencia=".$tipoExperiencia.", institucion='".$empresa."', numeroperiodos=".$numeroPeriodos.", "
                        . "fechainicio='".$fechaInicial."', fechafin='".$fechaFinalDtp."', direccion='"
                        .$direccion."', telefono='".$telefono."', correoe='".$correo."', cargo='".$cargo."', "
                        . "fechacambio=now(), actual=0,esupc='SI' WHERE id=".$idTraido.";";
                $oid = pg_query($this->db, $sql);
                header("Location: Experiencia.php");
                exit;
            }else{
            header("Location: FaltaAdjunto.php");
                exit;
            }
        }
    }

    public function eliminarExperiencia($id,$idUsuario) {
        $sql = "DELETE FROM expcalificada where id=" . $id . " and docenteid=".$idUsuario.";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
}


