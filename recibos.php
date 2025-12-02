<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibos</title>
    <?php include_once 'includes/head-tag-contents.php'?>
</head>


<body>

<?php include_once 'includes/navigation.php' ?>
<?php include_once 'includes/carrito.php' ?>

<div class="recibos-pc">

    <div class="titulo-recibos">RECIBOS</div>

    <div class="lista-recibos">

        <div class="tarjeta-recibo" data-id="1">
            <div class="icono-recibo"><img src="assets/img/recibo.png"></div>
            <div class="texto-recibo">
                <div class="nombre-recibo">Recibo 1</div>
                <a class="solicitar" href="devoluciones.php?id=1">Solicitar devolución</a>
            </div>
            <div class="dias-recibo"><span>30 días</span></div>
            <div class="eliminar-recibo"><img src="assets/img/papelera.png"></div>
        </div>

        <div class="tarjeta-recibo" data-id="2">
            <div class="icono-recibo"><img src="assets/img/recibo.png"></div>
            <div class="texto-recibo">
                <div class="nombre-recibo">Recibo 2</div>
                <a class="solicitar" href="devoluciones.php?id=2">Solicitar devolución</a>
            </div>
            <div class="dias-recibo"><span>30 días</span></div>
            <div class="eliminar-recibo"><img src="assets/img/papelera.png"></div>
        </div>

        <div class="tarjeta-recibo" data-id="3">
            <div class="icono-recibo"><img src="assets/img/recibo.png"></div>
            <div class="texto-recibo">
                <div class="nombre-recibo">Recibo 3</div>
                <a class="solicitar" href="devoluciones.php?id=3">Solicitar devolución</a>
            </div>
            <div class="dias-recibo"><span>30 días</span></div>
            <div class="eliminar-recibo"><img src="assets/img/papelera.png"></div>
        </div>

        <div class="tarjeta-recibo" data-id="4">
            <div class="icono-recibo"><img src="assets/img/recibo.png"></div>
            <div class="texto-recibo">
                <div class="nombre-recibo">Recibo 4</div>
                <a class="solicitar" href="devoluciones.php?id=4">Solicitar devolución</a>
            </div>
            <div class="dias-recibo"><span>30 días</span></div>
            <div class="eliminar-recibo"><img src="assets/img/papelera.png"></div>
        </div>

    </div>
</div>

<?php include_once 'includes/footer.php'?>
<script src="js/scripts.js"></script>
</body>
</html>
