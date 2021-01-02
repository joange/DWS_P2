<?php
require_once('./classes/usuarios.php');
require_once('database.php');

class CrudUsuario {

    public function __construct(){

    }

    public function listarUsuarios(){
        echo "1";
        $db=Database::conectar(); 
        $users=[];
        $select=$db->query('SELECT * FROM usuarios');
        echo "2";
        foreach ($select->fetchAll() as $user) {
            echo "3";
            $usr= new Usuario(); 
            $usr->setId($user['id']); 
            $usr->setEmail($user['email']); 
            $usr->setPassword($user['password']); 
            
            $users[]=$usr;
            
        }

        return $users; 
    }

    public function existeEmail($user){
        $db=Database::conectar();
        $select=$db->prepare('SELECT * FROM `usuarios` WHERE email=:email');
        
        $select->bindValue(':email', $user->getEmail());
        $select->execute();
        $userBD=$select->fetch();

        if ($userBD==false)
            return false;
        else
            return true;
        
    }
    
    public function validaUsuario($user){

        $db=Database::conectar();
        $select=$db->prepare('SELECT * FROM `usuarios` WHERE email=:email and password=password(:pass)');
        
        $select->bindValue(':email', $user->getEmail());
        $select->bindValue(':pass', $user->getPassword());
        $select->execute();
        $userBD=$select->fetch();

        if ($userBD==false)
            return false;
        else
            return true;
        
    }

    
    public function deleteUsuario($user){
        $db=Database::conectar();
        $delete=$db->prepare('DELETE FROM usuarios WHERE id=:id'); 
        $delete->bindValue(':id', $user->getId);
        $delete->execute();
    }
    

    public function insertUsuario($user){
        $db=Database::conectar();
        $insert=$db->prepare('INSERT INTO usuarios(email,password) VALUES (:email,password(:pass))'); 
        $insert->bindValue(':email', $user->getEmail());
        $insert->bindValue(':pass', $user->getPassword());
        $insert->execute();
    }
    
}
?>