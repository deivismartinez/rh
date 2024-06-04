<?php

class ExperienciaVO{
    private $tipo;
    private $institucion;
    private $cargo;
    private $correo;
    private $direccion;
    private $telefono;
    private $fechainicio;
    private $fechafin;
    private $numeroPeriodo;
    private $esupc;
    
    
    public function __construct(){}
    
    public function getTipo(){
        return $this->tipo;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    public function getInstitucion(){
        return $this->institucion;
    }
    public function setInstitucion($institucion){
        $this->institucion = $institucion;
    }
    public function getCargo(){
        return $this->cargo;
    }
    public function setCargo($cargo){
        $this->cargo = $cargo;
    }
    public function getCorreo(){
        return $this->correo;
    }
    public function setCorreo($correo){
        $this->correo = $correo;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }
    public function getFechainicio(){
        return $this->fechainicio;
    }
    public function setFechainicio($fechainicio){
        $this->fechainicio = $fechainicio;
    }
    public function getFechafin(){
        return $this->fechafin;
    }
    public function setFechafin($fechafin){
        $this->fechafin = $fechafin;
    }
    public function getNumeroPeriodos(){
        return $this->numeroPeriodo;
    }
    public function setNumeroPeriodos($numeroPeriodo){
        $this->numeroPeriodo = $numeroPeriodo;
    }
    public function getEsUpc(){
        return $this->esUpc;
    }
    public function setEsUpc($esupc){
        $this->esUpc = $esupc;
    }
}
