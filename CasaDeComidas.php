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
        echo "========= Casa de Comidas ".$this->nombre." =========\n";
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    // CLIENTE
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
    //PERSISTENCIA DE DATOS
    public function leerClientes($nombreArchivo) { //Esta funcion es llamada desde el main.php, levanta los datos del archivo clientes.json
        $datos = file_get_contents($nombreArchivo);//Guardo en una variable lo que levanto del archivo, con la funcion predefinida file
        $this->setClientesJSON($datos);// Los datos se pasan en formato json a esta funcion para que los transforme en Codigo php para manipularlos

    }
    public function grabarClientes($nombreArchivo) {
        $datos = $this->getClientesJSON();
        file_put_contents($nombreArchivo, $datos);
    }
    public function getClientesJSON() {// CONVIERTE LOS DATOS PHP EN FORMATO JSON
        $jsonClientes = []; // Creo un arreglo alternativo
        //Recorro los clientes y los almaceno en el arreglo alternativo, json_encode me transforma los datos en formato json.
        //Cada valor de los atributos hay que pasarselo como parametro con un array asociativo(clave-valor) para que la funcion los transforme en JSON
        //Paso de esta forma y no cada objeto por que al ser privados los atributos no me lo permitiria, es nesesario llamar a los metodos publicos get de la clase para acceder a ellos.
        foreach ($this->clientes as $cliente) { 
            $jsonClientes[] = json_encode(array(
                "id_cliente"=>$cliente->getIdCliente(),
                "nombre"=>$cliente->getNombre(),
                "apellido"=>$cliente->getApellido(),
                "direccion"=>$cliente->getDireccion(),
                "telefono"=>$cliente->getTelefono()
            ),JSON_PRETTY_PRINT);// JSON PRETTY hace que me muestre en el archivo los objetos uno debajo del otro
        }
        
        return '{"clientes" : ['.implode(',', $jsonClientes).']}';
    }
    public function setClientesJSON($datos) { // CONVIERTE LOS DATOS DEL ARCHIVO EN CODIGO PHP
        $jsonDatos = json_decode($datos); //Esta funcion transforma los datos en codigo php

        $clientes = $jsonDatos->clientes;// Todos los objetos que estan en el json dentro de clientes, los guardo en la variable clientes
        foreach ($clientes as $cliente) {//Recorro $clientes para manipular cada objeto
            //Los clientes no estan creados, solo estan almacenados en el archivo, voy recorriendo y creando cada cliente del archivo con el foreach
            $nuevoCliente = new Cliente($cliente->id_cliente, $cliente->nombre, $cliente->apellido, $cliente->direccion, $cliente->telefono);
            $this->agregarCliente($nuevoCliente);//A cada cliente creado lo agrego al arreglo de clientes que ya tenia.
        }
    }
    // PLATO
    public function mostrarPlatos(){
        foreach($this->platos as $plato){
            $plato->mostrarPlato();
        }
    }
    public function agregarPlato($plato){
        $this->platos[] = $plato;
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
        //PERSISTENCIA DE DATOS
    public function leerPlatos($nombreArchivo) {
        $datos = file_get_contents($nombreArchivo);
        $this->setPlatosJSON($datos);
    
    }
    public function grabarPlatos($nombreArchivo) {
        $datos = $this->getPlatosJSON();
        file_put_contents($nombreArchivo, $datos);
    }
    public function getPlatosJSON() {// CONVIERTE LOS DATOS PHP EN FORMATO JSON
    
        $jsonPlatos = [];
        foreach ($this->platos as $plato) {
            $jsonPlatos[] = json_encode(array(
                "id_plato"=>$plato->getIdPlato(),
                "nombre"=>$plato->getNombre(),
                "descripcion"=>$plato->getDescripcion(),
            ),JSON_PRETTY_PRINT);
    }
            
        return '{"platos" : ['.implode(',', $jsonPlatos).']}';
    }
    public function setPlatosJSON($datos) { // CONVIERTE LOS DATOS DEL ARCHIVO EN CODIGO PHP
        $jsonDatos = json_decode($datos);
    
        $platos = $jsonDatos->platos;
        foreach ($platos as $plato) {
            $nuevoPlato = new Plato($plato->id_plato, $plato->nombre, $plato->descripcion);
            $this->agregarPlato($nuevoPlato);
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
    public function modificarPedido(){
        
    }
    public function leerPedidos($nombreArchivo) {
        $datos = file_get_contents($nombreArchivo);
        $this->setPedidosJSON($datos);
    }
    public function grabarPedidos($nombreArchivo) {
        $datos = $this->getPedidosJSON();
        file_put_contents($nombreArchivo, $datos);
    }
    public function setPedidosJSON($datos) { // CONVIERTE LOS DATOS DEL ARCHIVO EN CODIGO PHP
        $jsonDatos = json_decode($datos);
    
        $pedidos = $jsonDatos->pedidos;
        foreach ($pedidos as $pedido) {
            $nuevoPedido = new Pedido($pedido->id_pedido,$pedido->id_cliente,$pedido->platos,$pedido->fecha,$pedido->forma_de_pago);
            $this->agregarPedido($nuevoPedido);
        }
    }
    public function getPedidosJSON() {// CONVIERTE LOS DATOS PHP EN FORMATO JSON
        $jsonPedidos = [];
        foreach ($this->pedidos as $pedido) {
            $jsonPedidos[] = json_encode(array(
                "id_pedido"=>$pedido->getIdPedido(),
                "id_cliente"=>$pedido->getIdCliente(),
                "platos"=>$pedido->getPlatos(),
                "fecha"=>$pedido->getFecha(),
                "forma_de_pago"=>$pedido->getFormaDePago(),
            ),JSON_PRETTY_PRINT);
        }
        return '{"pedidos" : ['.implode(',', $jsonPedidos).']}';
    }
}

