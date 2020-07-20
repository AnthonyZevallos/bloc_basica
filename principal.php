<?php

require_once 'login.php';
$conexion = new mysqli($hn, $un, $pw, $db);
if($conexion->connect_error) die("falla en conexion");
//---------------------------------------------------------

//------------------------actualiazando ----------------------------------

if (isset($_POST['id_anotes']) && isset($_POST['tutilo']) && isset($_POST['anotes']))
 {
 $id_notes= get_post($conexion,'id_anotes');  
 $Tutilo= get_post($conexion,'tutilo');
 $Anotes= get_post($conexion,'anotes');  
    
    
 
 $query="UPDATE anotes SET titulo='$Tutilo',descripcion ='$Anotes' WHERE id_nota='$id_notes' ";
 $result = $conexion->query($query);  
 if (!$result) echo "UPDATE falló <br><br>";  
 }

//--------------------insertando datos a la tabla anotes-------****************************--
 if (isset($_POST['usuarioA']) &&
 isset($_POST['fecha']) &&
 isset($_POST['titulo']) &&
 isset($_POST['descripcion']))
 {
     
    
 $usuario = get_post($conexion, 'usuarioA');
 $fecha = get_post($conexion, 'fecha');
 $titulo = get_post($conexion, 'titulo');
 $descripcion = get_post($conexion, 'descripcion');

 $query = "INSERT INTO anotes(usuarioA,fecha,titulo,descripcion) VALUES"."('$usuario', '$fecha', '$titulo', '$descripcion')";
 $result = $conexion->query($query);
 if (!$result) echo "INSERT falló <br><br>";
 }
 echo <<<_END
 <h2>search</h2>
 <form name="search" method="post" action="principal.php" id="cdr" autocomplete="off">
 <input type="text" name="buscar" placeholder="Write and find">
 <input type="submit" name="submit" value="Search" >
 </form>
 
 <h2>ENTER YOUR NEW JOURNAL </h2>
 <form action="principal.php" method="post"><pre>
 NAME   <input type="text" name="usuarioA" placeholder="write your name" required/>
 DATE     <input type="date" name="fecha" placeholder="chosse the date" required/>
 TITLE   <input type="text" name="titulo" placeholder="write your title" required/>
 WRITE IN YOUR JOURNAL <textarea name="descripcion" cols="width" rows="height" wrap="type">
 </textarea> 
 <input type="submit" value="ADD RECORD">
 </pre></form>
 _END;
/*---------funcion para mostrar de la busqueda--------------*/
echo"<h3>here answer of your search</h3>";
/*include 'buscar.php';*/
require_once 'buscar.php';
echo"<table >";
 while($row=mysqli_fetch_array($sql_query , MYSQLI_NUM)){
   /* echo<<<_END
     <tr> 
     <td><? = $row ["id_nota"] ?></td>
     <td><? = $row ["usuarioA"] ?></td>
     <td><? = $row ["fecha"] ?></td>
     <td><? = $row ["titulo"] ?></td>
     <td><? = $row ["descripcion"] ?></td>
     </tr>
    _END;*/
     echo"********************";
     printf("contra: %s <br> Name: %s <br> Date: %s <br> Title: %s <br> Description: %s <br>",$row[0],$row[1],$row[2],$row[3],$row[4]);
     
 }
echo"</table>";

/*----------- mostrando todo lo que insertaste en la tabla anotes------------*/
 echo"<h1>list of those you already wrote your notes</h1>";
     
     
 $query = "SELECT * FROM anotes";
 $result = $conexion->query($query);
 if (!$result) die ("Falló el acceso a la base de datos");
 $rows = $result->num_rows;
 for ($j = 0; $j < $rows; $j++)
 {
 $row = $result->fetch_array(MYSQLI_NUM);
 $r0 = htmlspecialchars($row[0]);
 $r1 = htmlspecialchars($row[1]);
 $r2 = htmlspecialchars($row[2]);
 $r3 = htmlspecialchars($row[3]);
 $r4 = htmlspecialchars($row[4]);
 echo <<<_END
 <pre>
 contra :$r0
 NAME: $r1
 DATE: $r2
 TITLE: $r3
 PREVIOUS NOTES: $r4
 
 </pre>
 </pre>
 
 <form action="principal.php" method="post">
 
 DO YOU WANT TO UPDATE TITLE? <input type="text" name="tutilo" >
 DO YOU WANT TO UPDATE YOUR NOTES? <textarea name="anotes" cols="width" rows="height" wrap="type">
 </textarea>
 <input type="hidden" name="id_anotes" value="$r0" >
  <input type="submit" value="Update"></form>
 
 _END;
 }
/* poniendo la imagen para salir de la pagina */
 echo" <a  href='index.php'><img src='img/salir.png' alt='Salir' width='50px' height='50px' /></a> ";



 $result->close();
 $conexion->close();

 function get_post($con, $var)
 {
 return $con->real_escape_string($_POST[$var]);
 } 


?>