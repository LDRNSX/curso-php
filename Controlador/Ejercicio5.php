<?php
$titulo = "Ejercicio 5";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo "		<h1>Ejercicio 5</h1>" . PHP_EOL;

//Declaracion de la clase------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//La definición básica de una clase comienza con la palabra reservada class, seguida de un nombre de clase,
//y continuando con un par de llaves que encierran las definiciones de las propiedades y métodos pertenecientes a dicha clase.
class DBConfig
{
//Las constantes se diferencian de las variables comunes en que no utilizan el símbolo $ al declararlas o emplearlas. 
//La visibilidad predeterminada de las constantes de clase es public.
const SERVER = "localhost";
const DBUSER = "root";
const PSSWRD = "";

//Las variables pertenecientes a una clase se llaman "propiedades".
//Las propiedades de clases deben ser definidas como 'public', 'private' o 'protected'. 
//A los miembros de clase declarados como 'public' se puede acceder desde donde sea
//A los miembros declarados como 'protected', solo desde la misma clase, mediante clases heredadas o desde la clase padre.
//A los miembros declarados como 'private' únicamente se puede acceder desde la clase que los definió.
protected $pDBName;
protected $pConnection;

//Funcion=metodo de la clase
//Constructor:
/*protected*/ function __construct($DBName)
{
//This hace referencia al objeto actual, es decir, cuando una clase si tiene instancia. No se puede hacer referencia a métodos estáticos usando this pero si a métodos públicos, privados y protegidos.
//Self hace referencia a la clase actual y se usa cuando se instancia dicha clase, es decir se usan métodos estáticos.
//El doble dos-puntos, es un token que permite acceder a elementos estáticos, constantes, y sobrescribir propiedades o métodos de una clase.
$this->pDBName=$DBName;
if(!isset($this->pConnection)) {
$this->pConnection = new mysqli(self::SERVER, self::DBUSER, self::PSSWRD, $this->pDBName);
if(!$this->pConnection) {
echo "<h1>Error, no se ha podido conectar con la base de datos</h1>" . PHP_EOL;
exit;
} // END IF
} // END IF
} // end of member function __construct
} // end of DBConfig

//Proceso para usar la clase-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$objeto = new DBconfig ("archivos");//Instanciar el objeto
echo "<pre>" . PHP_EOL;
var_dump($objeto);
echo "</pre>" . PHP_EOL;
echo '<a href="index.php" class="volver">Volver al inicio</a>' . PHP_EOL;

include "../Vista/piePagina.phtml";
?>