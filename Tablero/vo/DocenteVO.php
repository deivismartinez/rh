<?php

class DocenteVO{
    private $nombres;
    private $apellidos;
    private $tipoDocumento;
    private $numeroDocumento;
    private $email;
    private $estadoCivil;
    private $genero;
    private $pais;
    private $departamento;
    private $municipio;
    private $direccion;
    private $telefono;
    private $celular;
    private $fechaNacimiento;
    private $categoria;
    private $sede;
    private $disponibilidad;
    private $situacion;
    private $descripcion;
    private $cualitativa;
    private $comentario;
    
    public function __construct(){}
    
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    
    public function getCualitativa(){
        return $this->cualitativa;
    }
    public function setCualitativa($cualitativa){
        $this->cualitativa = $cualitativa;
    }
    
    public function getComentario(){
        return $this->comentario;
    }
    public function setComentario($comentario){
        $this->comentario = $comentario;
    }
    
    public function getDisponibilidad(){
        return $this->disponibilidad;
    }
    public function setDisponibilidad($disponibilidad){
        $this->disponibilidad = $disponibilidad;
    }
    
    public function getSituacion(){
        return $this->situacion;
    }
    public function setSituacion($situacion){
        $this->situacion = $situacion;
    }
    public function getNumeroDocumento(){
        return $this->numeroDocumento;
    }
    public function setNumeroDocumento($numeroDocumento){
        $this->numeroDocumento = $numeroDocumento;
    }
    public function getNombres(){
        return $this->nombres;
    }
    public function setNombres($nombres){
        $this->nombres = $nombres;
    }
    public function getApellidos(){
        return $this->apellidos;
    }
    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }
    public function getTipoDocumento(){
        return $this->tipoDocumento;
    }
    public function setTipoDocumento($tipoDocumento){
        $this->tipoDocumento = $tipoDocumento;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getEstadoCivil(){
        return $this->estadoCivil;
    }
    public function setEstadoCivil($estadoCivil){
        $this->estadoCivil = $estadoCivil;
    }
    public function getGenero(){
        return $this->genero;
    }
    public function setGenero($genero){
        $this->genero = $genero;
    }
    public function getPais(){
        return $this->pais;
    }
    public function setPais($pais){
        $this->pais = $pais;
    }
    public function getDepartamento(){
        return $this->departamento;
    }
    public function setDepartamento($departamento){
        $this->departamento = $departamento;
    }
    public function getMunicipio(){
        return $this->municipio;
    }
    public function setMunicipio($municipio){
        $this->municipio = $municipio;
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
    public function getCelular(){
        return $this->celular;
    }
    public function setCelular($celular){
        $this->celular = $celular;
    }
    public function getFechaNacimiento(){
        return $this->fechaNacimiento;
    }
    public function setFechaNacimiento($fechaNacimiento){
        $this->fechaNacimiento = $fechaNacimiento;
    }
    public function getCategoria(){
        return $this->categoria;
    }
    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }
    public function getSede(){
        return $this->sede;
    }
    public function setSede($sede){
        $this->sede = $sede;
    }
}
