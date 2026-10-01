<?php

require "Conexion.php";


$columnas = ["id_cliente", "nombre", "apellido", "restaurante_favorito", "correo", "telefono", "ciudad", "dias_inactivos", "frecuencia_semanal", "pedidos_mes", "valor_compras_mes_cop", "pqr_mes", "pqr_abierta", "antiguedad_meses", "cancelaciones_mes", "score","Prob_Motivo"];

$archivos = [
    "rojo.txt",      // Score: 0-33.3
    "amarillo.txt",  // Score: 33.4-66.6
    "verde.txt"      // Score: 66.7-100
];

$query = "SELECT " . implode(",", $columnas) . " FROM clientes_rappipro";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$clientes = [];
while ($fila = $resultado->fetch_assoc()) {
    $clientes[] = $fila;
}

$archivos_contenido = [
    "rojo.txt" => [],
    "amarillo.txt" => [],
    "verde.txt" => []
];

foreach ($clientes as &$cliente) {
    $score = 0;//Pendiente
    $impactos = [
    "valor_compras_mes_cop" => 0,
    "dias_inactivos" => 0,
    "frecuencia_semanal" => 0,
    "pedidos_mes" => 0,
    "pqr_mes" => 0,
    "pqr_abierta" => 0,
    "antiguedad_meses" => 0,
    "cancelaciones_mes" => 0
];
    //Score menos alto, mas proabilidades de churn

    if ($cliente['valor_compras_mes_cop'] <= 50000 && $cliente['valor_compras_mes_cop'] > 20000) {
        $score += 5;
        $impactos['valor_compras_mes_cop'] += 10;
    }elseif($cliente['valor_compras_mes_cop'] <= 150000 && $cliente['valor_compras_mes_cop'] > 50000) {
        $score += 10;
        $impactos['valor_compras_mes_cop'] += 5;
    }elseif($cliente['valor_compras_mes_cop'] > 150000) {
        $score += 15;
    }else{
        $score += 0;
        $impactos['valor_compras_mes_cop'] += 15;
    }

    if ($cliente['dias_inactivos'] > 25) {
        $score += 0;
        $impactos['dias_inactivos'] += 15;
    }elseif($cliente['dias_inactivos'] > 15) {
        $score += 10;
        $impactos['dias_inactivos'] += 5;
    }elseif($cliente['dias_inactivos'] > 0) {
        $score += 15;
    }

    if ($cliente['frecuencia_semanal'] <= 3) {
        $score += 0;
        $impactos['frecuencia_semanal'] += 15;
    }elseif($cliente['frecuencia_semanal'] <= 5) {
        $score += 5;
        $impactos['frecuencia_semanal'] += 10;
    }elseif($cliente['frecuencia_semanal'] > 5) {
        $score += 10;
    }

    if ($cliente['pedidos_mes'] <= 10 && $cliente['pedidos_mes'] > 5) {
        $score += 5;
        $impactos['pedidos_mes'] += 10;
    }elseif($cliente['pedidos_mes'] <= 15 && $cliente['pedidos_mes'] > 10) {
        $score += 10;
        $impactos['pedidos_mes'] += 5;
    }elseif($cliente['pedidos_mes'] > 15) {
        $score += 15;
    }else{
        $score += 0;
        $impactos['pedidos_mes'] += 15;
    }

    if ($cliente['pqr_mes'] == 0 ) {
        $score += 10;
    }elseif($cliente['pqr_mes'] <= 2) {
        $score += 5;
        $impactos['pqr_mes'] += 10;
    }else{
        $score += 0;
        $impactos['pqr_mes'] += 15;
    }

    if ($cliente['pqr_abierta'] == 0) {
        $score += 10;
    }else {
        $score += 0;
        $impactos['pqr_abierta'] += 15;
    }

    if ($cliente['antiguedad_meses'] > 24) {
        $score += 15;
    }elseif($cliente['antiguedad_meses'] > 12) {
        $score += 10;
        $impactos['antiguedad_meses'] += 5;
    }elseif($cliente['antiguedad_meses'] > 6) {
        $score += 5;
        $impactos['antiguedad_meses'] += 10;
    }else{
        $score += 0;
        $impactos['antiguedad_meses'] += 15;
    }

    if ($cliente['cancelaciones_mes'] == 0) {
        $score += 10;   
    }elseif($cliente['cancelaciones_mes'] <= 2) {
        $score += 5;
        $impactos['cancelaciones_mes'] += 10;
    }else{
        $score += 0;
        $impactos['cancelaciones_mes'] += 15;
    }

    $cliente['score'] = $score;
    $motivos = [];

foreach ($impactos as $campo => $valor) {
    if ($valor >= 10) {
        $motivos[] = $campo;
    }
}

    $Prob_churn = implode(",", $motivos);
    
    // Actualizar el score en la BD
    $id_cliente = intval($cliente['id_cliente']);
    $update_query = "UPDATE clientes_rappipro SET score = $score WHERE id_cliente = $id_cliente";

    
    if (!$conexion->query($update_query)) {
        echo "Error al actualizar cliente $id_cliente: " . $conexion->error . "\n";
    }

    $update_query = "UPDATE clientes_rappipro SET Prob_Motivo = '$Prob_churn' WHERE id_cliente = $id_cliente";
    
    if (!$conexion->query($update_query)) {
        echo "Error al actualizar cliente $id_cliente: " . $conexion->error . "\n";
    }
    //Dirigir a cada cliente a un archivo segun su score
    if ($score >= 0 && $score <= 33.3) {
        $archivo = "rojo.txt";
    } elseif ($score > 33.3 && $score <= 66.6) {
        $archivo = "amarillo.txt";
    } else{
        $archivo = "verde.txt";
    }
    
    // Crear línea de datos separada por comas
    $datos_cliente = [];
    foreach ($columnas as $columna) {
        $datos_cliente[] = $cliente[$columna];
    }
    $datos_cliente[] = $score; // Agregar el score al final
    
    $linea = implode(",", $datos_cliente);
    $archivos_contenido[$archivo][] = $linea;
}

//echo " Scores calculados y BD actualizada en Logica.php\n";

$directorio = __DIR__ . "/";

// Crear encabezado con nombres de columnas
$encabezado = implode(",", array_merge($columnas, ["score"]));

foreach ($archivos as $nombre_archivo) {
    $ruta_completa = $directorio . $nombre_archivo;
    
    $contenido = $encabezado . "\n";
    
    if (isset($archivos_contenido[$nombre_archivo]) && count($archivos_contenido[$nombre_archivo]) > 0) {
        $contenido .= implode(";\n", $archivos_contenido[$nombre_archivo]);
    }
    
    if (file_put_contents($ruta_completa, $contenido)) {
        $cantidad = count($archivos_contenido[$nombre_archivo]);
        //echo " Archivo creado en Logica.php: $nombre_archivo ($cantidad clientes)\n";
    } else {
        //echo " Error al crear: $nombre_archivo\n";
    }
}
//echo " Datos extraídos en Logica.php: " . count($clientes) . " clientes encontrados\n";

//echo "\n========================================\n";
//echo "Proceso completado correctamente en Logica.php\n";
//echo "========================================\n";
//echo "Resumen de distribución en Logica.php:\n";
//echo "- Rojo (0-33.3): " . count($archivos_contenido["rojo.txt"]) . " clientes\n";
//echo "- Amarillo (33.4-66.6): " . count($archivos_contenido["amarillo.txt"]) . " clientes\n";
//echo "- Verde (66.7-100): " . count($archivos_contenido["verde.txt"]) . " clientes\n";

// Cerrar conexión
$conexion->close();

?>