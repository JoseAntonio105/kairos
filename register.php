<?php
session_start();

require_once __DIR__ . "/config/db.php";
require_once __DIR__ . "/config/usuario.php";

/* Cargar países */
$sql = "select id, nombre from pais order by nombre asc";
$res = $conn->query($sql);

if (!$res) {
    $_SESSION["register_error"] = "Error al cargar países.";
    header("Location: register.php");
    exit;
}

$paises = $res->fetch_all(MYSQLI_ASSOC);

/* Procesar registro */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $nombre = trim($_POST["nombre"] ?? "");
    $apellidos = trim($_POST["apellidos"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $password = $_POST["password"] ?? "";
    $pais_id = (int)($_POST["country"] ?? 0);
    $codigo_postal = trim($_POST["codigo_postal"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");

    if ($username === "" || $nombre === "" || $apellidos === "" || $correo === "" || $password === "" || $pais_id <= 0 || $codigo_postal === "" || $telefono === "") {
        $_SESSION["register_error"] = "Faltan campos obligatorios.";
        header("Location: register.php");
        exit;
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["register_error"] = "El correo no tiene un formato válido.";
        header("Location: register.php");
        exit;
    }

    if (usuario_existe_por_username_o_correo($conn, $username, $correo)) {
        $_SESSION["register_error"] = "El username o el correo ya están registrados.";
        header("Location: register.php");
        exit;
    }

    $rol_cliente = obtener_id_rol_cliente($conn);
    if ($rol_cliente === null) {
        $_SESSION["register_error"] = "No existe el rol 'Cliente' en la base de datos.";
        header("Location: register.php");
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    if ($hash === false) {
        $_SESSION["register_error"] = "Error al procesar la contraseña.";
        header("Location: register.php");
        exit;
    }

    $nuevo_id = crear_usuario($conn, $username, $hash, $nombre, $apellidos, $correo, $pais_id, $codigo_postal, $telefono, $rol_cliente);

    if ($nuevo_id === null) {
        $_SESSION["register_error"] = "No se pudo crear el usuario.";
        header("Location: register.php");
        exit;
    }

    $_SESSION["id_usuario"] = $nuevo_id;
    $_SESSION["username"] = $username;

    header("Location: index.php");
    exit;
}

/* Error para mostrar */
$error = $_SESSION["register_error"] ?? null;
unset($_SESSION["register_error"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <?php
        include_once 'includes/head-tag-contents.php';
    ?>
</head>
<body>
<div class="registro-pc">
  <div class="frame-11">
    <img class="logo" src="assets/img/kairos.png" onerror="this.src='https://placehold.co/150x50/1c0538/ffffff?text=Kairos'" alt="Kairos Logo"/>
  </div>
  
  <!-- Contenedor del Formulario -->
  <div class="registro">
    <form class="frame-9" method="post" action="register.php">
      <?php if ($error): ?>
        <div style="color:#ff4d4d; margin-bottom:10px;">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <div class="frame-20">
        <div class="a-n-no-tienes-cuenta-registate">
          ¡Regístrate rellenando el formulario!
        </div>
      </div>
      
      <div class="frame-12">
        <!-- Campos del Formulario -->

        <div class="frame-13 frame-input-group">
          <label for="username" class="label-field">Nombre de usuario:</label>
          <input type="text" name="username" class="frame-17" placeholder="Introduce un nombre de usuario" required />
        </div>

        <div class="frame-13 frame-input-group">
          <label for="nombre" class="label-field">Nombre:</label>
          <input type="text" name="nombre" class="frame-17" placeholder="Introduce tu nombre" required />
        </div>
        
        <div class="frame-25 frame-input-group">
          <label for="apellidos" class="label-field">Apellidos:</label>
          <input type="text" name="apellidos" class="frame-17" placeholder="Introduce tus apellidos" required />
        </div>
        
        <div class="frame-25 frame-input-group">
          <label for="country" class="label-field">País:</label>
          <select id="country" name="country" class="frame-17" required>
            <option value="">Selecciona tu país</option>
            <?php foreach ($paises as $pais): ?>
              <option value="<?= $pais['id'] ?>">
                <?= htmlspecialchars($pais['nombre']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="frame-25 frame-input-group">
          <label for="codigo_postal" class="label-field">Código postal:</label>
          <input type="text" name="codigo_postal" class="frame-17" placeholder="Introduce tu código postal" required />
        </div>

        <div class="frame-25 frame-input-group">
          <label for="telefono" class="label-field">Teléfono:</label>
          <input type="text" name="telefono" class="frame-17" placeholder="Introduce tu teléfono" required />
        </div>

        <div class="frame-26 frame-input-group">
          <label for="correo" class="label-field">Email:</label>
          <input type="email" name="correo" class="frame-17" placeholder="Introduce tu email" required />
        </div>
        
        <div class="frame-27 frame-input-group">
          <label for="password" class="label-field">Contraseña:</label>
          <input type="password" name="password" class="frame-17" placeholder="Crea una contraseña" required />
        </div>
        
        <div class="frame-24">
          <button type="button" class="frame-23" id="google-register">
            <div class="log-in">Registrarse con Google</div>
          </button>
        </div>

        <!-- Botones Aceptar/Cancelar -->
        <div class="frame-24">
          <button type="submit" class="frame-23" name="accion" value="registrar">
            <div class="aceptar">Aceptar</div>
          </button>

          <a href="login.php" class="frame-22">
            <div class="cancelar">Cancelar</div>
          </a>
        </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>