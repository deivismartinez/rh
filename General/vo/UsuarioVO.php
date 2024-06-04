<?php
class UsuarioVO{
    private $id;
    private $name;
    private $lastName;
    private $email;
    private $identidad;
    
    public function __construct(){}
    
    public function getIdentidad(){
        return $this->identidad;
    }
    public function setIdentidad($identidad){
        $this->identidad = $identidad;
    }
    
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
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
