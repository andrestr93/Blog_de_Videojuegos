<?php

$bd = "blog";
$usuario = "root";
$pass = "";
$servidor = "localhost:3308";

// metodo para lanzar la conexion
$conx = mysqli_connect($servidor, $usuario, $pass, $bd);


mysqli_query($conx, "SET NAME 'utf8 ' ");

// iniciar la sesion 



if (!isset($_SESSION)){
    
    
session_start();
    
    
}


?>