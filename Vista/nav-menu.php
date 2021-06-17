<?php
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>' . PHP_EOL;
echo '<div class="row">' . PHP_EOL;
echo		'<div class="col-sm-2 vertical-menu">' . PHP_EOL;
echo			'<a href="index.php" class="active">Inicio</a>' . PHP_EOL;
$numero = 9;
for($c=1;$c <= $numero; $c++){
	echo '			<a href="../Controlador/Ejercicio' . $c . '.php" class="active">Ejercicio ' . $c . '</a>' . PHP_EOL;
}	
echo "		</div>" . PHP_EOL;
?>