<?php
header("Content-Type: application/json; charset=utf-8");

require_once __DIR__ . "/google.php";

$idToken = $_POST["credential"] ?? "";
if ($idToken === "") {
    http_response_code(400);
    echo json_encode(["ok" => false, "error" => "Falta credential"]);
    exit;
}

$url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . urlencode($idToken);
$json = file_get_contents($url);

if ($json === false) {
    http_response_code(401);
    echo json_encode(["ok" => false, "error" => "No se pudo verificar token"]);
    exit;
}

$payload = json_decode($json, true);
if (!is_array($payload)) {
    http_response_code(401);
    echo json_encode(["ok" => false, "error" => "Respuesta inválida"]);
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

$username  = explode("@", $email)[0];
$nombre    = $payload["given_name"] ?? "";
$apellidos = $payload["family_name"] ?? "";

echo json_encode([
    "ok" => true,
    "email" => $email,
    "username" => $username,
    "nombre" => $nombre,
    "apellidos" => $apellidos
]);
