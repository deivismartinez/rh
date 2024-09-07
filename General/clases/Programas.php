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
                $idPrograma = strtoupper(filter_input(INPUT_POST, 'programaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                $sql = "INSERT INTO docente_programa(docente_id, programa_id) VALUES(".$usuarioId.", ".$idPrograma.");";
                pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
               
                header("Location: Programa.php");
                exit;
    }
    
   

    public function eliminarPrograma($idPrograma,$idUsuario) {
        $sql = "DELETE FROM docente_programa where programa_id=" . $idPrograma . " and docente_id=".$idUsuario.";";
        pg_query($this->db, $sql);
    }
}


