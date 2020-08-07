<?php


if (!isset($_SESSION)){
    
    
session_start();
    
    
}

if (!isset($_SESSION['usuario'])){  // en caso de que la sesion no exista 
    
    
  header('Location: index.php');
    
}


