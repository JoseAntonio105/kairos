<?php
session_start();
header("Cross-Origin-Opener-Policy: same-origin-allow-popups");

require_once __DIR__ . "/config/db.php";
require_once __DIR__ . "/config/usuario.php";
require_once __DIR__ . "/config/google.php";

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

    $registro_google = ($_POST["registro_google"] ?? "0") === "1";

    $username = trim($_POST["username"] ?? "");
    $nombre = trim($_POST["nombre"] ?? "");
    $apellidos = trim($_POST["apellidos"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $password = $_POST["password"] ?? "";
    $pais_id = (int)($_POST["country"] ?? 0);
    $codigo_postal = trim($_POST["codigo_postal"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");

    // Campos obligatorios (password solo si NO es google)
    if (
        $username === "" || $nombre === "" || $apellidos === "" || $correo === "" ||
        $pais_id <= 0 || $codigo_postal === "" || $telefono === "" ||
        (!$registro_google && $password === "")
    ) {
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

    // Si el registro viene de Google, generamos una contraseña aleatoria (para cumplir NOT NULL)
    if ($registro_google) {
        $password = bin2hex(random_bytes(16)); // 32 caracteres
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    if ($hash === false) {
        $_SESSION["register_error"] = "Error al procesar la contraseña.";
        header("Location: register.php");
        exit;
    }

    $nuevo_id = crear_usuario(
        $conn,
        $username,
        $hash,
        $nombre,
        $apellidos,
        $correo,
        $pais_id,
        $codigo_postal,
        $telefono,
        $rol_cliente
    );

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

  <?php include_once 'includes/head-tag-contents.php'; ?>

  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <script>
    window.GOOGLE_CLIENT_ID = "<?= htmlspecialchars(GOOGLE_CLIENT_ID) ?>";
  </script>
</head>

<body>
<div class="registro-pc">
  <div class="frame-11">
    <img class="logo" src="assets/img/kairos.png"
         onerror="this.src='https://placehold.co/150x50/1c0538/ffffff?text=Kairos'"
         alt="Kairos Logo"/>
  </div>

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

        <div class="frame-13 frame-input-group">
          <label for="username" class="label-field">Nombre de usuario:</label>
          <input type="text" id="username" name="username" class="frame-17"
                 placeholder="Introduce un nombre de usuario" required />
        </div>

        <div class="frame-13 frame-input-group">
          <label for="nombre" class="label-field">Nombre:</label>
          <input type="text" id="nombre" name="nombre" class="frame-17"
                 placeholder="Introduce tu nombre" required />
        </div>

        <div class="frame-25 frame-input-group">
          <label for="apellidos" class="label-field">Apellidos:</label>
          <input type="text" id="apellidos" name="apellidos" class="frame-17"
                 placeholder="Introduce tus apellidos" required />
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
          <input type="text" id="codigo_postal" name="codigo_postal" class="frame-17"
                 placeholder="Introduce tu código postal" required />
        </div>

        <div class="frame-25 frame-input-group">
          <label for="telefono" class="label-field">Teléfono:</label>
          <input type="text" id="telefono" name="telefono" class="frame-17"
                 placeholder="Introduce tu teléfono" required />
        </div>

        <div class="frame-26 frame-input-group">
          <label for="email" class="label-field">Email:</label>
          <input type="email" id="email" name="correo" class="frame-17"
                 placeholder="Introduce tu email" required />
        </div>

        <div class="frame-27 frame-input-group">
          <label for="password" class="label-field">Contraseña:</label>
          <input type="password" id="password" name="password" class="frame-17"
                 placeholder="Crea una contraseña" required />
        </div>

        <!-- Botón Google -->
        <div class="frame-24">
          <div id="g_id_signin" class="frame-23"></div>
        </div>

        <!-- Flag para saber si viene de Google -->
        <input type="hidden" id="registro_google" name="registro_google" value="0">

        <div class="frame-24">
          <button type="submit" class="frame-23">
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

<script src="js/google-auth.js"></script>
</body>
</html>
