<?php
$titulo = "Ejercicio 8";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 8</h1>" . PHP_EOL;

require_once '../Modelo/ClasesBaseDatos/BaseDatos.php';


include "../Vista/piePagina.phtml";
?>