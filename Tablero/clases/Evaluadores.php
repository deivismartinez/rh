<?php

require_once("conectar.php");
require_once("helpers.php");


class Evaluadores extends conectar {
    private $db;

    private $id;
    private $user;
    private $pass;
    private $name;
    private $email;
    private $programa;
    private $tipo;
    private $sede;

public function __construct() {
        $this->db = parent::conectar();
        parent::setNames();
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsuario()
    {
        return $this->user;
    }
    public function setUsuario($user)
    {
        $this->user = $user;
    }

    public function getPass()
    {
        return $this->pass;
    }
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getNombre()
    {
        return $this->name;
    }
    public function setNombre($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPrograma()
    {
        return $this->programa;
    }
    public function setPrograma($programa)
    {
        $this->programa = $programa;
    }

    public function getTipo()
    {
        return $this->tipo;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getSede()
    {
        return $this->sede;
    }
    public function setSede($sede)
    {
        $this->sede = $sede;
    }



public function getUnEvaluador($id)
    {
        $sql = "SELECT nombre, correo, nombre, tipo, estado, sede, id FROM usuario  where id=". $id ."";
        $datos = pg_query($this->db, $sql);
        //$arreglo = array();
        //while ($row = pg_fetch_array($datos)) {
          //  $arreglo[] = $row;
       // }
        //return $arreglo;

        $datosr = pg_fetch_assoc($datos);

        if ($datos) {
            $this->id = $datosr['id'];        // Heredado de UsuarioGetters
            $this->user = $datosr['nonmbrec'];  // Heredado de UsuarioGetters
            $this->pass = $datosr['correo'];    // Heredado de UsuarioGetters
            $this->name = $datosr['nombreb'];  // Heredado de UsuarioGetters
            $this->email = $datosr['tipo'];  // Heredado de UsuarioGetters
            $this->programa = $datosr['estado'];  // Heredado de UsuarioGetters
            $this->tipo = $datosr['sede'];  // Heredado de UsuarioGetters
    }
}
}

