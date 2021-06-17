<?php
$titulo = "Ejercicio 1";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 1</h1>" . PHP_EOL;
$servidor = 'localhost';
$usuario = 'root';
$contraseña = '';
$baseDatos = 'archivos';

//Paginacion----------------------------------------------------------------------------------------------------------------------------------------------
$per_page_record = 15;  // Number of entries to show in a page.   
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
$consulta = "SELECT IdArchivo, Ruta, NombreArchivo, Tamaño, IdPersona, FechaCreado, FechaModifica, Descripción 
FROM archivos A JOIN rutas as R ON R.IdRuta= A.IdRuta 
JOIN `Tipos de Contenidos` as T ON T.IdTIpoContenido = A.IdTIpoContenido
LIMIT $start_from, $per_page_record";//determine the sql LIMIT starting number for the results on the displaying page  

$conexion = mysqli_connect($servidor, $usuario, $contraseña, $baseDatos) or die("No se ha podido conectar al servidor de Base de datos");
$resultado = mysqli_query($conexion, "SET NAMES 'utf8'");
$resultado = mysqli_query($conexion, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

//Tabla-----------------------------------------------------------------------------------------------------------------------------------------------
echo '<table style="width:100%">' . PHP_EOL;
echo "<tr>
        <th>ID archivo</th>
          <th>ID ruta</th>
          <th>Nombre del archivo</th>
          <th>Tamaño</th>
          <th>ID persona</th>
          <th>Fecha de creación</th>
          <th>Última fecha de modificación</th>
          <th>ID tipo de contenido</th>
        </tr>" . PHP_EOL;
while ($columna = mysqli_fetch_array($resultado)) {
  echo '<tr>
          <td>' . $columna['IdArchivo'] . '</td>
          <td>' . $columna['Ruta'] . '</td>
          <td>' . $columna['NombreArchivo'] . '</td>
          <td>' . $columna['Tamaño'] . '</td>
          <td>' . $columna['IdPersona'] . '</td>
          <td>' . $columna['FechaCreado'] . '</td>
          <td>' . $columna['FechaModifica'] . '</td>
          <td>' . $columna['Descripción'] . '</td>
        </tr>' . PHP_EOL;
}
echo '</table>' . PHP_EOL;
?>

<!--Variables de la base de datos para la paginacion------------------------------------------------------------------------------------------------------------------------------------------>
<?php
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

<!-- Paginacion--------------------------------------------------------------------------------------------------------------------------------->
<div class="pagination">
  
<!-- Boton nº pagina--------------------------------------------------------------------------------------------------------------------------------->
<div class="ir">
  <input id="page" type="number" min="1" max="<?php echo $total_pages ?>" placeholder="<?php echo $page_no . "/" . $total_pages; ?>" required>
  <button onClick="go2Page();">Ir</button>
</div>

<script>
  function go2Page() {
    var page = document.getElementById("page").value;
    page = ((page > <?php echo $total_pages; ?>) ? <?php echo $total_pages; ?> : ((page < 1) ? 1 : page));
    window.location.href = 'ejercicio1.php?page=' + page;
  }
</script>

<!-- Botones para moverte de paginas, siguiente, anterior, etc--------------------------------------------------------------------------------------------------------------------------------->
<?php if($page_no > 1){
echo "<div><a href='?page_no=1'>Primera</a></div>";
} ?>
    
<div <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
<a <?php if($page_no > 1){
echo "href='?page_no=$previous_page'";
} ?>>Anterior</a>
</div>

<?php
if ($total_pages <= 10){  	 
	for ($counter = 1; $counter <= $total_pages; $counter++){
	if ($counter == $page_no) {
	echo "<div class='active'><a>$counter</a></div>";	
	        }else{
        echo "<div><a href='?page_no=$counter'>$counter</a></div>";
                }
        }
}
if($page_no <= 4) {			
  for ($counter = 1; $counter < 8; $counter++){		 
   if ($counter == $page_no) {
      echo "<div class='active'><a>$counter</a></div>";	
     }else{
            echo "<div><a href='?page_no=$counter'>$counter</a></div>";
                 }
 }
 echo "<div><a>...</a></div>";
 echo "<div><a href='?page_no=$second_last'>$second_last</a></div>";
 echo "<div><a href='?page_no=$total_pages'>$total_pages</a></div>";
 }
elseif($page_no > 4 && $page_no < $total_pages - 4) {		 
  echo "<div><a href='?page_no=1'>1</a></div>";
  echo "<div><a href='?page_no=2'>2</a></div>";
  echo "<div><a>...</a></div>";
  for (
       $counter = $page_no - $adjacents;
       $counter <= $page_no + $adjacents;
       $counter++
       ) {		
       if ($counter == $page_no) {
    echo "<div class='active'><a>$counter</a></div>";	
    }else{
          echo "<div><a href='?page_no=$counter'>$counter</a></div>";
            }                  
         }
  echo "<div><a>...</a></div>";
  echo "<div><a href='?page_no=$second_last'>$second_last</a></div>";
  echo "<div><a href='?page_no=$total_pages'>$total_pages</a></div>";
  }
?>

<div <?php if($page_no >= $total_pages){
echo "class='disabled'";
} ?>>
<a <?php if($page_no < $total_pages) {
echo "href='?page_no=$next_page'";
} ?>>Siguiente</a>
</div>

<?php if($page_no < $total_pages){
echo "<div><a href='?page_no=$total_pages'>Última &rsaquo;&rsaquo;</a></div>";
} ?>
</div>


<?php
include "../Vista/piePagina.phtml";
?>