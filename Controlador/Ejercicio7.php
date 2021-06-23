<?php
$titulo = "Ejercicio 7";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 7</h1>" . PHP_EOL;
echo '<br/><a href="ejercicio7.php?accion=C&IdPersona=0" class="agregar">Agregar nuevo<a/></br></br>' . PHP_EOL;

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
		$retorno = $this->setData($this->pSQL_R);
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
		$array[] = ' <table border="1">' . PHP_EOL;

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
if (!$_POST && !$_GET) {
	$query = "INSERT INTO personas ";
	$query .= "(NIFNIE, Nombre, Apellidos, Usuario)";
	$query .= " VALUES('12312312M','A BORRAR','Benitez', 'baibai');";
	$objeto = new CRUD("archivos", $query, "SELECT * FROM personas;");

	foreach ($objeto->tablaRegistro() as $key => $value) {
		echo $value;
	}
} else {
	if ($_GET && !$_POST) {
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

		$fila = mysqli_fetch_array($resultado);
		$NIFNIE = $fila["NIFNIE"];
		$nombre = $fila["Nombre"];
		$apellidos = $fila["Apellidos"];
		$user = $fila["Usuario"];
?>
<!--Formulario de captura-------------------------------------------------------------------------------------------------------------------------->

		<div class="formulario">
			<h3>Registro a <?php echo $texto; ?></h3>
			<form action="" method="post" enctype="multipart/form-data">
				Nombre: <br />
				<input type="text" name="nombre" value="<?php echo "$nombre" ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";} ?> /><br />
				Apellidos: <br />
				<input type="text" name="apellidos" value="<?php echo "$apellidos" ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";} ?> /><br />
				NIF: <br />
				<input type="text" name="NIFNIE" pattern="[0-9]{8}[A-Za-z]{1}" value="<?php echo "$NIFNIE" ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";} ?> /><br />
				Usuario: <br />
				<input type="text" name="usuario" value="<?php echo "$user" ?>" <?php if ($accion == "D") {echo "readonly";} else {echo "required";} ?> /><br />

				<input type="submit" name="enviar" value="<?php echo $texto; ?>" />
				<input type="reset" name="limpiar" value="Borrar" />
				<input type="hidden" name="IdPersona" value="<?php echo "$IdPersona" ?>">

			</form>
		</div>

		<?php
	} else {
		if ($_POST) {
			$IdPersona = $_GET['IdPersona'];
			$nombre = $_POST["nombre"];
			$apellidos = $_POST["apellidos"];
			$NIF = $_POST["NIFNIE"];
			$user = $_POST["usuario"];

			if ($accion = "C") {
				$consulta = "INSERT INTO personas (Nombre, Apellidos, NIFNIE, Usuario) VALUES ('" . $nombre . "', '" . $apellidos . "', '" . $NIF . "', '" . $user . "')";
			}
			if ($accion = "U") {
				$consulta = "UPDATE personas 
		SET Nombre='" . $nombre . "',
		Apellidos='" . $apellidos . "',
		NIFNIE='" . $NIF . "',
		Usuario='" . $user . "'
		WHERE IdPersona = " . $IdPersona . ";";
			}
			if ($accion = "D") {
				$consulta = "DELETE FROM personas WHERE IdPersona = " . $IdPersona . ";";
			}
			echo $consulta;

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
				<h3>Registro a <?php echo $texto; ?></h3>
				<form action="index.php" method="post" enctype="multipart/form-data">
					Nombre: <br />
					<input type="text" name="nombre" value="<?php echo $nombre; ?>" readonly /><br />
					Apellidos: <br />
					<input type="text" name="apellido" value="<?php echo $apellidos; ?>" readonly /><br />
					NIF: <br />
					<input type="text" name="nif" value="<?php echo $NIF; ?>" readonly /><br />
					Usuario: <br />
					<input type="text" name="usuario" value="<?php echo $user; ?>" readonly /><br />

					<input type="submit" name="enviar" value="Aceptar" />
				</form>
			</div>


<?php
		}
	}
}

include "../Vista/piePagina.phtml";
?>