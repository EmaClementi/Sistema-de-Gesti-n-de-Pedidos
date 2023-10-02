<?php
class Pedido{
    private $id_pedido;
    private $id_cliente;
    private $detallePedido;
    private $fecha;
    private $forma_de_pago;
    private $total;
    
    public function __construct($id_cliente,$fecha,$forma_de_pago,$total){
        $this->id_cliente = $id_cliente;
        $this->detallePedido = [];
        $this->fecha = $fecha;
        $this->forma_de_pago = $forma_de_pago;
        $this->total = $total;
        $this->levantarDetallePedido();
    }
    public function mostrarPedido(){
        echo "Datos del Pedido: ";
        echo "\nID Pedido: ".$this->id_pedido;
        echo "\nID Cliente: ".$this->id_cliente;
        echo "\nFecha: ".$this->fecha;
        echo "\nForma de Pago: ".$this->forma_de_pago;
        echo "\nTotal: ".$this->total;

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
    public function agregarDetallePedido(DetallePedido $detalle) {
        $this->detallePedido[] = $detalle;
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

        
        $sql = "INSERT INTO pedido (id_cliente, fecha, forma_de_pago, total)
                VALUES ('$id_cliente', '$fecha', '$forma_de_pago', $total)";

        Conexion::ejecutar($sql);

        $this->id_pedido = Conexion::getLastId();
    }
    public function modificar(){
        $fecha = $this->fecha;
        $forma_de_pago = $this->forma_de_pago;
        $total = $this->total;
        
        $sql = "UPDATE pedido SET fecha = '$fecha', forma_de_pago = '$forma_de_pago', total = $total WHERE id_pedido = ".$this->id_pedido;
        Conexion::ejecutar($sql);
    }
    // public function borrarContenidoPedido(){
    //     $platoPedido = $this->detallePedido[$id];
    //     unset($this->clientes[$id_cliente]);
    //     $cliente->eliminar();
    //     echo "Cliente Borrado \n";
    // }
    public function eliminar() {
        
        $sql = "DELETE FROM pedido
                WHERE id_pedido = ".$this->id_pedido;

        Conexion::ejecutar($sql);
    }
    public function buscarDetallePedido($id_pedido){
        $detalle = $this->detallePedido[$id_pedido];
        if($detalle != null ){
            return $detalle;
                
        }else{
            echo "No se encontro";
        }
    }
    public function borrarDetallePedido($detallePedido){
        $id_detalle = $detallePedido->getId();
        unset($this->detallePedido[$id_detalle]);
        $detallePedido->eliminar();
        echo "Cliente Borrado \n";
    }

}