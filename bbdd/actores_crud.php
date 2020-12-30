<?php
require_once('./classes/actores.php');
require_once('database.php');

class CrudActores {

    public function __construct(){

    }

    public function getAllActores(){
       
        $db=Database::conectar(); 
        $actores=[];
        $select=$db->query('SELECT * FROM actores');
        foreach ($select->fetchAll() as $actor) {
            $act= new Actor(); 
            $act->setId($actor['id']); 
            $act->setNombre($actor['nombre']); 
            $act->setAnyoNacimiento($actor['anyoNacimiento']); 
            $act->setPais($actor['pais']); 
        
            $actores[]=$act;
           
        }

        return $actores;  
    
    }

    public function getActorById($id){

        $db=Database::conectar(); 
        $select=$db->prepare('SELECT * FROM actores where id=:id');
        $select->bindValue(':id',$id);
        $select->execute();
        $actor=$select->fetch();

        $act= new Actor(); 
        $act->setId($actor['id']); 
        $act->setNombre($actor['nombre']); 
        $act->setAnyoNacimiento($actor['anyoNacimiento']); 
        $act->setPais($actor['pais']); 
        
        return $act;
    
    }

    public function insertActor($actor){
        $db=Database::conectar();
        $insert=$db->prepare('INSERT INTO actores(nombre,anyoNacimiento,pais) VALUES (:nombre,:anyoNacimiento,:pais)'); 
        $insert->bindValue(':nombre', $actor->getNombre());
        $insert->bindValue(':anyoNacimiento', $actor->getAnyoNacimiento());
        $insert->bindValue(':pais', $actor->getPais());
        $insert->execute();
    }
    public function deleteActor($id){
        $db=Database::conectar();
        $delete=$db->prepare('DELETE FROM actores WHERE id=:id'); 
        $delete->bindValue(':id', $id);
        $delete->execute();
    }

    public function updateActor($actor){
        $db=Database::conectar();
        $update=$db->prepare('UPDATE actores SET nombre=:nombre,anyoNacimiento=:anyoNacimiento,pais=:pais WHERE id=:id'); 
        $update->bindValue(':id', $actor->getId());
        $update->bindValue(':nombre', $actor->getNombre());
        $update->bindValue(':anyoNacimiento', $actor->getAnyoNacimiento());
        $update->bindValue(':pais', $actor->getPais());
        $update->execute();
    }

}

?>