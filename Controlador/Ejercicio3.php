<?php
$titulo = "Ejercicio 3";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 3</h1>" . PHP_EOL;

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

//Tabla-----------------------------------------------------------------------------------------------------------------------------------------------
echo '<br/><a href="ejercicio2.php" class="agregar">Agregar nuevo<a/></br></br>' . PHP_EOL;
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
          <td><a href="ejemplo3U.php?IdPersona=' . $columna['IdPersona'] . '" class="active">Modificar</a></td>
          <td><a href="ejemplo3D.php?IdPersona=' . $columna['IdPersona'] . '" class="active">Eliminar</a></td>
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
        echo "<a href='Ejercicio3.php?page_no=" . ($page_no - 1) . "'>  Prev </a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page_no) {
            $pagLink .= "<a class = 'active'  disabled>" . $i . " </a>";
        } else {
            $pagLink .= "<a href='Ejercicio3.php?page_no=" . $i . "'>   
                                          " . $i . " </a>";
        }
    };
    echo $pagLink;

    if ($page_no < $total_pages) {
        echo "<a href='Ejercicio3.php?page_no=" . ($page_no + 1) . "'>  Next </a>";
    }

    ?>
</div>
<?php
include "../Vista/piePagina.phtml";
?>