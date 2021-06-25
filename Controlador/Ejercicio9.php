<?php
$titulo = "Ejercicio 9";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 9</h1>" . PHP_EOL;

require_once '../Modelo/personas.php';

$persona = new personas();

if (!$_POST && !$_GET ){
echo '<br/><a href="ejercicio9.php?accion=C&IdPersona=0" class="agregar">Agregar nuevo<a/></br></br>' . PHP_EOL;
foreach($persona->tablaDatos("Ejercicio9.php") as $key=>$value){
	echo $value;
}
}else{
	$accion = $_GET['accion'];
	$IdPersona = $_GET['IdPersona'];

	if ($accion != "C") {
		$fila = $persona->buscaDatos($IdPersona);	
		$fila = $fila[0];
		$NIFNIE = $fila["NIFNIE"];
		$Nombre = $fila["Nombre"];
		$Apellidos = $fila["Apellidos"];
		$Usuario = $fila["Usuario"];
	} else {
		$NIFNIE = "";
		$Nombre = "";
		$Apellidos = "";
		$Usuario = "";
	}

	if ($_GET && !$_POST) {
		switch ($accion) {
			case "C":
				$texto = "agregar";
				break;
			case "U":
				$texto = "modificar";
				break;
			case "D":
				$texto = "eliminar";
				break;
		}
?>
		<!--Formulario de captura-------------------------------------------------------------------------------------------------------------------------->

		<div class="formulario">
			<h3>Registro a <?php echo $texto; ?></h3>
			<form action="" method="post" enctype="multipart/form-data">
				Nombre: <br />
				<input type="text" name="nombre" value="<?php if ($accion == "C") {echo "";} else {echo "$Nombre";} ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";} ?>><br />
				Apellidos: <br />
				<input type="text" name="apellidos" value="<?php if ($accion == "C") {echo "";} else {echo "$Apellidos";} ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";}?>><br />
				NIF: <br />
				<input type="text" name="NIFNIE" pattern="[0-9]{8}[A-Za-z]{1}" value="<?php if ($accion == "C") {echo "";} else {echo "$NIFNIE";} ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";} ?>><br />
				Usuario: <br />
				<input type="text" name="usuario" value="<?php if ($accion == "C") {echo "";} else {echo "$Usuario";} ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";} ?>><br />

				<input type="submit" name="enviar" value="<?php echo ucfirst($texto); ?>">
				<input type="reset" name="limpiar" value="Borrar">
				<input type="hidden" name="IdPersona" value="<?php echo "$IdPersona" ?>">

			</form>
		</div>

		<?php
	} else {

		if ($_POST) {
			$accion = $_GET['accion'];
			$IdPersona = $_GET['IdPersona'];
			$Nombre = $_POST["nombre"];
			$Apellidos = $_POST["apellidos"];
			$NIFNIE = $_POST["NIFNIE"];
			$Usuario = $_POST["usuario"];
			$persona->setIdPersona($IdPersona);
			$persona->setNIFNIE($NIFNIE);
			$persona->setNombre($Nombre);
			$persona->setApellidos($Apellidos);
			$persona->setUsuario($Usuario);

			if ($accion == "C") {
				$persona->agregaDatos();
			}
			if ($accion == "U") {
		
				$persona->modificaDatos();
			}
			if ($accion == "D") {
			
				$persona->eliminaDatos();
			}

			switch ($accion) {
				case "C":
					$texto = "agregado";
					break;
				case "U":
					$texto = "modificado";
					break;
				case "D":
					$texto = "eliminado";
					break;
			}
		?>

			<!--Formulario de validar-------------------------------------------------------------------------------------------------------------------------->
			<div class="formulario">
				<h3>Registro <?php echo $texto; ?></h3>
				<form action="index.php" method="post" enctype="multipart/form-data">
					Nombre: <br />
					<input type="text" name="nombre" value="<?php echo $Nombre; ?>" readonly><br />
					Apellidos: <br />
					<input type="text" name="apellido" value="<?php echo $Apellidos; ?>" readonly><br />
					NIF: <br />
					<input type="text" name="nif" value="<?php echo $NIFNIE; ?>" readonly><br />
					Usuario: <br />
					<input type="text" name="usuario" value="<?php echo $Usuario; ?>" readonly><br />

					<input type="submit" name="enviar" value="Aceptar">
				</form>
			</div>


<?php
		}
	}
}

include "../Vista/piePagina.phtml";
?>