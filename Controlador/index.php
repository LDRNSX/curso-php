<?php
$titulo = "Ejercicios";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo"<h1>Ejercicios en PHP</h1>" . PHP_EOL;
?>

<ul>
	<li><strong>Ejercicio 1:</strong> Realizar una página que se conecte con la base de datos "archivos" y muestre el contenido de la tabla 'rutas'.</li>
	<li><strong>Ejercicio 2:</strong> Realizar una página que se conecte con la base de datos "archivos" y agregue datos a la tabla 'personas' a partir de un formulario donde se capturan los campos de un registro de dicha tabla.</li>
	<li><strong>Ejercicio 3:</strong> Realizar una página que se conecte con la base de datos "archivos" y muestre el contenido de la tabla 'personas' permitiendo modificar y elimiar registros de la tabla usando el método GET.</li>
	<li><strong>Ejercicio 4:</strong> Realizar una página que se conecte con la base de datos "archivos" y permita realizar el CRUD de la tabla 'personas'.</li>
	<li><strong>Ejercicio 5:</strong> Realizar la clase DBCONFIG.</li>
	<li><strong>Ejercicio 6:</strong> Realizar la clase BASEDATOS.</li>
	<li><strong>Ejercicio 7:</strong> Realizar la clase CRUD.</li>
	<li><strong>Ejercicio 8:</strong> Realizar la clase "personas".</li>	
	<li><strong>Ejercicio 9:</strong> Realizar un CRUD con la clase "personas".</li>	
</ul>
			
<?php
include "../Vista/piePagina.phtml";
?>