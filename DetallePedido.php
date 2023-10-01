<?php

class DetallePedido{
    private $id;
    private $id_pedido;
    private $id_plato;
    private $cantidad;

    public function __construct($id_pedido,$id_plato,$cantidad){
        $this->id_pedido = $id_pedido;
        $this->id_plato = $id_plato; 
        $this->cantidad = $cantidad;
    }

    public function getId(){
        return $this->id;
    }

    public function getIdPedido(){
        return $this->id_pedido;
    }

    public function getIdPlato(){
        return $this->id_plato;
    }
    public function getCantidad(){
        return $this->cantidad;
    }
    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }
    public function setId($id){
        $this->id= $id;
        return $this;
    }

    static public function todos() {
        $sql = "select * from detalle_pedido;";
        $todos = Conexion::query($sql);
        return $todos;
    }

    static public function todosDetallePedido($id_pedido){
        $sql = "SELECT * FROM detalle_pedido WHERE id_pedido = $id_pedido";
        $detalles = Conexion::query($sql);
        return $detalles;
    }

    public function save() {
            $id_pedido = $this->id_pedido;
            $id_plato = $this->id_plato;
            $cantidad = $this->cantidad;


        $sql = "INSERT INTO detalle_pedido (id_pedido, id_plato, cantidad)
                VALUES ($id_pedido, $id_plato, $cantidad)";

        Conexion::ejecutar($sql);

        $this->id = Conexion::getLastId();
    }
    public function modificar(){
        $id_plato = $this->id_plato;
        $cantidad = $this->cantidad;
        
        $sql = "UPDATE detalle_pedido SET id_plato = '$id_plato', cantidad = '$cantidad' WHERE id = ".$this->id;
        Conexion::ejecutar($sql);
    }

    public function eliminar() {
        
        $sql = "DELETE FROM detalle_pedido
                WHERE id = ".$this->id;

        Conexion::ejecutar($sql);
    }

}