<?php

include_once 'includes/conexion.php';

if (isset($_SESSION['usuario'])) {

    $entrada_id = $_GET['id'];

    $usuario_id = $_SESSION['usuario']['id'];

    $sql = "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";

    mysqli_query($conx, $sql);
}

header ("Location: index.php");