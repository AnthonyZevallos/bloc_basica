<?php

 require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db);
    if ($conexion->connect_error) die ("Fatal error");
   /*---------insertando a los usuarios nuevos ---------*/
    if(isset($_POST['user']) && isset($_POST['pass']))
    {
        $user = $_POST['user'];
        $pass = md5($_POST['pass']);

        $query = "INSERT INTO usuario VALUES('$user', '$pass')";
        $result = $conexion->query($query);
        if (!$result) die ("Falló registro");

        echo "Successful registration <a href='index.php'>Login with your created user</a>";
        
    }
    else
    {   /*----------formulario para registrar al  nuevo user------------*/
        echo <<<_END
        <h1>Regístrate</h1>
        
        <img src='img/maslogo.png' alt='mas user' width='200px' height='250px' />
        
        <form action="signup.php" method="post"><pre>
        Usuario  <input type="email" name="user" placeholder="Ingrese Email" autocomplete="off" required/>
        Password <input type="password" name="pass" placeholder="Ingrese Password" autocomplete="off" required/>
                 <input type="hidden" name="reg" value="yes">
                 <input type="submit" value="TO REGISTER">
        </form>
        _END;
    }


?>
    