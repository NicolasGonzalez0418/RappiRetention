<?php

require "Conexion.php";


$columnas = ["id_cliente", "nombre", "apellido", "restaurante_favorito", "correo", "telefono", "ciudad", "dias_inactivos", "frecuencia_semanal", "pedidos_mes", "valor_compras_mes_cop", "pqr_mes", "pqr_abierta", "antiguedad_meses", "cancelaciones_mes","score","Prob_Motivo"];

$query = "SELECT " . implode(",", $columnas) . " FROM clientes_rappipro";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$clientes = [];
while ($fila = $resultado->fetch_assoc()) {
    $clientes[] = $fila;
}
    $rojo = 0;
    $amarillo = 0;
    $verde = 0;
    $score = 0;
    $Prob_Inactivo = 0;
    $Prob_FSemanal = 0;
    $Prob_Pedidos = 0;
    $Prob_ValorCompras = 0;
    $Prob_PQR = 0;
    $Prob_PQRAbierta = 0;
    $Prob_Antiguedad = 0;
    $Prob_Cancelaciones = 0;

foreach ($clientes as &$cliente) {
    $score = $cliente['score'];
    //Acumulador N clientes en cada lugar
    if ($score >= 0 && $score <= 33.3) {
        $rojo +=1;
    } elseif ($score > 33.3 && $score <= 66.6) {
        $amarillo += 1;
    } else{
        $verde += 1;
    }

    $motivos = explode(",", $cliente['Prob_Motivo']);

if (in_array('dias_inactivos', $motivos)) {
    $Prob_Inactivo++;
}

if (in_array('frecuencia_semanal', $motivos)) {
    $Prob_FSemanal++;
}

if (in_array('pedidos_mes', $motivos)) {
    $Prob_Pedidos++;
}

if (in_array('valor_compras_mes_cop', $motivos)) {
    $Prob_ValorCompras++;
}

if (in_array('pqr_mes', $motivos)) {
    $Prob_PQR++;
}

if (in_array('pqr_abierta', $motivos)) {
    $Prob_PQRAbierta++;
}

if (in_array('antiguedad_meses', $motivos)) {
    $Prob_Antiguedad++;
}

if (in_array('cancelaciones_mes', $motivos)) {
    $Prob_Cancelaciones++;
}
}

$Porc_Inactivo = ($Prob_Inactivo / count($clientes)) * 100;
$Porc_FSemanal = ($Prob_FSemanal / count($clientes)) * 100;
$Porc_Pedidos = ($Prob_Pedidos / count($clientes)) * 100;
$Porc_ValorCompras = ($Prob_ValorCompras / count($clientes)) * 100;
$Porc_PQRAbierta = ($Prob_PQRAbierta / count($clientes)) * 100;
$Porc_PQR = ($Prob_PQR / count($clientes)) * 100;
$Porc_Antiguedad = ($Prob_Antiguedad / count($clientes)) * 100;
$Porc_Cancelaciones = ($Prob_Cancelaciones / count($clientes)) * 100;
echo "✓ Distribución de clientes:\n";

// PASO 4: Crear los 4 archivos txt
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
        echo "✓ Archivo creado: $nombre_archivo ($cantidad clientes)\n";
    } else {
        echo "✗ Error al crear: $nombre_archivo\n";
    }
}

$porcRojo = ($rojo / count($clientes)) * 100;
$porcAmarillo = ($amarillo / count($clientes)) * 100;
$porcVerde = ($verde / count($clientes)) * 100;

$NClientes = count($clientes);
echo "✓ Datos extraídos en Prin.php: " . $NClientes . " clientes encontrados\n";

if($verde >= 5){
    $LowRisk = 5;
}else{
    $LowRisk = $verde;
}

if($rojo >= 5){
    $HighRisk = 5;
}else{
    $HighRisk = $rojo;
}
$query = "SELECT " . implode(",", $columnas) . " FROM clientes_rappipro WHERE score >= 66.7 ORDER BY score DESC LIMIT $LowRisk";
$resultadoLowRisk = $conexion->query($query);

$query = "SELECT " . implode(",", $columnas) . " FROM clientes_rappipro WHERE score <= 33.4 ORDER BY score ASC LIMIT $HighRisk";
$resultadoHighRisk = $conexion->query($query);
?>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Panel General - RetentionPro</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-fixed-dim": "#ffb4a1",
                        "inverse-surface": "#213145",
                        "outline": "#737688",
                        "tertiary-fixed": "#ffdbd2",
                        "secondary-container": "#dae2fd",
                        "on-primary": "#ffffff",
                        "surface-container-highest": "#d3e4fe",
                        "on-tertiary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-surface": "#0b1c30",
                        "secondary-fixed-dim": "#bec6e0",
                        "primary-fixed-dim": "#b7c4ff",
                        "on-secondary-container": "#5c647a",
                        "on-tertiary-fixed": "#3c0800",
                        "surface-container": "#e5eeff",
                        "outline-variant": "#c3c5d9",
                        "primary-container": "#0052ff",
                        "surface": "#f8f9ff",
                        "surface-tint": "#004ced",
                        "secondary": "#565e74",
                        "surface-container-lowest": "#ffffff",
                        "surface-bright": "#f8f9ff",
                        "on-primary-fixed-variant": "#0038b6",
                        "on-tertiary-container": "#ffddd5",
                        "on-secondary-fixed": "#131b2e",
                        "on-error": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-secondary": "#ffffff",
                        "on-primary-container": "#dfe3ff",
                        "on-secondary-fixed-variant": "#3f465c",
                        "tertiary": "#952200",
                        "on-tertiary-fixed-variant": "#891e00",
                        "primary": "#003ec7",
                        "on-surface-variant": "#434656",
                        "surface-container-low": "#eff4ff",
                        "inverse-on-surface": "#eaf1ff",
                        "background": "#f8f9ff",
                        "on-primary-fixed": "#001452",
                        "inverse-primary": "#b7c4ff",
                        "surface-variant": "#d3e4fe",
                        "surface-container-high": "#dce9ff",
                        "secondary-fixed": "#dae2fd",
                        "on-background": "#0b1c30",
                        "tertiary-container": "#bf3003",
                        "primary-fixed": "#dde1ff",
                        "surface-dim": "#cbdbf5",
                        "error": "#ba1a1a"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "gutter-grid": "24px",
                        "margin-canvas": "32px",
                        "padding-card": "24px",
                        "base": "8px",
                        "sidebar-width": "280px"
                    },
                    fontFamily: {
                        "body-md": ["Inter"],
                        "body-sm": ["Inter"],
                        "display-lg": ["Inter"],
                        "label-caps": ["Inter"],
                        "data-mono": ["JetBrains Mono"],
                        "title-sm": ["Inter"],
                        "headline-md": ["Inter"]
                    },
                    fontSize: {
                        "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "body-sm": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                        "display-lg": ["36px", { lineHeight: "44px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "label-caps": ["12px", { lineHeight: "16px", letterSpacing: "0.05em", fontWeight: "600" }],
                        "data-mono": ["14px", { lineHeight: "20px", fontWeight: "500" }],
                        "title-sm": ["18px", { lineHeight: "24px", fontWeight: "600" }],
                        "headline-md": ["24px", { lineHeight: "32px", letterSpacing: "-0.01em", fontWeight: "600" }]
                    }
                }
            }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Utility for simulating ring charts via conic gradient using theme colors */
        .ring-chart-low { background: conic-gradient(var(--tw-colors-primary) 75%, var(--tw-colors-surface-container) 0); }
        .ring-chart-risk { background: conic-gradient(var(--tw-colors-tertiary) 15%, var(--tw-colors-surface-container) 0); }
        .ring-chart-high { background: conic-gradient(var(--tw-colors-error) 8%, var(--tw-colors-surface-container) 0); }
        .ring-chart-inactive { background: conic-gradient(var(--tw-colors-secondary) 2%, var(--tw-colors-surface-container) 0); }
    </style>
</head>
<body class="bg-background text-on-background font-body-md antialiased min-h-screen flex flex-col">
<!-- TopNavBar -->
<header class="fixed w-full top-0 z-50 bg-surface flex justify-between items-center px-margin-canvas h-16 w-full drop-shadow-sm">
<div class="flex items-center gap-8">
<div class="font-headline-md text-headline-md text-primary font-bold tracking-tight">RetentionPro</div>

<nav class="hidden md:flex gap-6 h-full items-center">
<a class="font-title-sm text-title-sm text-primary border-b-2 border-primary pb-1 flex items-center h-full opacity-80 duration-150" href="Index.php?page=dashboard">General</a>

<a class="font-title-sm text-title-sm text-secondary hover:text-primary transition-colors flex items-center h-full" href="Index.php?page=detalle">Detalles</a>

<a class="font-title-sm text-title-sm text-secondary hover:text-primary transition-colors flex items-center h-full" href="Index.php?page=reportes">Reportes</a>
</nav>

</div>
<div class="flex items-center gap-4">
<button class="text-secondary hover:text-primary transition-colors p-2 rounded-full hover:bg-surface-container-high flex items-center justify-center">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="text-secondary hover:text-primary transition-colors p-2 rounded-full hover:bg-surface-container-high flex items-center justify-center">
<span class="material-symbols-outlined">settings</span>
</button>
<div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-title-sm text-title-sm overflow-hidden ml-2 cursor-pointer border border-outline-variant">
<img alt="User profile" class="w-full h-full object-cover" data-alt="A professional headshot of a corporate analytics executive. The lighting is bright and even, casting soft shadows to emphasize a modern, authoritative aesthetic. The background is a clean, neutral white to match a high-end SaaS dashboard environment." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAwqK05HBrYlkiGhXfR5nnbCFjCSXnJF5xKBnDwDfqnMPSOMAViGZ2yzzVgVnDIVJTan7euhtgLEyANKwBSfw-QjTopiw1kD52VQst4FwhNA9pyqXNqwe9FwRtFG9O_dyJs214nL6n-JAKmBAVQG33SxLZMVHiWY322PU14fS0ErCmranYR59CMwGYrPDEWuaehI76FU-GDUNmz6NlVB4G5WZJXz6LUOOXPSCRZilGupwvbIxv1sBrfU1p-1oJ3hj5c7KmNgtEZfgQ"/> 
</div>
</div>
</header>
<div class="flex flex-1 mt-16">

<!-- Main Content Canvas -->
<main class="flex-1 p-margin-canvas flex flex-col gap-8 bg-background min-h-full max-w-7xl mx-auto w-full">
<header class="flex justify-between items-end">
<div>
<h1 class="font-display-lg text-display-lg text-on-surface">Client Health Overview</h1>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Real-time distribution of customer retention probability.</p>
</div>
<div class="flex gap-3">
<button class="bg-surface-container-lowest border border-primary text-primary font-body-sm text-body-sm px-4 py-2 rounded-lg hover:bg-surface-container transition-colors">Generate PDF</button>
<button onclick="location.reload()" class="bg-primary text-on-primary font-body-sm text-body-sm px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-on-primary-fixed-variant transition-colors shadow-sm">
<span class="material-symbols-outlined text-[18px]">sync</span>
                        Refresh Data
                    </button>
</div>
</header>
<!-- 4 Status Cards (Ring Charts) -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto w-full">

<!-- Low Risk -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-padding-card flex flex-col items-center hover:bg-surface-container-lowest/80 transition-colors group">
<h3 class="font-title-sm text-title-sm text-on-surface w-full text-center mb-6">Low Risk</h3>
<div class="relative w-32 h-32 rounded-full ring-chart-low flex items-center justify-center mb-4">
<div class="absolute inset-2 bg-surface-container-lowest rounded-full flex items-center justify-center flex-col group-hover:bg-surface transition-colors">
<span class="font-headline-md text-headline-md text-primary"><?php echo number_format($porcVerde, 1) . '%'; ?></span>
</div>
</div>
<div class="flex items-center gap-2 mt-auto">
<span class="w-2 h-2 rounded-full bg-primary"></span>
<span class="font-data-mono text-data-mono text-on-surface-variant"><?php echo number_format($verde, 0) . ' Clients'; ?></span>
</div>
</div>
<!-- At Risk -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-padding-card flex flex-col items-center hover:bg-surface-container-lowest/80 transition-colors group">
<h3 class="font-title-sm text-title-sm text-on-surface w-full text-center mb-6">At Risk</h3>
<div class="relative w-32 h-32 rounded-full ring-chart-risk flex items-center justify-center mb-4">
<div class="absolute inset-2 bg-surface-container-lowest rounded-full flex items-center justify-center flex-col group-hover:bg-surface transition-colors">
<span class="font-headline-md text-headline-md text-tertiary"><?php echo number_format($porcAmarillo, 1) . '%'; ?></span>
</div>
</div>
<div class="flex items-center gap-2 mt-auto bg-tertiary-fixed-dim/30 px-3 py-1 rounded-full border border-tertiary-fixed-dim">
<span class="w-2 h-2 rounded-full bg-tertiary"></span>
<span class="font-data-mono text-data-mono text-tertiary"><?php echo number_format($amarillo, 0) . ' Clients'; ?></span>
</div>
</div>
<!-- High Risk -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-padding-card flex flex-col items-center hover:bg-surface-container-lowest/80 transition-colors group">
<h3 class="font-title-sm text-title-sm text-on-surface w-full text-center mb-6">High Risk</h3>
<div class="relative w-32 h-32 rounded-full ring-chart-high flex items-center justify-center mb-4">
<div class="absolute inset-2 bg-surface-container-lowest rounded-full flex items-center justify-center flex-col group-hover:bg-surface transition-colors">
<span class="font-headline-md text-headline-md text-error"><?php echo number_format($porcRojo, 1) . '%'; ?></span>
</div>
</div>
<div class="flex items-center gap-2 mt-auto bg-error-container/50 px-3 py-1 rounded-full border border-error-container">
<span class="w-2 h-2 rounded-full bg-error"></span>
<span class="font-data-mono text-data-mono text-error"><?php echo number_format($rojo, 0) . ' Clients'; ?></span>
</div>
</div>

</section>
<!-- Two List Cards -->
<section class="grid grid-cols-1 xl:grid-cols-2 gap-gutter-grid">
<!-- Top 5 Green Clients -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden flex flex-col">
<div class="p-4 border-b border-outline-variant bg-surface flex justify-between items-center">
<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded-full bg-primary"></span>
<h3 class="font-title-sm text-title-sm text-on-surface"><?php echo $LowRisk .' Top Low Risk Clients'; ?></h3>
</div>
<button class="text-primary font-body-sm text-body-sm hover:underline"></button>
</div>
<div class="flex-1 overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">
<th class="p-4 font-semibold">Client Name</th>
<th class="p-4 font-semibold">Health Score</th>
<th class="p-4 font-semibold">Purchased</th>
</tr>
</thead>
<tbody class="font-body-sm text-body-sm text-on-surface">
    <?php while ($cliente = $resultadoLowRisk->fetch_assoc()) { ?>
<tr class="border-b border-outline-variant hover:bg-surface-container-low transition-colors h-[56px]">
<td class="p-4 font-medium"><?php echo $cliente['nombre'] ?></td>
<td class="p-4"><span class="font-data-mono text-data-mono text-primary"><?php echo $cliente['score']; ?>/100</span></td>
<td class="p-4 font-data-mono text-data-mono"><?php echo '$' . number_format($cliente['valor_compras_mes_cop'], 2); ?></td>
</tr>
    <?php } ?>
</tbody>
</table>
</div>
</div>
<!-- Top 5 Red Clients -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden flex flex-col">
<div class="p-4 border-b border-outline-variant bg-error-container/10 flex justify-between items-center">
<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded-full bg-error animate-pulse"></span>
<h3 class="font-title-sm text-title-sm text-on-surface"><?php echo $HighRisk .' Top High Risk Clients'; ?></h3>
</div>
<button class="text-error font-body-sm text-body-sm hover:underline"></button>
</div>
<div class="flex-1 overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">
<th class="p-4 font-semibold">Client Name</th>
<th class="p-4 font-semibold">Health Score</th>
<th class="p-4 font-semibold">Purchased</th>
</tr>
<?php while ($cliente = $resultadoHighRisk->fetch_assoc()) { ?>
<tr class="border-b border-outline-variant hover:bg-surface-container-low transition-colors h-[56px]">
<td class="p-4 font-medium"><?php echo $cliente['nombre'] ?></td>
<td class="p-4"><span class="font-data-mono text-data-mono text-error font-bold"><?php echo $cliente['score']; ?>/100</span></td>
<td class="p-4 font-data-mono text-data-mono"><?php echo '$' . number_format($cliente['valor_compras_mes_cop'], 2); ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</section>
<!-- Bottom Horizontal Bar Chart -->
<section class="bg-surface-container-lowest border border-outline-variant rounded-xl p-padding-card mt-auto">
<div class="flex justify-between items-center mb-8">
<h3 class="font-title-sm text-title-sm text-on-surface">Possible reasons for dropout (30 Days)</h3>
<div class="flex gap-4">
</div>
</div>
<div class="flex flex-col gap-5">

<!-- Métrica 1 -->
<div>
    <div class="flex justify-between mb-1">
        <span class="font-body-sm">Customer Inactivity</span>
        <span class="font-data-mono"><?php echo number_format($Porc_Inactivo, 2); ?>%</span>
    </div>

    <div class="w-full bg-surface-container h-4 rounded-full overflow-hidden">
        <div class="bg-tertiary h-full rounded-full" style="width: <?php echo number_format($Porc_Inactivo, 2); ?>%;
            background-color: rgb(124 58 237);"></div>
    </div>
</div>

<!-- Métrica 2 -->
<div>
    <div class="flex justify-between mb-1">
        <span class="font-body-sm">Weekly Frequency</span>
        <span class="font-data-mono"><?php echo number_format($Porc_FSemanal, 2); ?>%</span>
    </div>

    <div class="w-full bg-surface-container h-4 rounded-full overflow-hidden">
        <div class="bg-secondary h-full rounded-full" style="width: <?php echo number_format($Porc_FSemanal, 2); ?>%;
            background-color: rgb(79 70 229)"></div>
    </div>
</div>

<!-- Métrica 3 -->
<div>
    <div class="flex justify-between mb-1">
        <span class="font-body-sm">Monthly Orders</span>
        <span class="font-data-mono"><?php echo number_format($Porc_Pedidos, 2); ?>%</span>
    </div>

    <div class="w-full bg-surface-container h-4 rounded-full overflow-hidden">
        <div class="bg-primary h-full rounded-full" style="width: <?php echo number_format($Porc_Pedidos, 2); ?>%;
            background-color: rgb(37 99 235)"></div>
    </div>
</div>

<!-- Métrica 4 -->
<div>
    <div class="flex justify-between mb-1">
        <span class="font-body-sm">Purchase Value</span>
        <span class="font-data-mono"><?php echo number_format($Porc_ValorCompras, 2); ?>%</span>
    </div>

    <div class="w-full bg-surface-container h-4 rounded-full overflow-hidden">
        <div class="bg-error h-full rounded-full" style="width: <?php echo number_format($Porc_ValorCompras, 2); ?>%;
            background-color: rgb(8 145 178)"></div>
    </div>
</div>

<!-- Métrica 5 -->
<div>
    <div class="flex justify-between mb-1">
        <span class="font-body-sm">Customer Support Request</span>
        <span class="font-data-mono"><?php echo number_format($Porc_PQR, 2); ?>%</span>
    </div>

    <div class="w-full bg-surface-container h-4 rounded-full overflow-hidden">
        <div class="bg-primary-container h-full rounded-full" style="width: <?php echo number_format($Porc_PQR, 2); ?>%;
            background-color: rgb(5 150 105)"></div>
    </div>
</div>

<!-- Métrica 6 -->
<div>
    <div class="flex justify-between mb-1">
        <span class="font-body-sm">Open Support Tikets</span>
        <span class="font-data-mono"><?php echo number_format($Porc_PQRAbierta, 2); ?>%</span>
    </div>

    <div class="w-full bg-surface-container h-4 rounded-full overflow-hidden">
        <div class="bg-secondary-container h-full rounded-full" style="width: <?php echo number_format($Porc_PQRAbierta, 2); ?>%;
            background-color: rgb(132 204 22)"></div>
    </div>
</div>

<!-- Métrica 7 -->
<div>
    <div class="flex justify-between mb-1">
        <span class="font-body-sm">Customer Tenure</span>
        <span class="font-data-mono"><?php echo number_format($Porc_Antiguedad, 2); ?>%</span>
    </div>

    <div class="w-full bg-surface-container h-4 rounded-full overflow-hidden" >
        <div class="bg-outline h-full rounded-full" style="width: <?= round($Porc_Antiguedad, 2) ?>%;
            background-color: rgb(217 119 6)"></div>
    </div>
</div>

<!-- Métrica 8 -->
<div>
    <div class="flex justify-between mb-1">
        <span class="font-body-sm">Order Cancellations</span>
        <span class="font-data-mono"><?php echo number_format($Porc_Cancelaciones, 2); ?>%</span>
    </div>

    <div class="w-full bg-surface-container h-4 rounded-full overflow-hidden">
        <div class="bg-outline-variant h-full rounded-full" style="width: <?php echo number_format($Porc_Cancelaciones, 2); ?>%;
            background-color: rgb(219 39 119)"></div>
    </div>
</div>

</div>
</div>
</section>
</main>
</div>
<!-- Footer -->
<footer class="bg-inverse-surface flex justify-between items-center px-margin-canvas py-8 w-full z-50 relative">
<div class="font-label-caps text-label-caps text-on-primary-container uppercase tracking-widest">
           © 2026 Works On My Machine. All rights reserved.
        </div>
<div class="flex gap-6">
<a class="font-label-caps text-label-caps text-outline-variant hover:text-white hover:underline transition-all opacity-90 hover:opacity-100 uppercase tracking-widest" href="#">Privacy Policy</a>
<a class="font-label-caps text-label-caps text-outline-variant hover:text-white hover:underline transition-all opacity-90 hover:opacity-100 uppercase tracking-widest" href="#">Terms of Service</a>
<a class="font-label-caps text-label-caps text-outline-variant hover:text-white hover:underline transition-all opacity-90 hover:opacity-100 uppercase tracking-widest" href="#">Support</a>
</div>
</footer>
</body></html>