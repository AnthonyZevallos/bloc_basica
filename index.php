<?php
require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db);
    if ($conexion->connect_error) die ("Fatal error");

   /* ------------pregunto si esta con contenido para consultar si el usuario exite para acceder el paso*/
    if(isset($_POST['user']) && isset($_POST['pass']))
    {
        $user = mysql_fix_string($conexion, $_POST['user']);
        $pass = md5($_POST['pass']);

        $query = "SELECT * FROM usuario WHERE usuario='$user' AND contraseña='$pass'";

        $result = $conexion->query($query);
 /* ----------haciendo una pregunta que si hay una fila igual-------*/        
        if ($result->num_rows >= 1)
            echo "<h1>Bienvenido</h1> "."<br><a  href='principal.php'><img src='img/entrar.png' alt='Salir' width='50px' height='50px' /></a>";
            
        else
            echo "<br><h1>User or password incorrect</h1> <a  href='signup.php'><img src='img/registrarme.png' alt='quiero' width='200px' height='50px' /></a>"; 
         echo "<br><a  href='index.php'><img src='img/salir.png' alt='Salir' width='50px' height='50px' /></a>";
        
    }
        
    else
    {
        /*--------formularios de para acceder los datos y haga las respectivas consultas-----*/
        echo <<<_END
        <h1>Ingresa</h1>
        
        <img src='img/logo.png' alt='logo' width='200px' height='250px' />
        
        <form action="index.php" method="post"><pre>
        Usuario  <input type="email" name="user" placeholder="Usuario" required/>
        Password <input type="password" name="pass" placeholder="Password" autocomplete="off" required/>
                 <input type="submit" value="INGRESAR">
        </form>
        _END;
    }

    function mysql_fix_string($coneccion, $string)
    {
        if (get_magic_quotes_gpc())
            $string = stripcslashes($string);
        return $coneccion->real_escape_string($string);
    }

?>