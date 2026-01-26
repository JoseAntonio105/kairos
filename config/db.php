<?php

$DB_HOST = "localhost";
$DB_USER = "dwes";
$DB_PASS = "abc123.";
$DB_NAME = "kairos";
$DB_PORT = 3306;

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
