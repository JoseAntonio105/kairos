<?php
include_once 'includes/products.php';

$id = 0;
if (isset($_GET["id"])) $id = (int) $_GET["id"];

$producto = null;

for ($i = 0; $i < count($productos); $i++) {
    if (isset($productos[$i]["id"]) && $productos[$i]["id"] == $id) {
        $producto = $productos[$i];
        break;
    }
}

if ($producto == null) {
    header("Location: index.php");
    exit;
}

$titulo = "";
$cover = "";
$genero = "";
$modo = "";
$descripcion = "";
$price = "";
$addUrl = "carrito.php";

if (isset($producto["titulo"])) $titulo = $producto["titulo"];
if (isset($producto["cover"])) $cover = $producto["cover"];
if (isset($producto["genero"])) $genero = $producto["genero"];
if (isset($producto["modo"])) $modo = $producto["modo"];
if (isset($producto["descripcion"])) $descripcion = $producto["descripcion"];
if (isset($producto["price"])) $price = $producto["price"];
if (isset($producto["add_url"])) $addUrl = $producto["add_url"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titulo); ?></title>
    <?php include_once 'includes/head-tag-contents.php'?>
</head>

<body>

<?php include_once 'includes/navigation.php' ?>
<?php include_once 'includes/carrito.php' ?>

<div class="detalles-pc">

    <div class="detalles-contenedor">

        <!-- ============ IMAGEN ============ -->
        <div class="detalles-imagen">
            <img src="<?php echo htmlspecialchars($cover); ?>" alt="<?php echo htmlspecialchars($titulo); ?>">
        </div>

        <!-- ============ INFORMACIÓN ============ -->
        <div class="detalles-info">
            <div class="detalles-titulo"><?php echo htmlspecialchars($titulo); ?></div>

            <div class="detalles-datos">
                <div><strong>Género:</strong> <?php echo htmlspecialchars($genero); ?></div>
                <div><strong>Modo:</strong> <?php echo htmlspecialchars($modo); ?></div>
            </div>

            <div class="detalles-descripcion">
                <?php echo htmlspecialchars($descripcion); ?>
            </div>

            <div class="detalles-precio"><?php echo htmlspecialchars($price); ?></div>
            <a class="detalles-boton" href="<?php echo htmlspecialchars($addUrl . '?id=' . $id); ?>">AÑADIR AL CARRITO</a>
        </div>

    </div>

    <!-- ============ REQUISITOS ============ -->
    <div class="requs-titulo">REQUISITOS DEL SISTEMA</div>

    <div class="requs-contenedor">
        <div class="requs-bloque">
            <h3>MÍNIMOS</h3>
            <ul>
                <li><strong>SO:</strong> Windows 10/11 64-bit</li>
                <li><strong>Procesador:</strong> Intel i5-6600K / AMD Ryzen 5 1600</li>
                <li><strong>Memoria:</strong> 8 GB RAM</li>
                <li><strong>Gráficos:</strong> GTX 1050 TI / RX 570</li>
                <li><strong>Almacenamiento:</strong> 60 GB libres</li>
            </ul>
        </div>

        <div class="requs-bloque">
            <h3>RECOMENDADOS</h3>
            <ul>
                <li><strong>SO:</strong> Windows 11 64-bit</li>
                <li><strong>Procesador:</strong> Intel i7-8700 / Ryzen 5 3600</li>
                <li><strong>Memoria:</strong> 16 GB RAM</li>
                <li><strong>Gráficos:</strong> RTX 2060 / RX 5600 XT</li>
                <li><strong>Almacenamiento:</strong> 60 GB SSD</li>
            </ul>
        </div>
    </div>

</div>

<?php include_once 'includes/footer.php'?>
<script src="js/scripts.js"></script>
</body>
</html>
