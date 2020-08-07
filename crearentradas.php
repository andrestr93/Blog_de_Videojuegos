

<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<!--CONTENEDOR PRINCIPAL-->
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->

<div id="principal">

    <h1>Crear Entradas</h1>

    <p>

        Añade Nuevas Entradas y disfrutar de nuestro nuevo contenido
    </p></br>

    <form action="guardarentrada.php" method="POST">

        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" />
        <?php echo isset($_SESSION['erroresentrada']) ? mostrarError($_SESSION['erroresentrada'], 'titulo') : ''; ?>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"></textarea>
        <?php echo isset($_SESSION['erroresentrada']) ? mostrarError($_SESSION['erroresentrada'], 'descripcion') : ''; ?>

        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php
            $categorias = conseguirCategorias($conx);
            if (!empty($categorias)):
                while ($categoria = mysqli_fetch_assoc($categorias)):
                    ?>
                    <option value="<?= $categoria['id'] ?>">
                        <?= $categoria['nombre'] ?>
                    </option>
                    <?php
                endwhile;
            endif;
            ?>
        </select>
        <?php echo isset($_SESSION['erroresentrada']) ? mostrarError($_SESSION['erroresentrada'], 'categoria') : ''; ?>
        <input type="submit" value="Guardar"/>
    </form>
    
    <?php            borrarErrores()?>

</div> <!-- fin principal-->
<?php require_once 'includes/pie.php'; ?>;
