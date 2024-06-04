<?php

class PeriodoVO{
    private $fecha_apertura;
    private $fecha_cierre;
    private $periodo;
    
    
    public function __construct(){}
    
    public function getFecha_apertura(){
        return $this->fecha_apertura;
    }
    public function setFecha_apertura($fecha_apertura){
        $this->fecha_apertura = $fecha_apertura;
    }
    public function getFecha_cierre(){
        return $this->fecha_cierre;
    }
    public function setFecha_cierre($fecha_cierre){
        $this->fecha_cierre = $fecha_cierre;
    }
    
    public function getPeriodo(){
        return $this->periodo;
    }
    public function setPeriodo($periodo){
        $this->periodo = $periodo;
    }
    
}