<?php
$titulo = "Ejercicio 2";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 2</h1>" . PHP_EOL;

    if(!$_POST){
?>

<div class="formulario">
    <form action="" method="post" enctype="multipart/form-data">
        Nombre: <br/>
        <input type="text" name="nombre" required/><br/>
        Apellidos: <br/>
        <input type="text" name="apellidos" required/><br/>
        NIF: <br/>
        <input type="text" name="nif" pattern="[0-9]{8}[A-Za-z]{1}" required/><br/>
        Usuario: <br/>
        <input type="text" name="usuario" required/><br/>

        <input type="submit" name="enviar" value="Enviar" />
        <input type="reset" name="limpiar" value="Eliminar" />
    </form>
</div>

<?php
    }else{
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $NIF = $_POST["nif"];
        $user = $_POST["usuario"];

        $servidor = 'localhost';
        $usuario = 'root';
        $contraseña = '';
        $baseDatos = 'archivos';
        $consulta = "INSERT INTO personas (Nombre, Apellidos, NIFNIE, Usuario) VALUES ('".$nombre."', '".$apellidos."', '".$NIF."', '".$user."')";
 
        $conexion = mysqli_connect($servidor, $usuario, $contraseña, $baseDatos) or die("No se ha podido conectar al servidor de Base de datos");
        $resultado = mysqli_query($conexion, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
        ?>

<div class="formulario">
    <form action="index.php" method="post" enctype="multipart/form-data">
        Nombre: <br/>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>" readonly/><br/>
        Apellidos: <br/>
        <input type="text" name="apellido" value="<?php echo $apellidos; ?>" readonly/><br/>
        NIF: <br/>
        <input type="text" name="nif" value="<?php echo $NIF; ?>" readonly/><br/>
        Usuario: <br/>
        <input type="text" name="usuario" value="<?php echo $user; ?>"  readonly/><br/>

        <input type="submit" name="enviar" value="Aceptar" />
        <input type="reset" name="limpiar" value="Eliminar" />
    </form>
</div>

        <?php
    }//end if
    include "../Vista/piePagina.phtml";
?>