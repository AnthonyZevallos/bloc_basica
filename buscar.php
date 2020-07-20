<?php

require_once 'login.php';


$conexion = new mysqli($hn, $un, $pw, $db);
if($conexion->connect_error) die("falla en conexion");

/*-------------preguntando si no esta ocupado de lo que hace submit el formulario con nombre buscar  */

if(!isset($_POST['buscar'])){
   $_POST['buscar']="";
   $buscar=$_POST['buscar'];
}

$buscar=$_POST['buscar'];

/*------------la consulta para buscar ----------------*/

$query ="SELECT * FROM anotes WHERE id_nota LIKE '%".$buscar."%' OR usuarioA LIKE '%".$buscar."%' OR fecha  LIKE '%".$buscar."%' OR titulo  LIKE '%".$buscar."%' OR  descripcion  LIKE '%".$buscar."%'";

 $result = $conexion->query($query);
if (!$result) die ("Falló el acceso a la base de datos thony");

$sql_query =mysqli_query($conexion,$query);

?>