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




    var_dump($errores);


    // CONDICION QUE DICE QUE SI NO HAY NINGUN ERROR EN EL ARRAY DE ERRORES SE ACTUALIZA EN LA BASE DE DATOS


    $guardarusuario = false;

    // COMRPOBAMOS ANTES SI EL EMAIL EXISTE YA EN LA BD



    if (count($errores) == 0) {

        $actualizarusuario = true;
        // COMPROBAR SI EL EMAIL YA EXISTE
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($conx, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        
        
        // comprobamos primero si el email existe en la base de datos

        if ($isset_user['id'] == $usuario['id'] || empty($isset_user)) {
            // ACTULIZAR USUARIO EN LA TABLA USUARIOS DE LA BBDD

            $sql = "UPDATE usuarios SET " .
                    "nombre = '$nombre', " .
                    "apellidos = '$apellidos', " .
                    "email = '$email' " .
                    "WHERE id = " . $usuario['id'];
            $guardar = mysqli_query($conx, $sql);


            if ($guardar) {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;

                $_SESSION['completado'] = "Tus datos se han actualizado con éxito";
            } else {
                $_SESSION['errores']['general'] = "Fallo al actualizar tus datos!!";
            }
        } else {
            $_SESSION['errores']['general'] = "El usuario ya existe!!";
        }


        // ACTUALIZAMOS EL USUARIO DE LA TABLA DE LA BASE DE DATOS 

        $usuario = $_SESSION['usuario'];




        $sql = "UPDATE  usuarios SET nombre = '$nombre' , apellidos = '$apellidos' ,  email = '$email' where id = " . $usuario['id'];


        // ejecutamos la sentencia
        $guardar = mysqli_query($conx, $sql);


        if ($guardar) {

            // iniciamos sesion si se ha guardado bien 
            // actualizamos la sesion con los datos del nuevo usuario
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellidos'] = $apellidos;
            $_SESSION['usuario']['email'] = $email;

            $_SESSION ['completado'] = "Tus datos  se han actualizado con exito";
        } else {
            // sino lo iniciamos otra vez mostrando asi un fallo 

            $_SESSION ['errores']['general'] = "Fallo al actualizar tus datos";
        }
    } else {

        $_SESSION ['errores'] = $errores;
    }
}


header('Location: misdatos.php');


