<?php

if(isset($_POST)){
    
    
    include_once 'includes/conexion.php';
    
    
    // TERNALIA
    
    // SIGNIFICA QUE SI EXISTE EL POST JUSTO EL NOMBRE SE LIMPIE LOS SIMBOLOS RAROS QUE SE PUEDA PONER
 
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conx , $_POST['nombre']) : false;
    
    
      // array de errores

    $errores = array();

    // validar los datos antes de guardarlos en la base de datos 


    // condicion que si hay texto en la caja y no hay numeros variable nombre_validado pasa a true 
    // pasa a false si no es cierto y lo mete en un array de errores
   
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match(" /[0-9]/ ", $nombre)) {

        $nombre_validado = true;
    } else {

        $nombre_validado = false;
        $errores ['nombre'] = "El nombre no es valido";
        
        
       
    }
     
    
    // condicion que si el array de errores no tiene ningun elemento lo inserta en la base de datos
    
  
    if (count($errores) == 0){
        
      
        
        $sql = "INSERT INTO categorias VALUES(null , ' $nombre');";
        
        $guardar = mysqli_query($conx, $sql);
        
        
        
        
        
    }

    
    
    
}


        header('Location: index.php'); // redirecionamos la pagina