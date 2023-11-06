<?php

require_once('Conexion.php');
class Cliente {
    private $id_cliente;
    private $nombre;
    private $apellido;
    private $direccion;
    private $telefono;
    
    public function __construct($nombre,$apellido,$direccion,$telefono){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }
    public function getIdCliente(){
        return $this->id_cliente;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function setId($id_cliente){
        $this->id_cliente = $id_cliente;
        return $this;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    static public function todos() {
        $sql = "select * from cliente;";
        $todos = Conexion::query($sql);
        return $todos;
    }

    public function save() {
            $nombre = $this->nombre;
            $apellido = $this->apellido;
            $direccion = $this->direccion;
            $telefono = $this->telefono;
        
        $sql = "INSERT INTO cliente (nombre, apellido, direccion, telefono)
                VALUES ('$nombre', '$apellido', '$direccion', $telefono)";

        Conexion::ejecutar($sql);

        $this->id_cliente = Conexion::getLastId();
    }
    public function modificar(){
        $nombre = $this->nombre;
        $apellido = $this->apellido;
        $direccion = $this->direccion;
        $telefono = $this->telefono;
        
        $sql = "UPDATE cliente SET nombre = '$nombre', apellido = '$apellido', direccion = '$direccion', telefono = '$telefono' WHERE id_cliente = ".$this->id_cliente;
        Conexion::ejecutar($sql);
    }

    public function eliminar() {
        
        $sql = "DELETE FROM cliente
                WHERE id_cliente = ".$this->id_cliente;

        Conexion::ejecutar($sql);
    }

}