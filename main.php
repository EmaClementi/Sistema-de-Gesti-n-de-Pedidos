<?php

require_once('CasaDeComidas.php');
require_once('Cliente.php');
require_once('Plato.php');
require_once('Pedido.php');
require_once('Conexion.php');
require_once('DetallePedido.php');


echo "========= Bienvenido al Gestor Pedidos/Clientes/Menues ========= \n";
$nombre = readline("Nombre de la casa de comidas:\n");
$casaDeComidas = new CasaDeComidas($nombre);
$casaDeComidas->getNombre();
function menuVisual(){
    echo "\n============ Menu ============\n";
    echo "1- Gestionar Clientes\n";
    echo "2- Gestionar Pedidos\n";
    echo "3- Gestionar Plantos\n";
    echo "0- Salir\n";
    echo "==============================\n";
}
menuPrincipal($casaDeComidas);
function menuPrincipal($casaDeComidas){
    menuVisual();
    $opcion = readline("Ingrese una Opcion: \n");
    while($opcion != 0){
        switch ($opcion) {
            case 1:
                gestionClientes($casaDeComidas);
                break;
            case 2:
                gestionPedidos($casaDeComidas);
                break;
            case 3:
                gestionPlatos($casaDeComidas);
                break;
            default:
                echo "ERROR:Dato mal Ingresado";
        }
        menuVisual();
        $opcion = readline("Ingrese una Opcion: \n");
    }
}
function gestionClientes($casaDeComidas){
    echo "1- Agregar Cliente\n";
    echo "2- Borrar Cliente\n";
    echo "3- Modificar Datos\n";
    echo "4- Listar Clientes\n";
    echo "==============================\n";
    $opcionClientes = readline("Ingrese una opcion: ");
    switch($opcionClientes){
        case 1:
            agregarCliente($casaDeComidas);
            break;
        case 2:
            borrarCliente($casaDeComidas);
            break;
        case 3:
            modificarCliente($casaDeComidas);
            break;
        case 4:
            listarClientes();
            break;
        default:
            echo("ERROR: Dato mal Ingresado");
            break;
    }
}
function gestionPedidos($casaDeComidas){
    echo "1- Agregar Pedido\n";
    echo "2- Borrar Pedido\n";
    echo "3- Modificar Datos del Pedido\n";
    echo "4- Modificar Contenido del Pedido\n";
    echo "5- Listar Pedidos\n";
    echo "==============================\n";
    $opcionPedidos = readline("Ingrese una opcion: ");
    switch($opcionPedidos){
        case 1:
            agregarPedido($casaDeComidas);
            break;
        case 2:
            borrarPedido($casaDeComidas);
            break;
        case 3:
            modificarDatosPedido($casaDeComidas);
            break;
        case 4:
            modificarContenidoPedido($casaDeComidas);
            break;
        case 5:
            listarPedidos();
            break;
        default:
            echo "ERROR: Dato mal Ingresado";
            break;
    }
}
function gestionPlatos($casaDeComidas){
    echo "1- Agregar Plato\n";
    echo "2- Borrar Plato\n";
    echo "3- Modificar Plato\n";
    echo "4- Listar Platos\n";
    echo "==============================\n";
    $opcionPlatos = readline("Ingrese una opcion: ");
    switch($opcionPlatos){
        case 1:
            agregarPlato($casaDeComidas);
            break;
        case 2:
            borrarPlato($casaDeComidas);
            break;
        case 3:
            modificarPlato($casaDeComidas);
            break;
        case 4:
            listarPlatos();
        break;
        default:
            echo "ERROR: Dato mal Ingresado";
            break;
    }
}
function listarClientes() {
    $todos = Cliente::todos();
    foreach ($todos as $cliente) {
        echo ($cliente->id_cliente);    echo ('   '); 
        echo ($cliente->nombre);echo ('   ');
        echo ($cliente->apellido);echo ('   ');
        echo ($cliente->direccion);echo ('   ');
        echo ($cliente->telefono);
        echo (PHP_EOL);            
    }
}
function agregarCliente($casaDeComidas){
    $nombre = readline("Nombre: ");
    $apellido = readline("Apellido: ");
    $direccion = readline("Direccion: ");
    $telefono = readline("Telefono: ");
    $cliente = new Cliente($nombre,$apellido,$direccion,$telefono);// Creo el cliente y lo agrego al arreglo de clientes
    $cliente->save();
    $casaDeComidas->agregarCliente($cliente);   
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

        //echo($sql.PHP_EOL);

    }

}
function borrarCliente($casaDeComidas){
    listarClientes();
    $id_cliente = readline("ID Cliente a borrar: ");
    $casaDeComidas->borrarCliente($id_cliente);    
}
function modificarCliente($casaDeComidas){
    listarClientes();
    $id_cliente = readline("ID Cliente a modificar: ");

    $nombre = readline("Nombre: ");
    $apellido = readline("Apellido: ");
    $direccion = readline("Direccion: ");
    $telefono = readline("Telefono: ");          
    $casaDeComidas->modificarCliente($id_cliente,$nombre,$apellido,$direccion,$telefono);
}
function listarPlatos() {
    $todos = Plato::todos();
    foreach ($todos as $plato) {
        echo ($plato->id_plato);    echo ('   '); 
        echo ($plato->descripcion);echo ('   ');
        echo (PHP_EOL);            
    }
}
function agregarPlato($casaDeComidas){
    $nombre = readline("Nombre del Plato: ");
    $descripcion = readline("Descripcion: ");
    $precio = readline("Precio");

    $plato = new Plato($nombre,$descripcion,$precio);
    $plato->save();
    $casaDeComidas->agregarPlato($plato);

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

        //echo($sql.PHP_EOL);

    }

}
function borrarPlato($casaDeComidas){
    listarPlatos();
    $id_plato = readline("ID Plato a borrar: ");
    $casaDeComidas->borrarPlato($id_plato);

}

function modificarPlato($casaDeComidas){
    listarPlatos();
    $id_plato = readline("ID Plato a modificar: ");
    $nombre = readline("Nombre: ");
    $descripcion = readline("Descripcion: ");
    $casaDeComidas->modificarPlato($id_plato,$nombre,$descripcion);
}


function listarPedidos() {
    $todos = Pedido::todosPedidos();
    echo "ID Pedido | ID Cliente |    Fecha    | Forma de Pago | Total\n";
    foreach ($todos as $pedido) {
        echo ($pedido->id_pedido);    echo ('           '); 
        echo ($pedido->id_cliente);echo ('             ');
        echo ($pedido->fecha);echo ('           ');
        echo ($pedido->forma_de_pago);echo ('          ');
        echo ($pedido->total);
        echo (PHP_EOL);            
    }
}
function listarDetallePedido($id_pedido) {
    $todos = DetallePedido::todosDetallePedido($id_pedido);
    foreach ($todos as $detalle) {
        echo ($detalle->id_pedido);    echo ('   '); 
        echo ($detalle->id_plato);    echo ('   '); 
        echo ($detalle->cantidad);    echo ('   '); 
        echo (PHP_EOL);            
    }
}
function agregarPedido($casaDeComidas){
    listarClientes();
    $id_cliente = readline("Id de Cliente: ");
    $fecha = readline("Fecha: ");
    $forma_de_pago = readline("Forma de Pago: ");
    $total = 0;
    $pedido = new Pedido($id_cliente,$fecha,$forma_de_pago,$total);
    $casaDeComidas->agregarPedido($pedido);
    agregarPlatoPedido($casaDeComidas,$pedido);
}
function agregarPlatoPedido($casaDeComidas,$pedido){
    listarPlatos();
    $opcion = true;
    while($opcion != 0){
        $id_plato = readline("ID Plato: ");
        $cantidad = readline("Cantidad: ");
        $plato = $casaDeComidas->buscarPlato($id_plato);
        var_dump($plato);
        $total = 0;
        $total += $plato->getPrecio() * $cantidad;
        $pedido->setTotal($total);
        $pedido->save();

        $detallePedido = new DetallePedido($pedido->getIdPedido(),$id_plato,$cantidad);
        $detallePedido->save();
        $pedido->agregarDetallePedido($detallePedido);

        echo "Plato Agregado al Pedido.\n";
        echo "1- Agregar otro Plato\n";
        echo "0- Finalizar Pedido\n";
        echo "==============================\n";

        $opcion = readline("Opcion: ");
    }
    
    
}

function modificarDatosPedido($casaDeComidas){
    $id_pedido = readline("ID Pedido a modificar: ");
    $pedido = $casaDeComidas->buscarPedido($id_pedido);
    var_dump($pedido);
    if(isset($pedido)){
        $fecha = readline("Fecha: ");
        $forma_de_pago = readline("Forma de Pago: ");
        $casaDeComidas->modificarDatoPedido($pedido,$id_pedido,$fecha,$forma_de_pago);
    }else{
        echo "El Pedido no Existe\n";
    }
}

function modificarContenidoPedido($casaDeComidas){
    $id_pedido = readline("ID Pedido a modificar: ");
    $pedido = $casaDeComidas->buscarPedido($id_pedido);
    listarDetallePedido($id_pedido);
    if(isset($pedido)){
        $opcion = true;
        while($opcion !=0){
            echo "1- Agregar Plato\n";
            echo "2- Borrar Plato\n";
            echo "0- Finalizar Modificacion\n";
            switch($opcion){
                case 1:
                    $id_plato = readline("ID Plato: ");
                    $cantidad = readline("Cantidad: ");
                    $detallePedido = new DetallePedido($pedido->getIdPedido(),$id_plato,$cantidad);
                    $detallePedido->save();
                    $pedido->agregarDetallePedido($detallePedido);
                    break;
                case 2:
                    $casaDeComidas->borrarPlatoPedido($pedido);
            }
        }
        // $casaDeComidas->modificarPedido($id_pedido,$id_cliente,$fecha,$forma_de_pago);
    }else{
        echo "El Plato no Existe\n";
    }
}
function borrarPedido($casaDeComidas){
    $id_pedido = readline("ID Pedido a borrar: ");
    $pedido = $casaDeComidas->buscarPedido($id_pedido);
    $detallePedido = $pedido->buscarDetallePedido($id_pedido);
    var_dump($detallePedido);
    if($detallePedido){
        $pedido->borrarDetallePedido($detallePedido);
    }
    
    $casaDeComidas->borrarPedido($pedido);

}

