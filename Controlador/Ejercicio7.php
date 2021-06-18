<?php
$titulo = "Ejercicio 7";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 7</h1>" . PHP_EOL;

require_once '../Modelo/ClasesBaseDatos/BaseDatos.php';

class CRUD extends BaseDatos{
    private $pSQL_C;
    private $pSQL_R;
    private $pSQL_U;
    private $pSQL_D;

    protected function setDatos( $BaseDatos){
    $this->pDatos=$BaseDatos;
    } 

    /*protected*/ function setSQL_C( $query){
    $this->pSQL_C=$query;
    } 

    /*protected*/ function setSQL_R( $query){
    $this->pSQL_R=$query;
    } 

    /*protected*/ function setSQL_U( $query){
    $this->pSQL_U=$query;
    }

    /*protected*/ function setSQL_D( $query){
    $this->pSQL_D=$query;
    } 
}

$objeto = new CRUD ("archivos");//Instanciar el objeto
echo "<pre>" . PHP_EOL;
var_dump($objeto);
echo "</pre>" . PHP_EOL;
echo '<a href="index.php" class="volver">Volver al inicio</a>' . PHP_EOL;

include "../Vista/piePagina.phtml";
?>