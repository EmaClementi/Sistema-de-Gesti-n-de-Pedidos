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
    }
    public function getNombre(){
        echo "========= Casa de Comidas ".$this->nombre." =========";
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    // CLIENTE
    public function agregarCliente($cliente){
        $this->clientes[] = $cliente;
        echo "\nCliente Agregado ";
        $this->mostrarClientes();
    }
    public function mostrarClientes(){
        echo "\nLista de Clientes:";
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
    public function borrarCliente($cliente){
        $posicion = array_search($cliente,$this->clientes);
        unset($this->clientes[$posicion]);
        echo "Cliente Borrado \n";
        $this->mostrarClientes();
    }
    public function modificarCliente($cliente,$nombre,$apellido,$direccion,$telefono){
        $cliente->setNombre($nombre);
        $cliente->setApellido($apellido);
        $cliente->setDireccion($direccion);
        $cliente->setTelefono($telefono);
        echo "Cliente Modificado \n";
        $this->mostrarClientes();
    }
    // MENU
    public function mostrarPlatos(){
        foreach($this->platos as $plato){
            $plato->mostrarPlato();
        }
    }
    public function agregarPlato($plato){
        $this->platos[] = $plato;
        $this->mostrarPlatos();
    }
    public function borrarPlato($plato){
        $posicion = array_search($plato,$this->platos);
        unset($this->platos[$posicion]);
        echo "Plato Borrado \n";
        $this->mostrarPlatos();
    }
    public function buscarPlato($id_plato){
        foreach ($this->platos as $plato){
            if($plato->getIdPlato() === $id_plato){
                return $plato;
           
            }       
        }
        return null;
    }
    public function modificarPlato($plato,$nombre,$descripcion){
        $plato->setNombre($nombre);
        $plato->setDescripcion($descripcion);
        $this->mostrarPlatos();
    }
}

