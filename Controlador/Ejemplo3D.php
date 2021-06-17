<?php
$titulo = "Ejercicio 3";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo '<a href="ejercicio3.php" class="volver">Volver<a/></br></br>' . PHP_EOL;
if($_GET){
    $IdPersona = $_GET['IdPersona'];
    $servidor = 'localhost';
    $usuario = 'root';
    $contraseña = '';
    $baseDatos = 'archivos';
    $conexion = mysqli_connect($servidor, $usuario, $contraseña, $baseDatos) or die("No se ha podido conectar al servidor de Base de datos");
    $consulta = "DELETE FROM personas WHERE IdPersona = '".$IdPersona."';";
    $resultado = mysqli_query($conexion, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    echo "Se ha eliminado una persona de la tabla personas";
}

include "../Vista/piePagina.phtml";
?>