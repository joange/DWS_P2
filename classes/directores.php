<?php
class Director{
    private $id;
    private $nombre;
    private $anyoNacimiento;
    private $pais;

    function __construct(){ }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getAnyoNacimiento(){
        return $this->anyoNacimiento;
    }

    public function getPais(){
        return $this->pais;
    }

    public function setId($id){
        $this->id=$id;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function setAnyoNacimiento($anyo){
        $this->anyoNacimiento=$anyo;
    }

    public function setPais($pais){
        $this->pais=$pais;
    }
}
?>