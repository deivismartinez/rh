<?php

class CursoVO{
    private $tipo;
    private $nombre;
    private $institucion;
    private $duracion;
    private $fechaFin;
    ///
    private $pais;
    private $fechaIngreso;
    private $convalidado;
    private $metodologia;
    ///

    public function __construct(){}
    
    public function getTipo(){
        return $this->tipo;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getInstitucion(){
        return $this->institucion;
    }
    public function setInstitucion($institucion){
        $this->institucion = $institucion;
    }
    public function getDuracion(){
        return $this->duracion;
    }
    public function setDuracion($duracion){
        $this->duracion = $duracion;
    }
    public function getFechaFin(){
        return $this->fechaFin;
    }
    public function setFechaFin($fechaFin){
        $this->fechaFin = $fechaFin;
    }
    
    /**
     * Get the value of pais
     */ 
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set the value of pais
     *
     * @return  self
     */ 
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get the value of fechaIngreso
     */ 
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set the value of fechaIngreso
     *
     * @return  self
     */ 
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get the value of convalidado
     */ 
    public function getConvalidado()
    {
        return $this->convalidado;
    }

    /**
     * Set the value of convalidado
     *
     * @return  self
     */ 
    public function setConvalidado($convalidado)
    {
        $this->convalidado = $convalidado;

        return $this;
    }

    /**
     * Get the value of metodologia
     */ 
    public function getMetodologia()
    {
        return $this->metodologia;
    }

    /**
     * Set the value of metodologia
     *
     * @return  self
     */ 
    public function setMetodologia($metodologia)
    {
        $this->metodologia = $metodologia;

        return $this;
    }
}