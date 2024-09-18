<?php
class UsuarioVO
{
    private $id;
    private $user;
    private $pass;
    private $name;
    private $email;
    private $programa;
    private $tipo;
    private $sede;

    public function __construct() {}

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->identidad = $id;
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
}
