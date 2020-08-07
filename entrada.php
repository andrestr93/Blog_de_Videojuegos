
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>


<?php
$entrada_actual = conseguirEntrada($conx, $_GET['id']);



if (!isset($entrada_actual['id'])) {

    header("Location: index.php");
}
?>

<?php require_once 'includes/cabecera.php'; ?>
<!--CONTENEDOR PRINCIPAL-->
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->

<div id="principal">


    <h1> <?= $entrada_actual['titulo'] ?></h1>

    <a href="categoria.php?id=<?= $entrada_actual['categoria_id'] ?>">
        <h3><?= $entrada_actual['categoria'] ?> | <?= $entrada_actual['usuario'] ?></h2>

            <h4><?= $entrada_actual['descripcion'] ?></h2>


                <?php if (isset($_SESSION["usuario"]) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): ?>

                    <a href="editarentrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-naranja" >Editar entrada</a>
                    <a href="borrarentrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-verde" >Borrar entrada</a>


                <?php endif; ?>

                </div> <!-- fin principal-->
                <?php require_once 'includes/pie.php'; ?>;
                </body>
                </html>



