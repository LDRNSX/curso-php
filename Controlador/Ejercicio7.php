<?php
$titulo = "Ejercicio 7";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 7</h1>" . PHP_EOL;

require_once '../Modelo/ClasesBaseDatos/BaseDatos.php';

class CRUD extends BaseDatos{
    private $pSQL_C;
    private $pSQL_R;
    private $pSQL_U;
    private $pSQL_D;

    protected function setDatos( $BaseDatos){
    $this->pDatos=$BaseDatos;
    } 

    /*protected*/ function setSQL_C( $query){
    $this->pSQL_C=$query;
    } 

    /*protected*/ function setSQL_R( $query){
    $this->pSQL_R=$query;
    } 

    /*protected*/ function setSQL_U( $query){
    $this->pSQL_U=$query;
    }

    /*protected*/ function setSQL_D( $query){
    $this->pSQL_D=$query;
    } 
    /*protected*/ function __construct( $BaseDatos,  $SQL_C = "",  $SQL_R = "",  $SQL_U = "",  $SQL_D = "")
	{
		parent::__construct($BaseDatos);
		if($SQL_C != "") {
			$this->setSQL_C($SQL_C);
		} // END IF
		if($SQL_R != "") {
			$this->setSQL_R($SQL_R);
		} // END IF
		if($SQL_U != "") {
			$this->setSQL_U($SQL_U);
		} // END IF
		if($SQL_D !="") {
			$this->setSQL_D($SQL_D);
		} // END IF
	} // end of member function __construct
	/**
	 * Ejecuta la sentencia SQL del INSERT
	 *
	 * @param string $query Sentencia SQL del INSERT
	 * @return bool
	 * @access protected
	 */
	/*protected*/ function agregaRegistro( $query = "")
	{
		if($query != ""){
			$this->setSQL_C($query);
		} // END IF
		$retorno=$this->execute($this->pSQL_C);
	return $retorno;
	} // end of member function agregaRegistro
	/**
	 * Ejecuta la sentencia SQL del INSERT
	 *
	 * @param string $query Sentencia SQL del SELECT
	 * @return array
	 * @access protected
	 */
	/*protected*/ function buscaRegistro( $query = "")
	{
		if($query != ""){
			$this->setSQL_R($query);
		} // END IF
		$retorno=$this->setData($this->pSQL_R);
		return $retorno;		
	} // end of member function buscaRegistro
	/**
	 * Ejecuta la sentencia SQL del UPDATE
	 *
	 * @param string $query Sentencia SQL del UPDATE
	 * @return bool
	 * @access protected
	 */
	/*protected*/ function modificaRegistro( $query = "")
	{
		if($query != ""){
			$this->setSQL_U($query);
		} // END IF
		$retorno=$this->execute($this->pSQL_U);
		return $retorno;			
	} // end of member function modificaRegistro
	/**
	 * Ejecuta la sentencia SQL del UPDATE
	 *
	 * @param string $query Sentencia SQL del DELETE
	 * @return bool
	 * @access protected
	 */
	/*protected*/ function eliminaRegistro( $query = "")
	{
		if($query != ""){
			$this->setSQL_D($query);
		} // END IF
		$retorno=$this->execute($this->pSQL_D);
		return $retorno;			
	} // end of member function eliminaRegistro
	/**
	 * Ejecuta la sentencia SQL del SELECT
	 *
	 * @param string $query Sentencia SQL del SELECT
	 * @return array
	 * @access protected
	 */
	/*protected*/ function listaRegistros( $query = "")
	{
		if($query != ""){
			$this->setSQL_R($query);
		} // END IF
		$retorno=$this->setData($this->pSQL_R);
		return $retorno;		
	} // end of member function listaRegistros

        function tablaRegistro($query=""){
            if($query != ""){
    $this->setSQL_R($query);
    } // END IF
    $retorno=$this->getData($this->pSQL_R);
    $array = array();
            $array[]= ' <table border="1">' . PHP_EOL;
          foreach($retorno as $key => $value){
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
    if($key == 0) {
    $array[]= ' <tr>' . PHP_EOL;
    foreach($value as $cod => $columna) {
    $array[]= ' <th>' . $cod .'</th>' . PHP_EOL;
    }
    $array[]= ' </tr>' . PHP_EOL;
    $array[]= ' <tr>' . PHP_EOL;
    }
    foreach($value as $cod =>$columna) {
    $array[]= '                    <td class="izquierda">' . $columna . '</td>' . PHP_EOL;
    }
    $array[]= ' </tr>' . PHP_EOL;
            } // END FOREACH
            $array[]= '</table>' . PHP_EOL;
            return $array;
        }

    function formRegistro($query=""){
        if($query != ""){
			$this->setSQL_R($query);
		} // END IF
		$retorno=$this->setData($this->pSQL_R);
		return $retorno;
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
    }
} // end of CRUD


//$objeto = new CRUD ("archivos");//Instanciar el objeto
/*echo "<pre>" . PHP_EOL;
var_dump($objeto);
echo "</pre>" . PHP_EOL;*/
$numero = 52;
$query = "INSERT INTO personas ";
$query.= "(Nombre, Apellidos, NIFNIE, Usuario)";
$query.= " VALUES('A BORRAR', 'borron', '22222222X', 'borrar');";
 $SQL_C = $query;
 $query = "SELECT * FROM personas ";
 $query.= " WHERE IdPersona = $numero;";
 $SQL_R = $query;
 $query = "UPDATE personas SET ";
 $query.= " Nombre = 'A-Borrar'";
 $query.= " WHERE IdPersona = $numero;";
 $SQL_U = $query;
 $query = "DELETE FROM personas ";
 $query.= " WHERE IdPersona > 52;";
 $SQL_D = $query;
 $objeto = new CRUD("archivos", $SQL_C, $SQL_R, $SQL_U, $SQL_D );
 echo "		<pre>" . PHP_EOL;
 /*var_dump($objeto);
 var_dump($objeto->agregaRegistro($SQL_C));
 var_dump($objeto->buscaRegistro($SQL_R));
 var_dump($objeto->modificaRegistro($SQL_U));
 var_dump($objeto->eliminaRegistro($SQL_D));
 var_dump($objeto->listaRegistros("SELECT * FROM personas"));*/
 $objeto -> tablaRegistro("SELECT * FROM personas");
 echo "		</pre>" . PHP_EOL;
echo '<a href="index.php" class="volver">Volver al inicio</a>' . PHP_EOL;

include "../Vista/piePagina.phtml";
?>