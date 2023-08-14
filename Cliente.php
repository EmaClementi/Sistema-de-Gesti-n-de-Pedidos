<?php
class Cliente {
    private $id_cliente;
    private $nombre;
    private $apellido;
    private $direccion;
    private $telefono;
    
    public function __construct($id_cliente,$nombre,$apellido,$direccion,$telefono){
        $this->id_cliente = $id_cliente;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }
    public function mostrarCliente(){
        echo "ID: ".$this->id_cliente;
        echo "\nNombre: ".$this->nombre ;
        echo "\nApellido: ".$this->apellido;
        echo "\nDireccion: ".$this->direccion;
        echo "\nTelefono: ".$this->telefono;
        echo "\n==============================\n";
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

}