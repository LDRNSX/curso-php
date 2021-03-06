<?php
$titulo = "Ejercicio 8";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 8</h1>" . PHP_EOL;
echo '<br/><a href="ejercicio8.php?accion=C&IdPersona=0" class="agregar">Agregar nuevo<a/></br></br>' . PHP_EOL;

require_once '../Modelo/CRUD.php';

class personas extends CRUD{
	public $IdPersona;
	public $NIFNIE;
	public $Nombre;
	public $Apellidos;
	public $Usuario;
	const BASEDATOS = "archivos";
	
	function getIdPersona(){
		return $this->IdPersona;
	} 
	
	 function setIdPersona( $query){
		$this->IdPersona=$query;
	} 
	
	function getNIFNIE(){
		return $this->NIFNIE;
	} 
	
	 function setNIFNIE( $query){
		$this->NIFNIE=$query;
	}
	
	function getNombre(){
		return $this->Nombre;
	} 

	 function setNombre( $query){
		$this->Nombre=$query;
	}
	
	function getApellidos(){
		return $this->Apellidos;
	} 

	 function setApellidos( $query){
		$this->Apellidos=$query;
	}
	
	function getUsuario(){
		return $this->Usuario;
	} 

	 function setUsuario( $query){
		$this->Usuario=$query;
	}
	
	 function __construct($IdPersona = "",  $NIFNIE = "",  $Nombre = "",  $Apellidos = "", $Usuario= "")
	{
		parent::__construct(self::BASEDATOS);
		if($IdPersona != "") {
			$this->setIdPersona($IdPersona);
		} // END IF
		if($NIFNIE != "") {
			$this->setNIFNIE($NIFNIE);
		} // END IF
		if($Nombre != "") {
			$this->setNombre($Nombre);
		} // END IF
		if($Apellidos !="") {
			$this->setApellidos($Apellidos);
		} // END IF
		if($Usuario !="") {
			$this->setUsuario($Usuario);
		} // END IF
	} // end of member function __construct
	
	function agregaDatos()
	{
		$query = "INSERT INTO " . $this->BASEDATOS . "(NIFNIE, Nombre, Apellidos, Usuario) VALUES ('". $this->NIFNIE ."', '". $this->Nombre ."', '". $this->Apellidos ."', '". $this->Usuario ."')";
		parent::agregaRegistro( $query);
		if($query != ""){
			$this->setSQL_C($query);
		} // END IF
		$retorno=$this->execute($this->pSQL_C);
	return $retorno;
	} // end of member function agregaRegistro

	/* function buscaDatos()
	{
		parent::buscaRegistro();
		if($query != ""){
			$this->setSQL_R($query);
		} // END IF
		$retorno=$this->setData($this->pSQL_R);
		return $retorno;		
	} // end of member function buscaRegistro
*/
	 function modificaDatos()
	{
		$query = "UPDATE personas SET Nombre='". $this->Nombre ."', Apellidos='". $this->Apellidos ."',	NIFNIE='". $this->NIFNIE ."',	Usuario='". $this->Usuario ."'	WHERE IdPersona = ". $this->IdPersona .";";
		parent::modificaRegistro( $query);
		if($query != ""){
			$this->setSQL_U($query);
		} // END IF
		$retorno=$this->execute($this->pSQL_U);
		return $retorno;			
	} // end of member function modificaRegistro

	 function eliminaDatos()
	{
		$query = "DELETE FROM personas WHERE IdPersona = ".$this->IdPersona.";";
		parent::eliminaRegistro( $query);
		if($query != ""){
			$this->setSQL_D($query);
		} // END IF
		$retorno=$this->execute($this->pSQL_D);
		return $retorno;			
	} // end of member function eliminaRegistro

	 function listaDatos()
	{
		$query = "SELECT * FROM personas";
		parent::listaRegistros( $query );
		$retorno=$this->getData($query);
		return $retorno;		
	} // end of member function listaRegistros
	
	 function tablaDatos($Nombre){
		$query = "SELECT * FROM personas";
		return parent::tablaRegistro($Nombre, $query);
	
    }
}

$persona = new personas();
foreach($persona->tablaDatos("Ejercicio8.php") as $key=>$value){
	echo $value;
}

include "../Vista/piePagina.phtml";
?>
