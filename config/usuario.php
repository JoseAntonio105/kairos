<?php
require_once __DIR__ . "/db.php";

function usuario_existe_por_username_o_correo(mysqli $conn, string $username, string $correo): bool {
    $stmt = $conn->prepare("select id from usuario where username=? or correo=? limit 1");
    $stmt->bind_param("ss", $username, $correo);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $row ? true : false;
}

function obtener_id_rol_cliente(mysqli $conn): ?int {
    $res = $conn->query("select id from rol where nombre='Cliente' limit 1");
    if (!$res || $res->num_rows === 0) {
        return null;
    }
    return (int)$res->fetch_assoc()["id"];
}

function crear_usuario(
    mysqli $conn,
    string $username,
    string $hash,
    string $nombre,
    string $apellidos,
    string $correo,
    int $pais_id,
    string $codigo_postal,
    string $telefono,
    int $rol_id
): ?int {
    $stmt = $conn->prepare("
        insert into usuario
        (username, password, nombre, apellidos, correo, fecha_nacimiento, pais, codigo_postal, telefono, rol)
        values (?, ?, ?, ?, ?, null, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssssissi",
        $username,
        $hash,
        $nombre,
        $apellidos,
        $correo,
        $pais_id,
        $codigo_postal,
        $telefono,
        $rol_id
    );

    $ok = $stmt->execute();
    $new_id = $ok ? $conn->insert_id : null;
    $stmt->close();

    return $new_id;
}
