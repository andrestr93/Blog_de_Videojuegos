<?php

// iniciar la sesion y la conexion a la base de datos 

require_once 'includes/conexion.php';





if (isset($_POST)) { // comprobamos que existe el post
    
    // borrar error antiguo

         if (isset($_SESSION['error_login'])) {

                session_unset($_SESSION['error__login']);
            }
            
            // recoger los datos del formulario

            
    $email = trim($_POST['email']);
    $password = ($_POST['password']);


    // consulta para comprobar las credenciales del usuario 


    $sql = "SELECT * FROM USUARIOS WHERE email = '$email' ";

    // ejecutamos la consulta
    $login = mysqli_query($conx, $sql);

    if ($login && mysqli_num_rows($login) == 1) {

        $usuario = mysqli_fetch_assoc($login); // esto te coge los datos de la consulta con un array asociativo 
        //comprobamos contraseña

        $verify = password_verify($password, $usuario['password']); // comparamos la contraseña del formulario con lo que obtenemos de la consulta 

        if ($verify) {

            // utilizamos una sesion para guardar los datos 
            $_SESSION['usuario'] = $usuario;

   
        } else {
            // si falla hacemos sesion con el error


            $_SESSION['error_login'] = "login incorrecto!"; // si falla mostramos un mensaje con la sesion 
        }
    } else {
        // mensaje de error

        $_SESSION['error_login'] = "login incorrecto!"; // si falla mostramos un mensaje con la sesion 
    }
}
    

// redigirimos al index 

header('Location:index.php');
    
    
    
    
    
    