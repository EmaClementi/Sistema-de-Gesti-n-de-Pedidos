<?php

require_once('CasaDeComidas.php');
require_once('Cliente.php');
require_once('Plato.php');
require_once('Pedido.php');
require_once('Conexion.php');
require_once('DetallePedido.php');
require_once('menu.php');

function listarClientes($casaDeComidas) {
    $todos = Cliente::todos();
    foreach ($todos as $cliente) {
        echo ($cliente->id_cliente);    echo ('   '); 
        echo ($cliente->nombre);echo ('   ');
        echo ($cliente->apellido);echo ('   ');
        echo ($cliente->direccion);echo ('   ');
        echo ($cliente->telefono);
        echo (PHP_EOL);            
    }
    menuClientes($casaDeComidas);
}
function agregarCliente($casaDeComidas){
    $nombre = readline("Nombre: ");
    $apellido = readline("Apellido: ");
    $direccion = readline("Direccion: ");
    $telefono = readline("Telefono: ");
    $cliente = new Cliente($nombre,$apellido,$direccion,$telefono);// Creo el cliente y lo agrego al arreglo de clientes
    $cliente->save();
    $casaDeComidas->agregarCliente($cliente);
    menuClientes($casaDeComidas);   
}
function insertarClientes($pDO, $casaDeComidas) {
    $clientes = $casaDeComidas->getClientes();

    foreach ($clientes as $cliente) {
        $id_cliente = $cliente->getId();
        $nombre = $cliente->getNombre();
        $apellido = $cliente->getApellido();
        $direccion = $cliente->getDireccion();
        $telefono = $cliente->getTelefono();

        $sql = "insert into cliente (id_cliente, nombre, apellido, direccion, telefono) 
                values ($id_cliente, '$nombre', $apellido, $direccion, $telefono)";
        $pDO->query($sql);

    }

}
function borrarCliente($casaDeComidas){
    $id_cliente = readline("ID Cliente a borrar: ");
    $casaDeComidas->borrarCliente($id_cliente);   
    menuClientes($casaDeComidas); 
}
function modificarCliente($casaDeComidas){
    $id_cliente = readline("ID Cliente a modificar: ");
    $cliente = $casaDeComidas->buscarCliente($id_cliente);
    if(isset($cliente)){
        $nombre = readline("Nombre: ");
        $apellido = readline("Apellido: ");
        $direccion = readline("Direccion: ");
        $telefono = readline("Telefono: ");          
        $casaDeComidas->modificarCliente($id_cliente,$nombre,$apellido,$direccion,$telefono); 
    }else{
        echo "El cliente no existe";
    }

    menuClientes($casaDeComidas); 
}
function listarPlatos($casaDeComidas) {
    $todos = Plato::todos();
    echo "ID Plato |        Nombre             \n";
    foreach ($todos as $plato) {
        echo ($plato->id_plato);    echo ('          '); 
        echo ($plato->nombre); echo ('      '); 
        echo (PHP_EOL);            
    }
    menuPlatos($casaDeComidas);
}
function agregarPlato($casaDeComidas){
    $nombre = readline("Nombre del Plato: ");
    $descripcion = readline("Descripcion: ");
    $precio = readline("Precio: ");

    $plato = new Plato($nombre,$descripcion,$precio);
    $plato->save();
    $casaDeComidas->agregarPlato($plato);
    menuPlatos($casaDeComidas);
}
function insertarPlatos($pDO, $casaDeComidas) {
    $platos = $casaDeComidas->getPlatos();

    foreach ($platos as $plato) {
        $id_plato = $plato->getIdPlato();
        $nombre = $plato->getNombre();
        $descripcion = $plato->getDescripcion();

        $sql = "insert into plato (id_plato, nombre, descripcion) 
                values ($id_plato, '$nombre', '$descripcion')";
        $pDO->query($sql);
    }

}
function borrarPlato($casaDeComidas){
    $id_plato = readline("ID Plato a borrar: ");
    $plato = $casaDeComidas->buscarPlato($id_plato);
    if(isset($plato)){
        $casaDeComidas->borrarPlato($id_plato);
    }else{
        echo "El Plato no existe";
    }
    menuPlatos($casaDeComidas);
}

function modificarPlato($casaDeComidas){
    $id_plato = readline("ID Plato a modificar: ");
    $nombre = readline("Nombre: ");
    $descripcion = readline("Descripcion: ");
    $precio = readline("Precio: ");
    $casaDeComidas->modificarPlato($id_plato,$nombre,$descripcion,$precio);
    menuPlatos($casaDeComidas);

}


function listarPedidos($casaDeComidas) {
    $todos = Pedido::todosPedidos();
    echo "ID Pedido | ID Cliente |    Fecha    | Forma de Pago | Total\n";
    foreach ($todos as $pedido) {
        echo ($pedido->id_pedido);    echo ('            '); 
        echo ($pedido->id_cliente);echo ('           ');
        echo ($pedido->fecha);echo ('     ');
        echo ($pedido->forma_de_pago);echo ('     ');
        echo ($pedido->total);
        echo (PHP_EOL);            
    }
    menuPedidos($casaDeComidas);
}
function listarDetallePedido($id_pedido) {
    $todos = DetallePedido::todosDetallePedido($id_pedido);
    echo "ID Pedido | ID Plato | Cantidad |\n";
    foreach ($todos as $detalle) {
        echo ($detalle->id_pedido);    echo ('               '); 
        echo ($detalle->id_plato);    echo ('         '); 
        echo ($detalle->cantidad);    echo ('          '); 
        echo (PHP_EOL);            
    }
}
function agregarPedido($casaDeComidas){

    $todos = Cliente::todos();
    foreach ($todos as $cliente) {
        echo ($cliente->id_cliente);    echo ('   '); 
        echo ($cliente->nombre);echo ('   ');
        echo ($cliente->apellido);echo ('   ');
        echo ($cliente->direccion);echo ('   ');
        echo ($cliente->telefono);
        echo (PHP_EOL);            
    }

    $id_cliente = readline("Id de Cliente: ");
    $fecha = readline("Fecha: ");
    $forma_de_pago = readline("Forma de Pago: ");
    $total = 0;
    $pedido = new Pedido($id_cliente,$fecha,$forma_de_pago,$total);
    $pedido->save();
    $casaDeComidas->agregarPedido($pedido);
    agregarPlatoPedido($casaDeComidas,$pedido);
}
function agregarPlatoPedido($casaDeComidas,$pedido){
    $todos = Plato::todos();
    echo "ID Plato |        Nombre             \n";
    foreach ($todos as $plato) {
        echo ($plato->id_plato);    echo ('          '); 
        echo ($plato->nombre); echo ('      '); 
        echo (PHP_EOL);            
    }
    $opcion = true;
    while($opcion != 0){
        $id_plato = readline("ID Plato: ");
        $cantidad = readline("Cantidad: ");
        $plato = $casaDeComidas->buscarPlato($id_plato);
        $total = 0;
        $total += $plato->getPrecio() * $cantidad;
        $pedido->setTotal($total);
        
        $pedido->update();
        $detallePedido = new DetallePedido($pedido->getIdPedido(),$id_plato,$cantidad);
        $detallePedido->save();
        $pedido->agregarDetallePedido($detallePedido);

        echo "Plato Agregado al Pedido.\n";
        echo "1- Agregar otro Plato\n";
        echo "0- Finalizar Pedido\n";
        echo "==============================\n";

        $opcion = readline("Opcion: ");
    }
    
    menuPedidos($casaDeComidas);
}

function modificarDatosPedido($casaDeComidas){
    $todos = Pedido::todosPedidos();
    echo "ID Pedido | ID Cliente |    Fecha    | Forma de Pago | Total\n";
    foreach ($todos as $pedido) {
        echo ($pedido->id_pedido);    echo ('            '); 
        echo ($pedido->id_cliente);echo ('           ');
        echo ($pedido->fecha);echo ('     ');
        echo ($pedido->forma_de_pago);echo ('     ');
        echo ($pedido->total);
        echo (PHP_EOL);            
    }

    $id_pedido = readline("ID Pedido a modificar: ");
    $fecha = readline("Fecha: ");
    $forma_de_pago = readline("Forma de Pago: ");
    $casaDeComidas->modificarDatoPedido($id_pedido,$fecha,$forma_de_pago);

    menuPedidos($casaDeComidas);
}

function modificarContenidoPedido($casaDeComidas){
    $todos = Pedido::todosPedidos();
    echo "ID Pedido | ID Cliente |    Fecha    | Forma de Pago | Total\n";
    foreach ($todos as $pedido) {
        echo ($pedido->id_pedido);    echo ('            '); 
        echo ($pedido->id_cliente);echo ('           ');
        echo ($pedido->fecha);echo ('     ');
        echo ($pedido->forma_de_pago);echo ('     ');
        echo ($pedido->total);
        echo (PHP_EOL);            
    }
    $id_pedido = readline("ID Pedido a modificar: ");
    $pedido = $casaDeComidas->buscarPedido($id_pedido);
    listarDetallePedido($id_pedido);
    if(isset($pedido)){
        $opcion = true;
        while($opcion !=0){
            echo "1- Agregar Plato\n";
            echo "2- Borrar Plato\n";
            echo "0- Finalizar Modificacion\n";
            $opcion = readline("Opcion: ");
            switch($opcion){
                case 1:
                    listarPlatos($casaDeComidas);
                    $id_plato = readline("ID Plato: ");
                    $cantidad = readline("Cantidad: ");
                    $detallePedido = new DetallePedido($pedido->getIdPedido(),$id_plato,$cantidad);
                    $detallePedido->save();
                    $pedido->agregarDetallePedido($detallePedido);
                    break;
                case 2:
                    $id_plato = readline("ID Plato a eliminar: ");
                    $pedido->borrarPlatoPedido($id_pedido,$id_plato);
            }
        }
    }else{
        echo "El Plato no Existe\n";
    }
    menuPedidos($casaDeComidas);
}
function borrarPedido($casaDeComidas){
    $id_pedido = readline("ID Pedido a borrar: ");
    $casaDeComidas->borrarPedido($id_pedido);
    menuPedidos($casaDeComidas);
}

