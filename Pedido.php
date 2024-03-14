<?php
class Pedido{
    private $id_pedido;
    private $id_cliente;
    private $detallePedido;
    private $fecha;
    private $forma_de_pago;
    private $total;
    public $estado;
    
    public function __construct($id_cliente,$fecha,$forma_de_pago,$total,$estado){
        $this->id_cliente = $id_cliente;
        $this->detallePedido = [];
        $this->fecha = $fecha;
        $this->forma_de_pago = $forma_de_pago;
        $this->total = $total;
        $this->estado = $estado;
        $this->levantarDetallePedido();
    }
    public function getIdPedido(){
        return $this->id_pedido;
    }
    public function getIdCliente(){
        return $this->id_cliente;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getFormaDePago(){
        return $this->forma_de_pago;
    }
    public function getDetallePedido(){
        return $this->detallePedido;
    }
    public function getEstadoPedido(){
        return $this->estado;
    }
    public function agregarDetallePedido(DetallePedido $detalle) {
        $this->detallePedido[$detalle->getId()] = $detalle;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
        return $this;
    }
    public function setFormaDePago($forma_de_pago){
        $this->forma_de_pago = $forma_de_pago;
        return $this;
    }
    public function setTotal($total){
        $this->total = $total;
        return $this;
    }
    
    public function setId($id_pedido){
        $this->id_pedido = $id_pedido;
        return $this;
    }
    public function setEstadoPedido($estado){
        $this->estado = $estado;
        return $this;
    }

    private function levantarDetallePedido() {

        $detallePedidos= DetallePedido::todos();

        foreach ($detallePedidos as $detalle) {

            $nuevoDetallePedido = new DetallePedido($detalle->id_pedido,$detalle->id_plato,$detalle->cantidad);
            $this->detallePedido[$detalle->id] = $nuevoDetallePedido;
            
            $nuevoDetallePedido->setId($detalle->id);           
            
        }

    }
    static public function todosPedidos() {
        $sql = "select * from pedido;";
        $todos = Conexion::query($sql);
        return $todos;
    }

    public function save() {
            $id_cliente = $this->id_cliente;
            $fecha = $this->fecha;
            $forma_de_pago = $this->forma_de_pago;
            $total = $this->total;
            $estado = $this->estado;

        
        $sql = "INSERT INTO pedido (id_cliente, fecha, forma_de_pago, total, estado)
                VALUES ('$id_cliente', '$fecha', '$forma_de_pago', $total, '$estado')";

        Conexion::ejecutar($sql);

        $this->id_pedido = Conexion::getLastId();
    }
    public function modificar(){
        $fecha = $this->fecha;
        $forma_de_pago = $this->forma_de_pago;
        $total = $this->total;
        $estado = $this->estado;
        
        $sql = "UPDATE pedido SET fecha = '$fecha', forma_de_pago = '$forma_de_pago', total = $total, estado = '$estado', WHERE id_pedido = ".$this->id_pedido;
        Conexion::ejecutar($sql);
    }
    public function update(){
        $total = $this->total;
        
        $sql = "UPDATE pedido SET total = $total WHERE id_pedido = ".$this->id_pedido;
        Conexion::ejecutar($sql);
    }
    public function borrarPlatoPedido($id_pedido,$id_plato){
        foreach($this->detallePedido as $detalle){
            if($id_pedido == $detalle->getIdPedido()){
                if($detalle->getIdPlato() == $id_plato){
                    $this->borrarDetallePedido($detalle);
                }
        }
    }
    }
    public function borrarDetallePedido($detalle){
        $id_detalle = $detalle->getId();
        unset($this->detallePedido[$id_detalle]);
        echo "Plato Borrado\n";
        $detalle->eliminar();
    }
    public function eliminar() {
        
        $sql = "DELETE FROM pedido
                WHERE id_pedido = ".$this->id_pedido;

        Conexion::ejecutar($sql);
    }
    public function buscarDetallePedido($id_pedido){
        foreach ($this->detallePedido as $detalle){
            if($detalle->getIdPedido() == $id_pedido){
                return $detalle;
            }else{
                echo "No se encontro";
            }
        }
    }

}