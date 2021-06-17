<?php
$titulo = "Ejercicio 4";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 4</h1>" . PHP_EOL;

$servidor = 'localhost';
$usuario = 'root';
$contraseña = '';
$baseDatos = 'archivos';


//Paginacion----------------------------------------------------------------------------------------------------------------------------------------------
$per_page_record = 10;  // Number of entries to show in a page.   
// Look for a GET variable page if not found default is 1.        
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

$start_from = ($page_no - 1) * $per_page_record;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

//Conexion base de datos------------------------------------------------------------------------------------------------------------------------------
$consulta = "SELECT * FROM personas
LIMIT $start_from, $per_page_record"; //determine the sql LIMIT starting number for the results on the displaying page  
$conexion = mysqli_connect($servidor, $usuario, $contraseña, $baseDatos) or die("No se ha podido conectar al servidor de Base de datos");
$resultado = mysqli_query($conexion, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

//Tabla inicial-----------------------------------------------------------------------------------------------------------------------------------------------

    if ((!$_POST && !$_GET ) || $page_no){
echo '<br/><a href="ejercicio4.php?accion=C&IdPersona=0" class="agregar">Agregar nuevo<a/></br></br>' . PHP_EOL; 
echo '<table style="width:100%">' . PHP_EOL;
echo "<tr>
        <th>ID Persona</th>
          <th>NIF</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Usuario</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </tr>" . PHP_EOL;
while ($columna = mysqli_fetch_array($resultado)) {
    echo '<tr>
          <td>' . $columna['IdPersona'] . '</td>
          <td>' . $columna['NIFNIE'] . '</td>
          <td>' . $columna['Nombre'] . '</td>
          <td>' . $columna['Apellidos'] . '</td>
          <td>' . $columna['Usuario'] . '</td>
          <td><a href="ejercicio4.php?accion=U&IdPersona=' . $columna['IdPersona'] . '" class="active">Modificar</a></td>
          <td><a href="ejercicio4.php?accion=D&IdPersona=' . $columna['IdPersona'] . '" class="active">Eliminar</a></td>
        </tr>' . PHP_EOL;
}
echo '</table>' . PHP_EOL;

//Variables de la base de datos para la paginacion------------------------------------------------------------------------------------------------------------------------------------------>
$consulta = "SELECT COUNT(*) FROM archivos";
$resultado = mysqli_query($conexion, $consulta);
$columna = mysqli_fetch_row($resultado);
$total_records = $columna[0];
// Number of pages required.   
$total_pages = ceil($total_records / $per_page_record);
$second_last = $total_pages - 1;
$paglink = "";
if ($page_no > 1) {
}
?>

<!--Paginacion botones---------------------------------------------------------------------------------------------------------------------------------------------->
<div class="pagination3">
    <?php
    $consulta = "SELECT COUNT(*) FROM personas";
    $resultado = mysqli_query($conexion, $consulta);
    $columna = mysqli_fetch_row($resultado);
    $total_records = $columna[0];

    echo "</br>";
    // Number of pages required.   
    $total_pages = ceil($total_records / $per_page_record);
    $pagLink = "";

    if ($page_no >= 2) {
        echo "<a href='Ejercicio4.php?page_no=" . ($page_no - 1) . "'>  Prev </a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page_no) {
            $pagLink .= "<a class = 'active'  disabled>" . $i . " </a>";
        } else {
            $pagLink .= "<a href='Ejercicio4.php?page_no=" . $i . "'>   
                                          " . $i . " </a>";
        }
    };
    echo $pagLink;

    if ($page_no < $total_pages) {
        echo "<a href='Ejercicio4.php?page_no=" . ($page_no + 1) . "'>  Next </a>";
    }

    ?>
</div>

<?php
}else{
/*echo '<pre>';
	var_dump ($_GET);
	var_dump ($_POST);
echo'</pre>';
die();*/
if($_GET && !$_POST){
$accion = $_GET['accion'];
$IdPersona = $_GET['IdPersona'];

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

$servidor = 'localhost';
$usuario = 'root';
$contraseña = '';
$baseDatos = 'archivos';
$conexion = mysqli_connect($servidor, $usuario, $contraseña, $baseDatos) or die("No se ha podido conectar al servidor de Base de datos");
$consulta = "SELECT * FROM personas WHERE IdPersona = '".$IdPersona."';";
$resultado = mysqli_query($conexion, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
$fila = mysqli_fetch_array($resultado);
if($accion!="C"){
$NIFNIE = $fila["NIFNIE"];
$nombre = $fila["Nombre"];
$apellidos = $fila["Apellidos"];
$user = $fila["Usuario"];
}
?>
<!--Formulario de captura-------------------------------------------------------------------------------------------------------------------------->

<div class="formulario">
	<h3>Registro a <?php echo $texto; ?></h3>
    <form action="" method="post" enctype="multipart/form-data">
        Nombre: <br/>
        <input type="text" name="nombre" value="<?php if($accion=="C"){echo "";}else{echo "$nombre";}?>" <?php if($accion=="D"){echo "readonly";}else{echo "required";}?>><br/>
        Apellidos: <br/>
        <input type="text" name="apellidos" value="<?php if($accion=="C"){echo "";}else{echo "$apellidos";}?>" <?php if($accion=="D"){echo "readonly";}else{echo "required";}?>><br/>
        NIF: <br/>
        <input type="text" name="NIFNIE" pattern="[0-9]{8}[A-Za-z]{1}" value= "<?php if($accion=="C"){echo "";}else{echo "$NIFNIE";}?>" <?php if($accion=="D"){echo "readonly";}else{echo "required";}?>><br/>
        Usuario: <br/>
        <input type="text" name="usuario" value="<?php if($accion=="C"){echo "";}else{echo "$user";}?>" <?php if($accion=="D"){echo "readonly";}else{echo "required";}?>><br/>

        <input type="submit" name="enviar" value="<?php echo ucfirst($texto); ?>">
        <input type="reset" name="limpiar" value="Borrar">
		<input type="hidden" name="IdPersona" value="<?php echo "$IdPersona"?>">

    </form>
</div>

<?php
}else{
	if($_POST){
        $accion = $_GET['accion'];
		$IdPersona = $_GET['IdPersona'];
		$nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $NIF = $_POST["NIFNIE"];
        $user = $_POST["usuario"];

        $servidor = 'localhost';
        $usuario = 'root';
        $contraseña = '';
        $baseDatos = 'archivos';
        if($accion=="C"){$consulta = "INSERT INTO personas (Nombre, Apellidos, NIFNIE, Usuario) VALUES ('".$nombre."', '".$apellidos."', '".$NIF."', '".$user."')";}
		if($accion=="U"){$consulta = "UPDATE personas 
		SET Nombre='".$nombre."',
		Apellidos='".$apellidos."',
		NIFNIE='".$NIF."',
		Usuario='".$user."'
		WHERE IdPersona = ".$IdPersona.";";
		}
		if($accion=="D"){$consulta = "DELETE FROM personas WHERE IdPersona = ".$IdPersona.";";}
        $conexion = mysqli_connect($servidor, $usuario, $contraseña, $baseDatos) or die("No se ha podido conectar al servidor de Base de datos");
        $resultado = mysqli_query($conexion, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
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
        Nombre: <br/>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>" readonly><br/>
        Apellidos: <br/>
        <input type="text" name="apellido" value="<?php echo $apellidos; ?>" readonly><br/>
        NIF: <br/>
        <input type="text" name="nif" value="<?php echo $NIF; ?>" readonly><br/>
        Usuario: <br/>
        <input type="text" name="usuario" value="<?php echo $user; ?>"  readonly><br/>

        <input type="submit" name="enviar" value="Aceptar">
    </form>
</div>
<?php
				}
		}
}

include "../Vista/piePagina.phtml";
?>