<?php
require_once('./classes/peliculas.php');
require_once('./classes/actores.php');
require_once('./classes/directores.php');
require_once('database.php');

class CrudPelis {

    public function __construct(){

    }

    public function getAllPeliculas(){
        $db=Database::conectar(); 
        $pelis=[];
        $select=$db->query('SELECT * FROM peliculas');
        foreach ($select->fetchAll() as $peli) {
            $pelicula= new Pelicula(); 
            $pelicula->setId($peli['id']); 
            $pelicula->setTitulo($peli['titulo']); 
            $pelicula->setAnyo($peli['anyo']); 
            $pelicula->setDuracion($peli['duracion']); 
        
            $pelis[]=$pelicula;
           
        }

        return $pelis;
    }

    public  function getPeliculaById($id){
        $db=Database::conectar();
        $select=$db->prepare('SELECT * FROM peliculas WHERE id=:id'); 
        $select->bindValue(':id', $id);
        $select->execute();
        $peli=$select->fetch();

        if(!$peli){
            return null;
        }
        else{
            $pelicula= new Pelicula(); 

            $pelicula->setId($peli['id']); 
            $pelicula->setTitulo($peli['titulo']); 
            $pelicula->setAnyo($peli['anyo']); 
            $pelicula->setDuracion($peli['duracion']); 

            return $pelicula;
        }
    }

    
    public function deletePelicula($id){
        $db=Database::conectar();
        $delete=$db->prepare('DELETE FROM peliculas WHERE id=:id'); 
        $delete->bindValue(':id', $id);
        $delete->execute();
        $count = $delete->rowCount();
        return ($count==1);
    }
    

    public function insertPelicula($pelicula){
        $db=Database::conectar();
        $insert=$db->prepare('INSERT INTO peliculas(titulo,anyo,duracion) VALUES (:titulo,:anyo,:duracion)'); 
        $insert->bindValue(':titulo', $pelicula->getTitulo());
        $insert->bindValue(':anyo', $pelicula->getAnyo());
        $insert->bindValue(':duracion', $pelicula->getDuracion());
        return $insert->execute();
    }

    public function updatePelicula($pelicula){
        $db=Database::conectar();
        $update=$db->prepare('UPDATE peliculas SET titulo=:titulo, anyo=:anyo,duracion=:duracion WHERE id=:id'); 
        $update->bindValue(':id', $pelicula->getId());
        $update->bindValue(':titulo', $pelicula->getTitulo());
        $update->bindValue(':anyo', $pelicula->getAnyo());
        $update->bindValue(':duracion', $pelicula->getDuracion());
        //print_r($update);
        $update->execute();
        return $update->rowCount();
    }

    public function obtenerActoresPelicula($id){

        $db=Database::conectar(); 
        $actores=[];
        $select=$db->prepare('SELECT A.* FROM (peliculas P JOIN peliculas_actores P_A ON P.id=P_A.id_pelicula) JOIN actores A ON P_A.id_actor=A.ID WHERE P.id=:id');

        $select->bindValue(':id', $id);
        $select->execute();
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

    public function obtenerDirectoresPelicula($id){

        $db=Database::conectar(); 
        $directores=[];
        $select=$db->prepare('SELECT D.* FROM (peliculas P JOIN peliculas_directores P_D ON P.id=P_D.id_pelicula) JOIN directores D ON P_D.id_director=D.ID WHERE P.id=:id');
        $select->bindValue(':id', $id);
        $select->execute();
        foreach ($select->fetchAll() as $director) {
            $dir= new Actor(); 

            $dir->setId($director['id']); 
            $dir->setNombre($director['nombre']); 
            $dir->setAnyoNacimiento($director['anyoNacimiento']); 
            $dir->setPais($director['pais']); 
        
            $directores[]=$dir;
           
        }

        return $directores;
    }
    
}
?>