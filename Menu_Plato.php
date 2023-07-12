<?php

class Menu_Plato{
    private $id_menu;
    private $nombre;
    private $descripcion;
    
    public function __construct($id_menu,$nombre,$descripcion){
        $this->id_menu = $id_menu;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }
    public function getIdMenuPlato(){
        return $this->id_menu;
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