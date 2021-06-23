<?php
$titulo = "Ejercicio 7";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 7</h1>" . PHP_EOL;

require_once '../Modelo/ClasesBaseDatos/BaseDatos.php';
/**
 * class CRUD
 * Clase para Create, Read, Update y Delete sobre una base de datos
 */
class CRUD extends BaseDatos
{
	private $pSQL_C;
	private $pSQL_R;
	private $pSQL_U;
	private $pSQL_D;

	function setDatos($BaseDatos)
	{
		$this->pDatos = $BaseDatos;
	} // end of member function setDatos

	function setSQL_C($query)
	{
		$this->pSQL_C = $query;
	} // end of member function setSQL_C
	function setSQL_R($query)
	{
		$this->pSQL_R = $query;
	} // end of member function setSQL_R

	function setSQL_U($query)
	{
		$this->pSQL_U = $query;
	} // end of member function setSQL_U

	function setSQL_D($query)
	{
		$this->pSQL_D = $query;
	} // end of member function setSQL_D

	function __construct($BaseDatos,  $SQL_C = "",  $SQL_R = "",  $SQL_U = "",  $SQL_D = "")
	{
		parent::__construct($BaseDatos);
		if ($SQL_C != "") {
			$this->setSQL_C($SQL_C);
		} // END IF
		if ($SQL_R != "") {
			$this->setSQL_R($SQL_R);
		} // END IF
		if ($SQL_U != "") {
			$this->setSQL_U($SQL_U);
		} // END IF
		if ($SQL_D != "") {
			$this->setSQL_D($SQL_D);
		} // END IF
	} // end of member function __construct

	function agregaRegistro($query = "")
	{
		if ($query != "") {
			$this->setSQL_C($query);
		} // END IF
		$retorno = $this->execute($this->pSQL_C);
		return $retorno;
	} // end of member function agregaRegistro

	function buscaRegistro($query = "")
	{
		if ($query != "") {
			$this->setSQL_R($query);
		} // END IF
		$retorno = $this->getData($this->pSQL_R);
		return $retorno;
	} // end of member function buscaRegistro

	function modificaRegistro($query = "")
	{
		if ($query != "") {
			$this->setSQL_U($query);
		} // END IF
		$retorno = $this->execute($this->pSQL_U);
		return $retorno;
	} // end of member function modificaRegistro

	function eliminaRegistro($query = "")
	{
		if ($query != "") {
			$this->setSQL_D($query);
		} // END IF
		$retorno = $this->execute($this->pSQL_D);
		return $retorno;
	} // end of member function eliminaRegistro

	function listaRegistros($query = "")
	{
		if ($query != "") {
			$this->setSQL_R($query);
		} // END IF
		$retorno = $this->setData($this->pSQL_R);
		return $retorno;
	} // end of member function listaRegistros

	function tablaRegistro($query = "")
	{
		if ($query != "") {
			$this->setSQL_R($query);
		} // END IF
		$retorno = $this->getData($this->pSQL_R);
		$array = array();
		$array[] = ' <table width=100%">' . PHP_EOL;

		foreach ($retorno as $key => $value) {
			// echo '<pre>';
			// var_dump($value);
			// echo '</pre>';
			// die();
			/*
            [0]=>
            array(5) {
                ["IdPersona"]=>
                string(1) "1"
                ["NIFNIE"]=>
                string(9) "11216428H"
                ["Nombre"]=>
                string(6) "Marisa"
                ["Apellidos"]=>
                string(5) "Alvez"
                ["Usuario"]=>
                string(6) "AlvMar"
            }
            */
			if ($key == 0) {
				$array[] = ' <tr>' . PHP_EOL;
				foreach ($value as $cod => $columna) {
					$array[] = ' <th>' . $cod . '</th>' . PHP_EOL;
				}
				$array[] = '<th>Modificar</th>' . PHP_EOL;
				$array[] =  '<th>Eliminar</th>' . PHP_EOL;
				$array[] = ' </tr>' . PHP_EOL;
				$array[] = ' <tr>' . PHP_EOL;
			}

			$identificador = "";
			foreach ($value as $cod => $columna) {
				$array[] = '                    <td class="izquierda">' . $columna . '</td>' . PHP_EOL;
				if ($identificador == "") {
					$identificador = $columna;
				}
			}
			$array[] = '<td><a href="ejercicio7.php?accion=U&IdPersona=' . $identificador . '" class="active">Modificar</a></td>' . PHP_EOL;
			$array[] = '<td><a href="ejercicio7.php?accion=D&IdPersona=' . $identificador . '" class="active">Eliminar</a></td>' . PHP_EOL;
			$array[] = ' </tr>' . PHP_EOL;
		} // END FOREACH
		$array[] = '</table>' . PHP_EOL;
		return $array;
	}
} // end of CRUD

$queryc = "INSERT INTO personas ";
$queryc .= "(NIFNIE, Nombre, Apellidos, Usuario)";
$queryc .= " VALUES('12312312M','A BORRAR','Benitez', 'baibai');";
$queryr = "SELECT * FROM personas";
$objeto = new CRUD("archivos", $queryc, $queryr);

if (!$_POST && !$_GET ){
	echo '<br/><a href="ejercicio7.php?accion=C&IdPersona=0" class="agregar">Agregar nuevo<a/></br></br>' . PHP_EOL;

	foreach ($objeto->tablaRegistro() as $key => $value) {
		echo $value;
	}
} else {
	$accion = $_GET['accion'];
	$IdPersona = $_GET['IdPersona'];
	$query = "SELECT * FROM personas WHERE IdPersona = '" . $IdPersona . "';";
	
	if ($accion != "C") {
		$fila = $objeto->buscaRegistro($query);
		$fila = $fila[0];
		$NIFNIE = $fila["NIFNIE"];
		$nombre = $fila["Nombre"];
		$apellidos = $fila["Apellidos"];
		$user = $fila["Usuario"];
	} else {
		$NIFNIE = "";
		$nombre = "";
		$apellidos = "";
		$user = "";
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
				<input type="text" name="nombre" value="<?php if ($accion == "C") {echo "";} else {echo "$nombre";} ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";} ?>><br />
				Apellidos: <br />
				<input type="text" name="apellidos" value="<?php if ($accion == "C") {echo "";} else {echo "$apellidos";} ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";}?>><br />
				NIF: <br />
				<input type="text" name="NIFNIE" pattern="[0-9]{8}[A-Za-z]{1}" value="<?php if ($accion == "C") {echo "";} else {echo "$NIFNIE";} ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";} ?>><br />
				Usuario: <br />
				<input type="text" name="usuario" value="<?php if ($accion == "C") {echo "";} else {echo "$user";} ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";} ?>><br />

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
			$nombre = $_POST["nombre"];
			$apellidos = $_POST["apellidos"];
			$NIF = $_POST["NIFNIE"];
			$user = $_POST["usuario"];

			if ($accion == "C") {
				$query = "INSERT INTO personas ";
				$query .= "(NIFNIE, Nombre, Apellidos, Usuario)";
				$query .= " VALUES ('" . $NIF . "', '" . $nombre . "', '" . $apellidos . "', '" . $user . "');";
				$objeto->agregaRegistro($query);
			}
			if ($accion == "U") {
				$query = "UPDATE personas ";
				$query .= "SET Nombre='" . $nombre . "', Apellidos='" . $apellidos . "', NIFNIE='" . $NIF . "', Usuario='" . $user . "'";
				$query .= "WHERE IdPersona = " . $IdPersona . ";";
				$objeto->modificaRegistro($query);
			}
			if ($accion == "D") {
				$query = "DELETE FROM personas ";
				$query .= "WHERE IdPersona = " . $IdPersona . ";";
				$objeto->eliminaRegistro($query);
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
					<input type="text" name="nombre" value="<?php echo $nombre; ?>" readonly><br />
					Apellidos: <br />
					<input type="text" name="apellido" value="<?php echo $apellidos; ?>" readonly><br />
					NIF: <br />
					<input type="text" name="nif" value="<?php echo $NIF; ?>" readonly><br />
					Usuario: <br />
					<input type="text" name="usuario" value="<?php echo $user; ?>" readonly><br />

					<input type="submit" name="enviar" value="Aceptar">
				</form>
			</div>


<?php
		}
	}
}

include "../Vista/piePagina.phtml";
?>