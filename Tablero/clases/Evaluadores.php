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
    private $nameFacultad;
    private $namePrograma;

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
    public function getNameFaculad()
    {
        return $this->nameFacultad;
    }
    public function setNameFacultad($nameFacultad)
    {
        $this->nameFacultad = $nameFacultad;
    }
    public function getNamePrograma()
    {
        return $this->nameFacultad;
    }
    public function setNamePrograma($namePrograma)
    {
        $this->namePrograma = $namePrograma;
    }


public function getUnEvaluador($id)
    {
        $sql = "SELECT nombre, usuario, correo, tipo, estado, sede, id, clave, facultad_id FROM usuario  where id=". $id ."";
        $datos = pg_query($this->db, $sql);
        //$arreglo = array();
        //while ($row = pg_fetch_array($datos)) {
          //  $arreglo[] = $row;
       // }
        //return $arreglo;

        $datosr = pg_fetch_assoc($datos);

        if ($datosr) {
            $this->name = $datosr['nombre'];  // Heredado de UsuarioGetters
            $this->user = $datosr['usuario'];  // Heredado de UsuarioGetters
            $this->email = $datosr['correo'];  // Heredado de UsuarioGetters
            $this->tipo = $datosr['tipo'];  // Heredado de UsuarioGetters            
            $this->sede = $datosr['sede'];  // Heredado de UsuarioGetters
            $this->id = $datosr['id'];        // Heredado de UsuarioGetters           
            $this->pass = $datosr['clave'];    // Heredado de UsuarioGetters          
            $this->programa = $datosr['facultad_id'];  // Heredado de UsuarioGetters      
    }
}


public function getNameFacultadDepartatamento($idEvaluador)
{
    $sql = "SELECT f.nombre as facultad, p.nombre as programa  FROM programa AS p
        INNER JOIN facultad AS f ON f.id = p.facultad_id
        INNER JOIN usuario AS u ON u.facultad_id = p.id WHERE u.id=" . $idEvaluador . ";";
    $datos = pg_query($this->db, $sql);
    $datosr = pg_fetch_assoc($datos);

        if ($datosr) {
            $this->nameFacultad = $datosr['nombre'];  // Heredado de UsuarioGetters
            $this->namePrograma = $datosr['programa'];  // Heredado de UsuarioGetters
                
}
}
}