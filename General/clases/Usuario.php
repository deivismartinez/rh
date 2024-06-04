<?php

require_once("conectar.php");
require_once("helpers.php");

//require_once('../../Tablero/vo/UsuarioVO.php');

class Usuario extends conectar {

    private $db;

    //crear nuestro constructor - metodo magico
    public function __construct() {
        $this->db = parent::conectar(); //parent p' hacer referencia a la clase padre
        parent::setNames();
    }

    public function getDatos($login) {
        try {
            $sql = "SELECT id FROM docente where email='" . $login . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return $row['id'];
            }
        } catch (Exception $error) {
            
        }
        return null;
    }

    public function existeCorreo($correo) {
        try {
            $sql = "SELECT id FROM docente where email='" . $correo . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
            
        }
        return false;
    }
    
    public function existeIdentidad($identidad) {
        try {
            $sql = "SELECT id FROM docente where documentoidentidad='" . $identidad . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
            
        }
        return false;
    }
    
    public function getToken($correo) {
        try {
            $sql = "SELECT id as token FROM docente where email='" . $correo . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return sha1($row['token']);
            }
        } catch (Exception $error) {
            
        }
        return false;
    }

    public function validarUsuario($login, $pass) {
        try {
            $passe = sha1($pass);
            $sql = "SELECT id, nombre, correo, habilitado, facultad_id FROM usuario where usuario='" . $login . "' and clave = '" . $passe . "';";
            $datos = pg_query($this->db, $sql);
            require_once('../../General/vo/UsuarioVO.php');
            $usuario = new UsuarioVO();
            while ($row = pg_fetch_array($datos)) {
                $id = $row['id'];
                $name = $row['nombre'];
                $email = $row['correo'];
                $usuario->setId($id);
                $usuario->setName($name);
                $usuario->setMail($email);
                $usuario->setlastName($row['facultad_id']);
                return $usuario;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }

}
