<?php

if (isset($_POST)) {
    // si existe el post
// cargamos la conexion

    require_once 'includes/conexion.php';
    // Iniciar sesión
    if (!isset($_SESSION)) {
        session_start();
    }
    // recigida de datos
    
    // mysqli_real_escape_string es para que no tenga en cuenta las comillas que el usuario ponga en el formulario
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conx, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($conx, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conx, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conx, $_POST['password']) : false;


    // array de errores

    $errores = array();

    // validar los datos antes de guardarlos en la base de datos 


    if (!empty($nombre) && !is_numeric($nombre) && !preg_match(" /[0-9]/ ", $nombre)) {

        $nombre_validado = true;
    } else {

        $nombre_validado = false;
        $errores ['nombre'] = "El nombre no es valido";
    }


    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match(" /[0-9]/ ", $apellidos)) {

        $apellidos_validado = true;
    } else {

        $apellidos_validado = false;
        $errores ['apellidos'] = "Los apellidos no son  validos";
    }



    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $email_validado = true;
    } else {

        $email_validado = false;
        $errores ['email'] = "El email no es valido";
    }





    if (!empty($password)) {

        $password_validado = true;
    } else {

        $password_validado = false;
        $errores ['password'] = "El password no es valido";
    }

    var_dump($errores);


    // CONDICION QUE DICE QUE SI NO HAY NINGUN ERROR EN EL ARRAY DE ERRORES SE INTERTA EN LA BASE DE DATOS


    $guardarusuario = false;
    if (count($errores) == 0) {

        $guardarusuario = true;

        // cifrar contraseña 
        // cost numero de veces que cifra la contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
        //INSERTAR USUARIO EN LA BASE DE DATOS 


        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";


        // ejecutamos la sentencia
        $guardar = mysqli_query($conx, $sql);


        if ($guardar) {

            // iniciamos sesion si se ha guardado bien 

            $_SESSION ['completado'] = "El registro se ha guardado con exito";
        } else {
            // sino lo iniciamos otra vez mostrando asi un fallo 

            $_SESSION ['errores']['general'] = "Fallo al insertar los datos";
        }
    } else {

        $_SESSION ['errores'] = $errores;
    }
}


header('Location: index.php');


