<?php

class CursoVO{
    private $tipo;
    private $nombre;
    private $institucion;
    private $duracion;
    private $fechaFin;
    
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
}