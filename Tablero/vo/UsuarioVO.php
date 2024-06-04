<?php
class UsuarioVO{
    private $id;
    private $name;
    private $lastName;
    private $email;
    private $identidad;
    private $tipo;
    private $sede;
    
    public function __construct(){}
    
    public function getIdentidad(){
        return $this->identidad;
    }
    public function setIdentidad($identidad){
        $this->identidad = $identidad;
    }
    
    public function getSede(){
        return $this->sede;
    }
    public function setSede($sede){
        $this->sede = $sede;
    }
    
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }
    
    public function getTipo(){
        return $this->tipo;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    
    public function getLastName(){
        return $this->lastName;
    }
    public function setlastName($lastName){
        $this->lastName = $lastName;
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getMail(){
        return $this->email;
    }
    public function setMail($email){
        $this->email = $email;
    }
}
