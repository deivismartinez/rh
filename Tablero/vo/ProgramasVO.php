<?php

class ProgramasVO 
{
    private $db;

    private $id;
    private $name;
    private $facultad_id;
    private $estado;
    private $posgrado;


    public function __construct()
    {
        
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getFacultad()
    {
        return $this->facultad_id;
    }
    public function setFacultad($facultad_id)
    {
        $this->facultad_id = $facultad_id;
    }

    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    
    public function getPosgrado()
    {
        return $this->posgrado;
    }
    public function setPosgrado($posgrado)
    {
        $this->posgrado = $posgrado;
    }
    

}