<?php
require_once('CasaDeComidas.php');
require_once('Cliente.php');
require_once('Plato.php');
require_once('Pedido.php');
require_once('Conexion.php');
require_once('DetallePedido.php');
require_once('main.php');

$casaDeComidas = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $casaDeComidas = new CasaDeComidas($nombre);
        echo "Casa de comidas creada: " . $casaDeComidas->getNombre();
    }
}

function menuPrincipal() {
    global $casaDeComidas;
    $opcionesPrincipales = [
        ['0', 'Salir', 'salir'],
        ['1', 'Gestionar Clientes', 'menuClientes', [$casaDeComidas]],
        ['2', 'Gestionar Pedidos', 'menuPedidos', [$casaDeComidas]],
        ['3', 'Gestionar Platos', 'menuPlatos', [$casaDeComidas]],
        ['4', 'Ver Facturacion Total Por Dia', 'registroFacturacionTotalPorDia', [$casaDeComidas]]
    ];

    foreach ($opcionesPrincipales as $opcion) {
        echo ($opcion[0] .'- '. $opcion[1]. PHP_EOL );
    }
    echo ("==================================".PHP_EOL);
    $opcion = readline('Ingrese una opcion: ');

    if (!isset($opcionesPrincipales[$opcion])) {
        echo ("Error: Opcion no valida.\n").PHP_EOL;
        menuPrincipal();
    } else {
        call_user_func($opcionesPrincipales[$opcion][2], $opcionesPrincipales[$opcion][3]);
    }
}

function salir() {
    echo "Cerrando Sesion...";
    exit;
}

menuPrincipal();
?>
