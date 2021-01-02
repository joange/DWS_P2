<?php
require_once('./classes/directores.php');
require_once('database.php');

class CrudDires {

    public function __construct(){ }

    public function getAllDirectores(){
       
        $db=Database::conectar(); 
        $dires=[];
        $select=$db->query('SELECT * FROM directores');
        foreach ($select->fetchAll() as $dire) {
            $dir= new Director(); 
            $dir->setId($dire['id']); 
            $dir->setNombre($dire['nombre']); 
            $dir->setAnyoNacimiento($dire['anyoNacimiento']); 
            $dir->setPais($dire['pais']); 
        
            $dires[]=$dir;
           
        }

        return $dires;  
    
    }

    public function getDirectorById($id){

        $db=Database::conectar(); 
        $select=$db->prepare('SELECT * FROM directores where id=:id');
        $select->bindValue(':id',$id);
        $select->execute();
        $dire=$select->fetch();

        if(!$dire){
            return null;
        }
        else{
            $dir= new Director(); 
            $dir->setId($dire['id']); 
            $dir->setNombre($dire['nombre']); 
            $dir->setAnyoNacimiento($dire['anyoNacimiento']); 
            $dir->setPais($dire['pais']); 
            
            return $dir;
        }
    
    }

    public function insertDirector($director){
        $db=Database::conectar();
        $insert=$db->prepare('INSERT INTO directores(nombre,anyoNacimiento,pais) VALUES (:nombre,:anyoNacimiento,:pais)'); 
        $insert->bindValue(':nombre', $director->getNombre());
        $insert->bindValue(':anyoNacimiento', $director->getAnyoNacimiento());
        $insert->bindValue(':pais', $director->getPais());
        return $insert->execute();
    }
    public function deleteDirector($id){
        $db=Database::conectar();
        $delete=$db->prepare('DELETE FROM directores WHERE id=:id'); 
        $delete->bindValue(':id', $id);
        return $delete->execute();
    }

    public function updateDirector($director){
        $db=Database::conectar();
        $update=$db->prepare('UPDATE directores SET nombre=:nombre,anyoNacimiento=:anyoNacimiento,pais=:pais WHERE id=:id'); 
        $update->bindValue(':id', $director->getId());
        $update->bindValue(':nombre', $director->getNombre());
        $update->bindValue(':anyoNacimiento', $director->getAnyoNacimiento());
        $update->bindValue(':pais', $director->getPais());
        return $update->execute();
    }

 
    
}

?>