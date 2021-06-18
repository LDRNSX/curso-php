<?php
$titulo = "Ejercicio 6";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 6</h1>" . PHP_EOL;

require_once "../Modelo/ClasesBaseDatos/DBConfig.php";
//Declaracion de la clase------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
class BaseDatos extends DBConfig
{
/*protected*/ function __construct($DBName){
//Cuando queramos acceder a una constante o metodo de una clase padre, la palabra reservada parent nos sirve para llamarla desde una clase extendida.
    parent::__construct($DBName);
    $this->pConnection->query("SET NAMES 'utf8'");
    } // end of member function __construct
    
/**
* Ejecuta la consulta SQL de tipo SELECT para devolver un array con las filas y
* columnas obtenidas
*
* @param string _query Consulta SQL de tipo SELECT para devolver un array con las filas y columnas obtenidas
* @return array
* @access protected
*/
/*protected*/ function setData( $query)
{
// echo "Sentencia SQL a ejecutar $query" . PHP_EOL;
$result = $this->pConnection->query($query);
if($result== false) {
return false;
} //END IF
// Array de filas a devolver
$rows = array();
// Mientras haya filas a tratar, se agrega al array
while($row = $result->fetch_assoc()) {
$rows[] = $row;
} //END WHILE
return $rows;
} // end of member function getData

/**
* Ejecuta la sentencia SQL de tipo INSERT, UPDATE o DELETE a ejecutar sobre la
* base de datos
*
* @param string _query Sentencia SQL de tipo INSERT, UPDATE o DELETE a ejecutar sobre la base de datos
* @return bool
* @access protected
*/
/*protected*/ function execute( $query)
{
// echo "Sentencia a ejecutar $query" . PHP_EOL;
$result = $this->pConnection->query($query);
if($result == false) {
echo "<h1>Error: no se ha podido ejecutar $query </h1>" . PHP_EOL;
return false;
} else {
return true;
} // END IF
} // end of member function execute
} // end of BaseDatos

//Proceso para usar la clase-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$objeto = new BaseDatos ("archivos");//Instanciar el objeto
echo "<pre>" . PHP_EOL;
var_dump($objeto);
echo "</pre>" . PHP_EOL;
echo '<a href="index.php" class="volver">Volver al inicio</a>' . PHP_EOL;

include "../Vista/piePagina.phtml";
?>