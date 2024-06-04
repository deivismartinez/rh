<?php

class ArticuloVO{
    private $tipo;
    private $titulo;
    private $revista;
    private $autores;
    private $fechaPublicacion;
    private $issn;
    
    public function __construct(){}
    
    public function getTipo(){
        return $this->tipo;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    public function getTitulo(){
        return $this->titulo;
    }
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    public function getRevista(){
        return $this->revista;
    }
    public function setRevista($revista){
        $this->revista = $revista;
    }
    public function getAutores(){
        return $this->autores;
    }
    public function setAutores($autores){
        $this->autores = $autores;
    }
    public function getFechaPublicacion(){
        return $this->fechaPublicacion;
    }
    public function setFechaPublicacion($fechaPublicacion){
        $this->fechaPublicacion = $fechaPublicacion;
    }
    public function getIssn(){
        return $this->issn;
    }
    public function setIssn($issn){
        $this->issn = $issn;
    }
    
    
}

