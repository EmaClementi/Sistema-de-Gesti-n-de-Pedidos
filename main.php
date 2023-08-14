<?php

require_once('CasaDeComidas.php');
require_once('Cliente.php');
require_once('Plato.php');
require_once('Pedido.php');


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
    echo "3- Modificar Pedido\n";
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
            //modificarPedido();
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
    }     
}
function borrarCliente($casaDeComidas){
    $id_cliente = readline("ID Cliente a borrar: ");
    $cliente = $casaDeComidas->buscarCliente($id_cliente);
    if(isset($cliente)){
        $casaDeComidas->borrarCliente($cliente);
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

}
function borrarPlato($casaDeComidas){
    $id_plato = readline("ID Plato a borrar: ");
    $plato = $casaDeComidas->buscarPlato($id_plato);
    if(isset($plato)){
        $casaDeComidas->borrarPlato($plato);
    }else{
        echo "El Menu no Existe\n";
    }
}

function modificarPlato($casaDeComidas){
    $id_plato = readline("ID Plato a modificar: ");
    $plato = $casaDeComidas->buscarMenu($id_plato);
    if(isset($plato)){
        $nombrePlato = readline("Nombre: ");
        $descripcionPlato = readline("Descripcion: ");
        $casaDeComidas->modificarPlato($plato,$nombrePlato,$descripcionPlato);
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
        $pedido = new Pedido($id_pedido,$id_cliente,$fecha,$forma_de_pago);
        $casaDeComidas->mostrarMenus();
        $id_plato = readline("ID Plato: ");
        echo "Platos Disponibles: \n";
        $plato = $casaDeComidas->buscarPlato($id_plato);
        if(isset($plato)){
            $pedido->agregarPlato($plato);
        }else{
            echo "El Plato no existe\n";
        }

    }else{
        echo "El Cliente no Existe\n";
    }   

}

