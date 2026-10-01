<?php
require "conexion.php";

$sql = file_get_contents("rappi_pro.sql");

if ($conexion->multi_query($sql)) {
    echo "✅ Base de datos importada correctamente";
} else {
    echo "❌ Error: " . $conexion->error;
}
?>