<?php
class Pedido{
    private $id_pedido;
    private $id_cliente;
    private $platos;
    private $fecha;
    private $forma_de_pago;
    
    public function __construct($id_pedido,$id_cliente,$platos,$fecha,$forma_de_pago){
        $this->id_pedido = $id_pedido;
        $this->id_cliente = $id_cliente;
        $this->platos[] = $platos;
        $this->fecha = $fecha;
        $this->forma_de_pago = $forma_de_pago;
    }
    public function mostrarPedido(){
        echo "Datos del Pedido: ";
        echo "\nID Pedido: ".$this->id_pedido;
        echo "\nID Cliente: ".$this->id_cliente;
        echo "\nFecha: ".$this->fecha;
        echo "\nForma de Pago: ".$this->forma_de_pago;
        echo "\nContenido del Pedido: ".$this->platos;

    }
    public function getIdPedido(){
        return $this->id_pedido;
    }
    public function getIdCliente(){
        return $this->id_cliente;
    }
    public function getPlatos(){
        return $this->platos;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getFormaDePago(){
        return $this->forma_de_pago;
    }
    public function agregarPlato($plato){
        $this->platos[] = $plato;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setFormaDePago($forma_de_pago){
        $this->forma_de_pago = $forma_de_pago;
    }

}