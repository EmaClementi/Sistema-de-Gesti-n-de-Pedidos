<?php

class Plato{
    public $id_plato;
    public $nombre;
    public $descripcion;
    public $precio;
    
    public function __construct($nombre,$descripcion){
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
    public function setId($id_plato){
        $this->id_plato = $id_plato;
        return $this;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    static public function todos() {
        $sql = "select * from plato;";
        $todos = Conexion::query($sql);
        return $todos;
    }

    public function save() {
            $nombre = $this->nombre;
            $descripcion = $this->descripcion;

        
        $sql = "INSERT INTO plato (nombre, descripcion)
                VALUES ('$nombre', '$descripcion')";

        Conexion::ejecutar($sql);

        $this->id_plato = Conexion::getLastId();
    }
    public function modificar(){
        $nombre = $this->nombre;
        $descripcion = $this->descripcion;

        
        $sql = "UPDATE plato SET nombre = '$nombre', descripcion = '$descripcion' WHERE id_plato = ".$this->id_plato;
        Conexion::ejecutar($sql);
    }

    public function eliminar() {
        
        $sql = "DELETE FROM plato
                WHERE id_plato = ".$this->id_plato;

        Conexion::ejecutar($sql);
    }
}