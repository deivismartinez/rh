<?php

class PuntajesVO{
    private $especializacion;
    private $maestria;
    private $doctorado;
    private $categoria;
    private $nombreCategoria;
    private $expCatedratico;
    private $expMedioTiempo;
    private $expTiempoCompleto;
    private $expProfesional;
    private $grupo;
    private $categoriaInvestigador;
    private $libro;
    private $software;
    private $articulo;
    private $patente;
    
    public function __construct(){}
    
    public function getEspecializacion(){
        return $this->especializacion;
    }
    public function setEspecializacion($especializacion){
        $this->especializacion = $especializacion;
    }
    public function getMaestria(){
        return $this->maestria;
    }
    public function setMaestria($maestria){
        $this->maestria = $maestria;
    }
    public function getDoctorado(){
        return $this->doctorado;
    }
    public function setDoctorado($doctorado){
        $this->doctorado = $doctorado;
    }
    public function getCategoria(){
        return $this->categoria;
    }
    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }
    public function getNombreCategoria(){
        return $this->nombreCategoria;
    }
    public function setNombreCategoria($nombreCategoria){
        $this->nombreCategoria = $nombreCategoria;
    }
    
    public function setExpCatedratico($expCatedratico){
        $this->expCatedratico = $expCatedratico;
    }
    public function getExpCatedratico(){
        return $this->expCatedratico;
    }
    public function setExpMedioTiempo($expMedioTiempo){
        $this->expMedioTiempo = $expMedioTiempo;
    }
    public function getExpMedioTiempo(){
        return $this->expMedioTiempo;
    }
    public function setExpTiempoCompleto($expTiempoCompleto){
        $this->expTiempoCompleto = $expTiempoCompleto;
    }
    public function getExpTiempoCompleto(){
        return $this->expTiempoCompleto;
    }
    public function setExpProfesional($expProfesional){
        $this->expProfesional = $expProfesional;
    }
    public function getExpProfesional(){
        return $this->expProfesional;
    }
    public function setGrupo($grupo){
        $this->grupo = $grupo;
    }
    public function getGrupo(){
        return $this->grupo;
    }
    public function setCategoriaInvestigador($categoriaInvestigador){
        $this->categoriaInvestigador = $categoriaInvestigador;
    }
    public function getCategoriaInvestigador(){
        return $this->categoriaInvestigador;
    }
    public function getLibro(){
        return $this->libro;
    }
    public function setLibro($libro){
        $this->libro = $libro;
    }
    public function getSoftware(){
        return $this->software;
    }
    public function setSoftware($software){
        $this->software = $software;
    }
    public function getArticulo(){
        return $this->articulo;
    }
    public function setArticulo($articulo){
        $this->articulo = $articulo;
    }
    public function getPatente(){
        return $this->patente;
    }
    public function setPatente($patente){
        $this->patente = $patente;
    }
}
