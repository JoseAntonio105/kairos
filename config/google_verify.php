<?php
header("Content-Type: application/json; charset=utf-8");

// DEBUG temporal (quítalo cuando funcione)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/google.php";

$autoload = __DIR__ . "/../vendor/autoload.php";
if (!file_exists($autoload)) {
    http_response_code(500);
    echo json_encode(["ok" => false, "error" => "No existe vendor/autoload.php. Ejecuta composer require google/auth"]);
    exit;
}
require_once $autoload;

$idToken = $_POST["credential"] ?? "";
if ($idToken === "") {
    http_response_code(400);
    echo json_encode(["ok" => false, "error" => "Falta credential"]);
    exit;
}

try {
    // Verificación sin librería Google (fallback): consulta a Google tokeninfo
    // Esto evita líos de versiones de google/auth.
    $url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . urlencode($idToken);
    $json = file_get_contents($url);

    if ($json === false) {
        http_response_code(401);
        echo json_encode(["ok" => false, "error" => "No se pudo verificar token (tokeninfo)"]);
        exit;
    }

    $payload = json_decode($json, true);
    if (!is_array($payload)) {
        http_response_code(401);
        echo json_encode(["ok" => false, "error" => "Respuesta inválida de tokeninfo"]);
        exit;
    }

    if (($payload["aud"] ?? "") !== GOOGLE_CLIENT_ID) {
        http_response_code(401);
        echo json_encode(["ok" => false, "error" => "Audiencia no válida"]);
        exit;
    }

    $email = $payload["email"] ?? "";
    if ($email === "") {
        http_response_code(400);
        echo json_encode(["ok" => false, "error" => "No llega email"]);
        exit;
    }

    $username = explode("@", $email)[0];

    echo json_encode(["ok" => true, "email" => $email, "username" => $username]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(["ok" => false, "error" => $e->getMessage()]);
}
