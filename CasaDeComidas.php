<?php


class CasaDeComidas {
    private $nombre;
    private $clientes;
    private $pedidos;
    private $platos;

    public function __construct($nombre){
        $this->nombre = $nombre;
        $this->clientes = [];
        $this->pedidos = [];
        $this->platos = [];
        $this->levantarClientes();
        $this->levantarPlatos();
        $this->levantarPedidos();
    }

    public function getNombre(){
        echo "========= Casa de Comidas ".$this->nombre." =========\n";
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    // CLIENTE
    private function levantarClientes() {

        $clientes = Cliente::todos(); // Levanto los clientes de la BD

        foreach ($clientes as $cliente) {

            $nuevoCliente = new Cliente($cliente->nombre,$cliente->apellido,$cliente->direccion,$cliente->telefono);
            $this->clientes[$cliente->id_cliente] = $nuevoCliente;
            
            $nuevoCliente->setId($cliente->id_cliente);           
            
        }

    }
    public function getClientes(){
        return $this->clientes;
    }
    public function agregarCliente($cliente){
        $this->clientes[] = $cliente;
    }
    public function mostrarClientes(){
        foreach ($this-> clientes as $cliente){
            $cliente->mostrarCliente();
        }
    }
    public function buscarCliente($id_cliente){
        foreach ($this->clientes as $cliente){
            if($cliente->getIdCliente() === $id_cliente){
                return $cliente;
           
            }       
        }
        return null;
    }
    public function borrarCliente($id_cliente){
        $cliente = $this->clientes[$id_cliente];
        unset($this->clientes[$id_cliente]);
        $cliente->eliminar();
        echo "Cliente Borrado \n";
    }
    public function modificarCliente($id_cliente,$nombre,$apellido,$direccion,$telefono){
        $cliente = $this->clientes[$id_cliente];
        $cliente->setNombre($nombre);
        $cliente->setApellido($apellido);
        $cliente->setDireccion($direccion);
        $cliente->setTelefono($telefono);
        $cliente->modificar();
    }
    // PLATO
    private function levantarPlatos() {

        $platos = Plato::todos(); // Levanto los platos de la BD

        foreach ($platos as $plato) {

            $nuevoPlato = new Plato($plato->nombre,$plato->descripcion);
            $this->platos[$plato->id_plato] = $nuevoPlato;
            
            $nuevoPlato->setId($plato->id_plato);           
            
        }

    }
    public function getPlatos(){
        return $this->platos;
    }
    public function agregarPlato($plato){
        $this->platos[] = $plato;
    }
    public function borrarPlato($id_plato){
        $plato = $this->platos[$id_plato];
        unset($this->platos[$id_plato]);
        $plato->eliminar();
    }
    public function buscarPlato($id_plato){
        foreach ($this->platos as $plato){
            if($plato->getIdPlato() === $id_plato){
                return $plato;
           
            }       
        }
        return null;
    }
    public function modificarPlato($id_plato,$nombre,$descripcion){
        $plato = $this->platos[$id_plato];
        $plato->setNombre($nombre);
        $plato->setDescripcion($descripcion);
        $plato->modificar();
    }
    private function levantarPedidos() {

        $pedidos = Pedido::todosPedidos(); // Levanto los platos de la BD

        foreach ($pedidos as $pedido) {

            $nuevoPedido = new Pedido($pedido->id_cliente,$pedido->fecha,$pedido->forma_de_pago,$pedido->total);
            $this->pedidos[$pedido->id_pedido] = $nuevoPedido;
            
            $nuevoPedido->setId($pedido->id_pedido);           
            
        }

    }
    public function agregarPedido($pedido){
        $this->pedidos[] = $pedido;
    }
    public function mostrarPedidos(){
        foreach($this->pedidos as $pedido){
            $pedido->mostrarPedido();
        }
    }
    public function buscarPedido($id_pedido){
        foreach ($this->pedidos as $pedido){
            if($pedido->getIdPedido() === $id_pedido){
                return $pedido;
           
            }       
        }
        return null;
    }
    public function borrarPedido($pedido){
        $posicion = array_search($pedido,$this->pedidos);
        unset($this->pedidos[$posicion]);
        echo "Pedido Borrado \n";
        $this->mostrarPedidos();
    }
    public function modificarDatoPedido($pedido,$id_pedido,$id_cliente,$fecha,$forma_de_pago){
        $pedido = $this->pedidos[$id_pedido];
        $pedido->setFecha($fecha);
        $pedido->setFormaDePago($forma_de_pago);
        $pedido->modificar();
    }
    // public function borrarContenidoPedido($pedido){
    //     $pedido->
    //     $pedido->setFecha($fecha);
    //     $pedido->setFormaDePago($forma_de_pago);
    //     $pedido->modificar();
    // }

}

