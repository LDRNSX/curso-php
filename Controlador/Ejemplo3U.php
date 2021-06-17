<?php
$titulo = "Ejercicio 3";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo '<a href="ejercicio3.php" class="volver">Volver<a/></br></br>' . PHP_EOL;

if (!$_POST){
    $IdPersona = $_GET['IdPersona'];
    $servidor = 'localhost';
    $usuario = 'root';
    $contraseña = '';
    $baseDatos = 'archivos';
    $conexion = mysqli_connect($servidor, $usuario, $contraseña, $baseDatos) or die("No se ha podido conectar al servidor de Base de datos");
    $consulta = "SELECT * FROM personas WHERE IdPersona = '".$IdPersona."';";
    $resultado = mysqli_query($conexion, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
	$fila = mysqli_fetch_array($resultado);
	
	$NIFNIE = $fila["NIFNIE"];
	$nombre = $fila["Nombre"];
	$apellidos = $fila["Apellidos"];
	$usuario = $fila["Usuario"];

?>

<div class="formulario">
    <form action="" method="post" enctype="multipart/form-data">
        Nombre: <br/>
        <input type="text" name="nombre" value="<?php echo "$nombre"?>" required/><br/>
        Apellidos: <br/>
        <input type="text" name="apellidos" value="<?php echo "$apellidos"?>" required/><br/>
        NIF: <br/>
        <input type="text" name="NIFNIE" pattern="[0-9]{8}[A-Za-z]{1}" value= "<?php echo "$NIFNIE"?>" required/><br/>
        Usuario: <br/>
        <input type="text" name="usuario" value="<?php echo "$usuario"?>" required/><br/>

        <input type="submit" name="enviar" value="Enviar" />
        <input type="reset" name="limpiar" value="Eliminar" />
		<input type="hidden" name="IdPersona" value="<?php echo "$IdPersona"?>">

    </form>
</div>

<?php
}else{
	$IdPersona = $_POST['IdPersona'];
	$NIFNIE = $_POST["NIFNIE"];
	$nombre = $_POST["nombre"];
	$apellidos = $_POST["apellidos"];
	$user = $_POST["usuario"];
	
    $servidor = 'localhost';
    $usuario = 'root';
    $contraseña = '';
    $baseDatos = 'archivos';
	$conexion = mysqli_connect($servidor, $usuario, $contraseña, $baseDatos) or die("No se ha podido conectar al servidor de Base de datos");
    $consulta = "UPDATE personas 
	SET Nombre='".$nombre."',
	Apellidos='".$apellidos."',
	NIFNIE='".$NIFNIE."',
	Usuario='".$user."'
	WHERE IdPersona = ".$IdPersona.";";
    $resultado = mysqli_query($conexion, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");	
?>

<div class="formulario">
    <form action="" method="post" enctype="multipart/form-data">
        Nombre: <br/>
        <input type="text" name="nombre" value="<?php echo "$nombre"?>" readonly/><br/>
        Apellidos: <br/>
        <input type="text" name="apellidos" value="<?php echo "$apellidos"?>" readonly/><br/>
        NIF: <br/>
        <input type="text" name="nif" pattern="[0-9]{8}[A-Za-z]{1}" value= "<?php echo "$NIFNIE"?>" readonly/><br/>
        Usuario: <br/>
        <input type="text" name="usuario" value="<?php echo "$usuario"?>" required/><br/>
	</form>
</div>

<?php
}

include "../Vista/piePagina.phtml";
?>