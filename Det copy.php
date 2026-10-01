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
<title>Retention Details Panel - RetentionPro</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }
    </style>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
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
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter-grid": "24px",
                        "margin-canvas": "32px",
                        "padding-card": "24px",
                        "base": "8px",
                        "sidebar-width": "280px"
                    },
                    "fontFamily": {
                        "body-md": ["Inter"],
                        "body-sm": ["Inter"],
                        "display-lg": ["Inter"],
                        "label-caps": ["Inter"],
                        "data-mono": ["JetBrains Mono"],
                        "title-sm": ["Inter"],
                        "headline-md": ["Inter"]
                    },
                    "fontSize": {
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "display-lg": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "label-caps": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "data-mono": ["14px", { "lineHeight": "20px", "fontWeight": "500" }],
                        "title-sm": ["18px", { "lineHeight": "24px", "fontWeight": "600" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
<!-- TopNavBar -->
<header class="fixed top-0 left-0 right-0 z-50 bg-surface dark:bg-inverse-surface border-b border-surface-container-low dark:border-inverse-surface flex justify-between items-center px-margin-canvas h-16 w-full">
<div class="flex items-center gap-8">
<div class="font-headline-md text-headline-md text-primary dark:text-inverse-primary">RetentionPro</div>
<nav class="hidden md:flex gap-6 h-full items-center">
<a class="font-title-sm text-title-sm text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-primary-fixed hover:bg-surface-container-high dark:hover:bg-surface-variant transition-colors px-3 py-2 rounded-md" href="Index.php?page=dashboard">General</a>

<a class="font-title-sm text-title-sm text-primary dark:text-inverse-primary border-b-2 border-primary dark:border-inverse-primary pb-1 px-3 py-2 opacity-80 duration-150" href="Index.php?page=detalle">Details</a>

<a class="font-title-sm text-title-sm text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-primary-fixed hover:bg-surface-container-high dark:hover:bg-surface-variant transition-colors px-3 py-2 rounded-md" href="Index.php?page=reportes">Reports</a>
</nav>

</div>
<div class="flex items-center gap-4">
<div class="relative ml-2">
    
    <button onclick="toggleMenu()"
                class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-title-sm text-title-sm overflow-hidden cursor-pointer border border-outline-variant">

                <img alt="User profile"
                     class="w-full h-full object-cover"
                     src="https://lh3.googleusercontent.com/aida-public/AB6AXuAwqK05HBrYlkiGhXfR5nnbCFjCSXnJF5xKBnDwDfqnMPSOMAViGZ2yzzVgVnDIVJTan7euhtgLEyANKwBSfw-QjTopiw1kD52VQst4FwhNA9pyqXNqwe9FwRtFG9O_dyJs214nL6n-JAKmBAVQG33SxLZMVHiWY322PU14fS0ErCmranYR59CMwGYrPDEWuaehI76FU-GDUNmz6NlVB4G5WZJXz6LUOOXPSCRZilGupwvbIxv1sBrfU1p-1oJ3hj5c7KmNgtEZfgQ"/>

            </button>

    <div id="userMenu"
                 class="hidden absolute right-0 mt-2 w-40 bg-surface border border-outline-variant rounded-lg shadow-lg overflow-hidden z-50">

                <a href="Index.php?logout=true"
                   class="block px-4 py-3 text-body-sm text-on-surface hover:bg-surface-container transition-colors">
                    Log out
                </a>

            </div>
</div>

<script>
function toggleMenu() {
    document.getElementById("userMenu").classList.toggle("hidden");
}
</script>
</div>
</header>
<div class="flex flex-1 pt-16">

<!-- Main Content Canvas -->
<main class="flex-1 p-margin-canvas flex flex-col gap-8 bg-background min-h-full max-w-7xl mx-auto w-full">
<div class="max-w-7xl mx-auto space-y-8">
<header class="mb-8">
<h1 class="font-headline-md text-headline-md text-on-background mb-2" style="font-size: 36px;">Retention Details Panel</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Customer segmentation by risk level and recommended actions.</p>
</header>
<!-- Section 1: Low Risk (Represented by Surface Container High) -->
<section class="bg-surface-container-high rounded-xl p-padding-card border border-outline-variant/50">
<div class="flex items-center gap-2 mb-6">
<div class="w-3 h-3 rounded-full bg-primary-fixed-dim"></div>
<h2 class="font-title-sm text-title-sm text-on-background">Stable Segment (Low Risk)</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter-grid">
<div class="bg-surface rounded-lg p-6 border border-outline-variant shadow-sm hover:bg-surface-bright transition-colors flex flex-col justify-center items-center text-center">
<p class="font-label-caps text-label-caps text-on-surface-variant mb-2">CURRENT CUSTOMERS</p>
<div class="font-display-lg text-display-lg text-on-surface"><?php echo $verde; ?></div>
</div>
<div class="bg-surface rounded-lg p-6 border border-outline-variant shadow-sm hover:bg-surface-bright transition-colors flex flex-col justify-center items-center text-center">
<p class="font-label-caps text-label-caps text-on-surface-variant mb-2">PERCENTAGE OF TOTAL</p>
<div class="font-display-lg text-display-lg text-on-surface"><?php echo number_format($porcVerde, 2); ?>%</div>
</div>
<div class="bg-surface rounded-lg p-6 border border-outline-variant shadow-sm hover:bg-surface-bright transition-colors flex flex-col justify-between">
<div>
<p class="font-label-caps text-label-caps text-on-surface-variant mb-3">RECOMMENDED ACTIONS</p>
<ul class="font-body-sm text-body-sm text-on-surface space-y-2">
<li class="flex items-start gap-2"><span class="material-symbols-outlined text-[16px] text-primary">check_circle</span>Periodic Rappi Pro benefits push notification.</li>
<li class="flex items-start gap-2"><span class="material-symbols-outlined text-[16px] text-primary">check_circle</span>Personalized recommendations based on consumption habits.</li>
<li class="flex items-start gap-2"><span class="material-symbols-outlined text-[16px] text-primary">check_circle</span>Automated Upsell campaigns.</li>
</ul>
</div>
</div>
</div>
</section>
<!-- Section 2: Medium Risk (Represented by Tertiary Fixed) -->
<section class="bg-tertiary-fixed rounded-xl p-padding-card border border-outline-variant/50">
<div class="flex items-center gap-2 mb-6">
<div class="w-3 h-3 rounded-full bg-tertiary-container"></div>
<h2 class="font-title-sm text-title-sm text-on-background">Segment Under Observation (Medium Risk)</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter-grid">
<div class="bg-surface rounded-lg p-6 border border-outline-variant shadow-sm hover:bg-surface-bright transition-colors flex flex-col justify-center items-center text-center">
<p class="font-label-caps text-label-caps text-on-surface-variant mb-2">AT-RISK CUSTOMERS</p>
<div class="font-display-lg text-display-lg text-on-surface"><?php echo $amarillo; ?></div>
</div>
<div class="bg-surface rounded-lg p-6 border border-outline-variant shadow-sm hover:bg-surface-bright transition-colors flex flex-col justify-center items-center text-center">
<p class="font-label-caps text-label-caps text-on-surface-variant mb-2">PERCENTAGE OF TOTAL</p>
<div class="font-display-lg text-display-lg text-on-surface"><?php echo number_format($porcAmarillo, 2); ?>%</div>
</div>
<div class="bg-surface rounded-lg p-6 border border-outline-variant shadow-sm hover:bg-surface-bright transition-colors flex flex-col justify-between">
<div>
<p class="font-label-caps text-label-caps text-on-surface-variant mb-3">RECOMMENDED ACTIONS</p>
<ul class="font-body-sm text-body-sm text-on-surface space-y-2">
<li class="flex items-start gap-2"><span class="material-symbols-outlined text-[16px] text-tertiary">warning</span>WhatsApp message highlighting underused features</li>
<li class="flex items-start gap-2"><span class="material-symbols-outlined text-[16px] text-tertiary">warning</span>Personalized email with value recommendations.</li>
</ul>
</div>
</div>
</div>
</section>
<!-- Section 3: High Risk (Represented by Error Container) -->
<section class="bg-error-container rounded-xl p-padding-card border border-outline-variant/50">
<div class="flex items-center gap-2 mb-6">
<div class="w-3 h-3 rounded-full bg-error"></div>
<h2 class="font-title-sm text-title-sm text-on-background">Critical Segment (High Risk)</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter-grid">
<div class="bg-surface rounded-lg p-6 border border-outline-variant shadow-sm hover:bg-surface-bright transition-colors flex flex-col justify-center items-center text-center">
<p class="font-label-caps text-label-caps text-on-surface-variant mb-2">CRITICAL CUSTOMERS</p>
<div class="font-display-lg text-display-lg text-on-surface"><?php echo $rojo; ?></div>
</div>
<div class="bg-surface rounded-lg p-6 border border-outline-variant shadow-sm hover:bg-surface-bright transition-colors flex flex-col justify-center items-center text-center">
<p class="font-label-caps text-label-caps text-on-surface-variant mb-2">PERCENTAGE OF TOTAL</p>
<div class="font-display-lg text-display-lg text-on-surface"><?php echo number_format($porcRojo, 2); ?>%</div>
</div>
<div class="bg-surface rounded-lg p-6 border border-outline-variant shadow-sm hover:bg-surface-bright transition-colors flex flex-col justify-between">
<div>
<p class="font-label-caps text-label-caps text-on-surface-variant mb-3">RECOMMENDED ACTIONS</p>
<ul class="font-body-sm text-body-sm text-on-surface space-y-2">
<li class="flex items-start gap-2"><span class="material-symbols-outlined text-[16px] text-error">priority_high</span>Immediate retention push notification</li>
<li class="flex items-start gap-2"><span class="material-symbols-outlined text-[16px] text-error">priority_high</span>Benefit reminder via WhatsApp</li>
<li class="flex items-start gap-2"><span class="material-symbols-outlined text-[16px] text-error">priority_high</span>Personalized subscription optimization email.</li>
<li class="flex items-start gap-2"><span class="material-symbols-outlined text-[16px] text-error">priority_high</span>Human-tone automated audio for issue identification.</li>
<li class="flex items-start gap-2"><span class="material-symbols-outlined text-[16px] text-error">priority_high</span>Possible reasons for</li>
</ul>
</div>
</div>
</div>
</section>
</div>
</main>
</div>

<!-- Footer -->
<footer class="bg-inverse-surface dark:bg-surface-container-lowest flex justify-between items-center px-margin-canvas py-8 w-full md:pl-[calc(280px+32px)] z-40 relative">

    <div class="font-label-caps text-label-caps text-on-primary-container dark:text-primary uppercase tracking-widest">
        © 2026 Works On My Machine. All rights reserved.
    </div>

    <div class="flex gap-6">

        <div class="relative">

            <button onclick="toggleSupportMenu()" 
                class="font-label-caps text-label-caps text-outline-variant dark:text-outline hover:text-white dark:hover:text-black hover:underline transition-all opacity-90 hover:opacity-100">
                Support
            </button>

            <div id="supportMenu" 
                class="hidden absolute bottom-8 right-0 w-48 bg-surface border border-outline-variant rounded-lg shadow-lg overflow-hidden z-50">

                <div class="px-4 py-3 text-body-sm text-on-surface text-center">
                    +57 313 2577258
                </div>

            </div>

        </div>

    </div>

</footer>

<script>
function toggleSupportMenu() {
    document.getElementById("supportMenu").classList.toggle("hidden");
}
</script>

</body>
</html>