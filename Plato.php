<?php

class Plato{
    private $id_plato;
    private $nombre;
    private $descripcion;
    
    public function __construct($id_plato,$nombre,$descripcion){
        $this->id_plato = $id_plato;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }
    public function mostrarPlato(){
        echo "ID: ".$this->id_plato;
        echo "\nNombre: ".$this->nombre ;
        echo "\nDescripcion: ".$this->descripcion;
        echo "\n==============================\n";
    }
    public function getIdPlato(){
        return $this->id_plato;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
}