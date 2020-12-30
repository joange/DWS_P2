<?php
class Pelicula{
    private $id;
    private $titulo;
    private $anyo;
    private $duracion;

    function __construct(){}

    public function getId(){
        return $this->id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getAnyo(){
        return $this->anyo;
    }

    public function getDuracion(){
        return $this->duracion;
    }

    public function setId($id){
        $this->id=$id;
    }

    public function setTitulo($titulo){
        $this->titulo=$titulo;
    }

    public function setAnyo($anyo){
        $this->anyo=$anyo;
    }

    public function setDuracion($duracion){
        $this->duracion=$duracion;
    }
}
?>