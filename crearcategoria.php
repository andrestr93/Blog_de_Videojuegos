

<?php require_once 'includes/redireccion.php';?>
<?php require_once 'includes/cabecera.php'; ?>
<!--CONTENEDOR PRINCIPAL-->
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->

<div id="principal">

    <h1>Crear Categorias</h1>
    
    <p>
        
        Añade Nuevas Categorias para que los usuarios puedan usarlas al crear sus entradas
    </p></br>
    
    <form action="guardarcategoria.php" method="POST">
        
        <label for="nombre">Nombre </label>
        <input type="text" name="nombre"/>
        <input type="submit" value="Guardar"/>
      
    </form>

</div> <!-- fin principal-->
<?php require_once 'includes/pie.php'; ?>;
