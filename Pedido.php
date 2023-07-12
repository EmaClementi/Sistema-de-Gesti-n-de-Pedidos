<?php
class Pedido{
    private $id_pedido;
    private $id_cliente;
    private $menu_plato;
    private $fecha;
    private $forma_de_pago;
    
    public function __construct($id_pedido,Cliente $id_cliente,$fecha,$forma_de_pago){
        $this->id_pedido = $id_pedido;
        $this->id_cliente = $id_cliente;
        $this->menu_plato = [];
        $this->fecha = $fecha;
        $this->forma_de_pago = $forma_de_pago;
    }
    public function getIdPedido(){
        return $this->id_pedido;
    }
    public function getIdCliente(){
        return $this->id_cliente;
    }
    public function getMenuPlatos(){
        return $this->menu_plato;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getFormaDePago(){
        return $this->forma_de_pago;
    }
    public function setMenuPlato($menu_plato){
        $this->menu_plato = $menu_plato;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setFormaDePago($forma_de_pago){
        $this->forma_de_pago = $forma_de_pago;
    }

}