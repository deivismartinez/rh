<?php

require_once("conectar.php");
require_once("helpers.php");

class Gestion extends conectar {

    private $db;

    public function __construct() {
        $this->db = parent::conectar();
        parent::setNames();
    }
    
    public function eliminarArticulo($id) {
        $sql = "DELETE FROM articulo where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    

    public function consultarSql() {

        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        
        $sql = strtoupper(filter_input(INPUT_POST, 'sql', FILTER_SANITIZE_SPECIAL_CHARS));
  
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }

    public function getGrupoAdmInv($usuario) {
        $sql = "SELECT categoria,nombregrupo,fechavinculacion,id FROM grupoinvestigacion where docenteid=" . $usuario->getId() . "  order by clasificacion limit 1;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function insertarPrograma_eliminar() {
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


        public function EditProgram($id) {
        ////////////////// actualiza 

            $facultadId = strtoupper(filter_input(INPUT_POST, 'facultadCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $nombrePrograma = strtoupper(filter_input(INPUT_POST, 'programTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $posgrado = strtoupper(filter_input(INPUT_POST, 'posgradoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
        try {
            $sql = "UPDATE programa SET nombre=".$nombrePrograma.", facultad_id=".$facultadId.", postgrado= ".$posgrado."  WHERE id =" . $id . ";";
            pg_query($this->db, $sql);
        } catch (SintaxError $e) {
            
        }
        ///////////////////
    }
    
    public function getNameProgramFacId($id) {
        $sql = "SELECT nombre,facultad_id FROM programa where id = $id";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function actualizarArticulo() {
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
                $tipoRevista = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $revista = strtoupper(filter_input(INPUT_POST, 'revistaTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $issn = strtoupper(filter_input(INPUT_POST, 'issnTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE articulo SET tipo='".$tipoRevista."', titulo='".$titulo."', revista='".$revista."', autores=".$numeroAutores
                        .", fechapublicacion='".$fechaPublicacion."', issn='".$issn."' WHERE id=".$idTraido.";";
                $oid = pg_query($this->db, $sql);
                $destino = "Soportes/art" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
   
    
}


