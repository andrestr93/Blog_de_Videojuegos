<?php

if (isset($_POST)) {

    require_once 'includes/conexion.php';


    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($conx, $_POST['titulo']) : false;

    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($conx, $_POST['descripcion']) : false;

    $categoria = isset($_POST['categoria']) ? (int) mysqli_real_escape_string($conx, $_POST['categoria']) : false;

    $usuario = $_SESSION['usuario']['id'];


    // VALIDACION 
    // creamos un array de errores


    $errores = array();



    if (empty($titulo)) {
        $errores['titulo'] = 'El titulo no es válido';
    }

    if (empty($descripcion)) {
        $errores['descripcion'] = 'La descripción no es válida';
    }

    if (empty($categoria) && !is_numeric($categoria)) {
        $errores['categoria'] = 'La categoría no es válida';
    }






    if (count($errores) == 0) {

        $entrada_id = $_GET['editar'];
        $usuario_id = $_SESSION['usuario']['id'];

        if (isset($_GET['editar'])) {
          $sql=   "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categoria_id=$categoria " .
                    " WHERE id = $entrada_id AND usuario_id = $usuario_id";
        } else {

            $sql = "INSERT INTO entradas values (null , $usuario , '$categoria' , '$titulo ', '$descripcion' , CURDATE());";
        }

        $guardar = mysqli_query($conx, $sql);
        
        







        header('Location: index.php'); // redirecionamos la pagina
    } else {

        $_SESSION['erroresentrada'] = $errores;

        if (isset($_GET['editar'])) {

            header("Location: editarentrada.php?id=" . $_GET['editar']);
        } else {

            header('Location: crearentradas.php'); // redirecionamos la pagina
        }
    }
}
