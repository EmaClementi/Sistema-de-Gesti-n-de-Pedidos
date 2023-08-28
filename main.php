<?php

require_once('CasaDeComidas.php');
require_once('Cliente.php');
require_once('Plato.php');
require_once('Pedido.php');


echo "========= Bienvenido al Gestor Pedidos/Clientes/Menues ========= \n";
$nombre = readline("Nombre de la casa de comidas:\n");
$casaDeComidas = new CasaDeComidas($nombre);
$casaDeComidas->getNombre();
$casaDeComidas->leerClientes('clientes.json');
$casaDeComidas->leerPlatos('platos.json');
$casaDeComidas->leerPedidos('pedidos.json');
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
        default:
            writeln("ERROR: Dato mal Ingresado");
            break;
    }
}
function gestionPedidos($casaDeComidas){
    echo "1- Agregar Pedido\n";
    echo "2- Borrar Pedido\n";
    echo "3- Modificar Datos del Pedido\n";
    echo "4- Modificar Contenido del Pedido\n";
    echo "==============================\n";
    $opcionPedidos = readline("Ingrese una opcion: ");
    switch($opcionPedidos){
        case 1:
            agregarPedido($casaDeComidas);
            break;
        case 2:
            //borrarPedido();
            break;
        case 3:
            modificarDatosPedido($casaDeComidas);
            break;
        case 4:
            modificarContenidoPedido($casaDeComidas);
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
        default:
            echo "ERROR: Dato mal Ingresado";
            break;
    }
}
function agregarCliente($casaDeComidas){
    echo "Agregar Cliente \n";
    $id_cliente = readline("ID Cliente: "); // Pido un ID para el cliente
    $cliente = $casaDeComidas->buscarCliente($id_cliente); // Busco el cliente, si existe me lo trae, sino retorna null
    if(isset($cliente)){ //Evaluo si esta el cliente o no, si no esta le sigo pidiendo el resto de los datos
        echo "El Cliente ya Existe\n";
    }else{
        $nombre = readline("Nombre: ");
        $apellido = readline("Apellido: ");
        $direccion = readline("Direccion: ");
        $telefono = readline("Telefono: ");
        $cliente = new Cliente($id_cliente,$nombre,$apellido,$direccion,$telefono);// Creo el cliente y lo agrego al arreglo de clientes
        $casaDeComidas->agregarCliente($cliente);
        $casaDeComidas->grabarClientes('clientes.json');
    }     
}
function borrarCliente($casaDeComidas){
    $id_cliente = readline("ID Cliente a borrar: ");
    $cliente = $casaDeComidas->buscarCliente($id_cliente);
    if(isset($cliente)){
        $casaDeComidas->borrarCliente($cliente);
        $casaDeComidas->grabarClientes("clientes.json");
    }else{
        echo "El Cliente no Existe\n";
    }
    
}
function modificarCliente($casaDeComidas){
    $id_cliente = readline("ID Cliente a modificar: ");
    $cliente = $casaDeComidas->buscarCliente($id_cliente);
    if(isset($cliente)){
        $nombre = readline("Nombre: ");
        $apellido = readline("Apellido: ");
        $direccion = readline("Direccion: ");
        $telefono = readline("Telefono: ");          
        $casaDeComidas->modificarCliente($cliente,$nombre,$apellido,$direccion,$telefono);
        $casaDeComidas->grabarClientes("clientes.json");
    }else{
        echo "El Cliente no Existe\n";
    }
}
function agregarPlato($casaDeComidas){
    echo "Agregar Platos\n";
    $idMenu = readline("Id Plato: ");
    $nombreMenu = readline("Nombre: ");
    $descripcionMenu = readline("Descripcion: ");

    $plato = new Plato($idMenu,$nombreMenu,$descripcionMenu);
    $casaDeComidas->agregarPlato($plato);
    $casaDeComidas->grabarPlatos('platos.json');

}
function borrarPlato($casaDeComidas){
    $id_plato = readline("ID Plato a borrar: ");
    $plato = $casaDeComidas->buscarPlato($id_plato);
    if(isset($plato)){
        $casaDeComidas->borrarPlato($plato);
        $casaDeComidas->grabarPlatos('platos.json');
    }else{
        echo "El Menu no Existe\n";
    }
}

function modificarPlato($casaDeComidas){
    $id_plato = readline("ID Plato a modificar: ");
    $plato = $casaDeComidas->buscarPlato($id_plato);
    if(isset($plato)){
        $nombrePlato = readline("Nombre: ");
        $descripcionPlato = readline("Descripcion: ");
        $casaDeComidas->modificarPlato($plato,$nombrePlato,$descripcionPlato);
        $casaDeComidas->grabarPlatos('platos.json');
    }else{
        echo "El Plato no Existe\n";
    }
}
function agregarPedido($casaDeComidas){
    $id_cliente = readline("Numero de Cliente: ");
    $cliente = $casaDeComidas->buscarCliente($id_cliente);
    if(isset($cliente)){ 
        $id_pedido = readline("ID Pedido: ");
        $fecha = readline("Fecha: ");
        $forma_de_pago = readline("Forma de Pago: ");
        echo "==============================\n";
        echo "Carta de Platos: \n";
        $platos = agregarPlatoPedido($casaDeComidas);
        $pedido = new Pedido($id_pedido,$id_cliente,$platos,$fecha,$forma_de_pago);
        $casaDeComidas->agregarPedido($pedido);
        $casaDeComidas->grabarPedidos('pedidos.json');
    }else{
        echo "El Cliente no Existe\n";
    }   

}
function agregarPlatoPedido($casaDeComidas){
    $casaDeComidas->mostrarPlatos();
    $opcion = true;
    while($opcion != 0){
        $id_plato = readline("ID Plato: ");
        $plato = $casaDeComidas->buscarPlato($id_plato);
        $platos = [];
        if(isset($plato)){
            $platos = $plato;
        }else{
            echo "El Plato no existe\n";
        }
        echo "Plato Agregado al Pedido.\n";
        echo "1- Agregar otro Plato\n";
        echo "0- Finalizar Pedido\n";
        echo "==============================\n";

        $opcion = readline("Opcion: ");
    }
    return $platos;
}

function modificarDatosPedido($casaDeComidas){
    $id_pedido = readline("ID Pedido a modificar: ");
    $pedido = $casaDeComidas->buscarPedido($id_pedido);
    if(isset($pedido)){
        $id_cliente = readline("ID del Cliente: ");
        $fecha = readline("Fecha: ");
        $forma_de_pago = readline("Forma de Pago: ");
        $casaDeComidas->modificarPedido($id_pedido,$id_cliente,$fecha,$forma_de_pago);
    }else{
        echo "El Pedido no Existe\n";
    }
}

function modificarContenidoPedido($casaDeComidas){
    $id_pedido = readline("ID Pedido a modificar: ");
    $pedido = $casaDeComidas->buscarPedido($id_pedido);
    if(isset($pedido)){
        $opcion = true;
        while($opcion !=0){
            echo "1- Agregar Plato\n";
            echo "2- Borrar Plato\n";
            echo "0- Finalizar Modificacion\n";
        }
        // $casaDeComidas->modificarPedido($id_pedido,$id_cliente,$fecha,$forma_de_pago);
    }else{
        echo "El Plato no Existe\n";
    }
}

