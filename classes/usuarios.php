<?php
class Usuario{
    private $id;
    private $email;
    private $password;


    function __construct(){}

    public function getId(){
        return $this->id;
    }
    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setId($id){
        $this->id=$id;
    }

    public function setEmail($email){
        $this->email=$email;
    }

    public function setPassword($password){
        $this->password=$password;
    }
}
?>