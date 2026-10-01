<?php

$host = "127.0.0.1";
$usuario = "root";
$contrasena = "";
$bd_nombre = "rappi_pro";
$puerto = 3307;

$conexion = new mysqli($host, $usuario, $contrasena, $bd_nombre, $puerto);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

?>