<?php

class CalificacionVO{
    private $id;
    private $nombre;
    private $titulo;
    private $fecharegistro;
    private $docente_id;
    private $usuario_id;
    private $programa_id;
    private $categoria;
    private $estudios;
    private $experiencia;
    private $investigacion;
    private $publicaciones;
    private $usuario;
    private $comentarioestudio;
    private $comentariocategoria;
    private $comentarioexperiencia;
    private $comentarioinvestigacion;
    private $comentariopublicaciones;
    
    public function __construct(){}
    
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getestudios(){
        return $this->estudios;
    }
    public function setestudios($estudios){
        $this->estudios = $estudios;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function gettitulo(){
        return $this->titulo;
    }
    public function settitulo($titulo){
        $this->titulo = $titulo;
    }
    public function getfecharegistro(){
        return $this->fecharegistro;
    }
    public function setfecharegistro($fecharegistro){
        $this->fecharegistro = $fecharegistro;
    }
    public function getdocente_id(){
        return $this->docente_id;
    }
    public function setdocente_id($docente_id){
        $this->docente_id = $docente_id;
    }
    public function getusuario_id(){
        return $this->usuario_id;
    }
    public function setusuario_id($usuario_id){
        $this->usuario_id = $usuario_id;
    }
    public function getprograma_id(){
        return $this->programa_id;
    }
    public function setprograma_id($programa_id){
        $this->programa_id = $programa_id;
    }
    public function getcategoria(){
        return $this->categoria;
    }
    public function setcategoria($categoria){
        $this->categoria = $categoria;
    }
    public function getexperiencia(){
        return $this->experiencia;
    }
    public function setexperiencia($experiencia){
        $this->experiencia = $experiencia;
    }
    public function getinvestigacion(){
        return $this->investigacion;
    }
    public function setinvestigacion($investigacion){
        $this->investigacion = $investigacion;
    }
    public function getpublicaciones(){
        return $this->publicaciones;
    }
    public function setpublicaciones($publicaciones){
        $this->publicaciones = $publicaciones;
    }
    public function getusuario(){
        return $this->usuario;
    }
    public function setusuario($usuario){
        $this->usuario = $usuario;
    }
    public function getcomentarioestudio(){
        return $this->comentarioestudio;
    }
    public function setcomentarioestudio($comentarioestudio){
        $this->comentarioestudio = $comentarioestudio;
    }
    public function getcomentariocategoria(){
        return $this->comentariocategoria;
    }
    public function setcomentariocategoria($comentariocategoria){
        $this->comentariocategoria = $comentariocategoria;
    }
    public function getcomentarioexperiencia(){
        return $this->comentarioexperiencia;
    }
    public function setcomentarioexperiencia($comentarioexperiencia){
        $this->comentarioexperiencia = $comentarioexperiencia;
    }
    public function getcomentarioinvestigacion(){
        return $this->comentarioinvestigacion;
    }
    public function setcomentarioinvestigacion($comentarioinvestigacion){
        $this->comentarioinvestigacion = $comentarioinvestigacion;
    }
    public function getcomentariopublicaciones(){
        return $this->comentariopublicaciones;
    }
    public function setcomentariopublicaciones($comentariopublicaciones){
        $this->comentariopublicaciones = $comentariopublicaciones;
    }
}