<?php
class Pedido{
    private $id_pedido;
    private $id_cliente;
    private $platos;
    private $fecha;
    private $forma_de_pago;
    
    public function __construct($id_pedido,$id_cliente,$fecha,$forma_de_pago){
        $this->id_pedido = $id_pedido;
        $this->id_cliente = $id_cliente;
        $this->platos = [];
        $this->fecha = $fecha;
        $this->forma_de_pago = $forma_de_pago;
    }
    public function mostrarPedido(){
        echo "Datos del Pedido: \n";
        echo "ID Pedido: \n".$this->id_pedido;
        echo "ID Cliente: \n".$this->id_cliente;
        echo "ID Fecha: \n".$this->fecha;
        echo "ID Forma de Pago: \n".$this->forma_de_pago;
        echo "Contenido del Pedido: \n";
        foreach($this->platos as $plato){
            echo "Plato: ".$plato;
        }

    }
    public function getIdPedido(){
        return $this->id_pedido;
    }
    public function getIdCliente(){
        return $this->id_cliente;
    }
    public function getMenuPlatos(){
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