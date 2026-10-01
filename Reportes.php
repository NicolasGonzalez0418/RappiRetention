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
}

echo " Distribución de clientes:\n";

$NClientes = count($clientes);
$EjecucionesR = $rojo*4 + $amarillo*2 + $verde;
echo " Datos extraídos en Prin.php: " . $NClientes . " clientes encontrados\n";

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
$query = "SELECT " . implode(",", $columnas) . " FROM clientes_rappipro ORDER BY id_cliente ";
$resultadoClientes = $conexion->query($query);
date_default_timezone_set("America/Bogota");
$fecha_hora = date("Y-m-d H:i:s");
?>

<!DOCTYPE html>

<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "background": "#f8f9ff",
                    "surface-container-lowest": "#ffffff",
                    "primary": "#003ec7",
                    "secondary": "#565e74",
                    "tertiary-fixed": "#ffdbd2",
                    "secondary-container": "#dae2fd",
                    "primary-fixed-dim": "#b7c4ff",
                    "secondary-fixed": "#dae2fd",
                    "tertiary": "#952200",
                    "tertiary-fixed-dim": "#ffb4a1",
                    "on-error-container": "#93000a",
                    "surface-container-highest": "#d3e4fe",
                    "primary-fixed": "#dde1ff",
                    "on-surface-variant": "#434656",
                    "on-primary": "#ffffff",
                    "on-background": "#0b1c30",
                    "inverse-surface": "#213145",
                    "surface-tint": "#004ced",
                    "on-tertiary-fixed-variant": "#891e00",
                    "surface-container-high": "#dce9ff",
                    "on-secondary-fixed-variant": "#3f465c",
                    "on-primary-fixed-variant": "#0038b6",
                    "inverse-primary": "#b7c4ff",
                    "on-primary-fixed": "#001452",
                    "tertiary-container": "#bf3003",
                    "surface-variant": "#d3e4fe",
                    "on-tertiary-container": "#ffddd5",
                    "surface-container": "#e5eeff",
                    "on-tertiary-fixed": "#3c0800",
                    "inverse-on-surface": "#eaf1ff",
                    "error": "#ba1a1a",
                    "on-secondary-container": "#5c647a",
                    "on-surface": "#0b1c30",
                    "surface-container-low": "#eff4ff",
                    "surface": "#f8f9ff",
                    "on-tertiary": "#ffffff",
                    "on-secondary-fixed": "#131b2e",
                    "on-primary-container": "#dfe3ff",
                    "error-container": "#ffdad6",
                    "on-secondary": "#ffffff",
                    "surface-bright": "#f8f9ff",
                    "secondary-fixed-dim": "#bec6e0",
                    "on-error": "#ffffff",
                    "outline-variant": "#c3c5d9",
                    "primary-container": "#0052ff",
                    "outline": "#737688",
                    "surface-dim": "#cbdbf5"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "sidebar-width": "280px",
                    "gutter-grid": "24px",
                    "base": "8px",
                    "margin-canvas": "32px",
                    "padding-card": "24px"
            },
            "fontFamily": {
                    "title-sm": ["Inter"],
                    "body-sm": ["Inter"],
                    "label-caps": ["Inter"],
                    "display-lg": ["Inter"],
                    "data-mono": ["JetBrains Mono"],
                    "body-md": ["Inter"],
                    "headline-md": ["Inter"]
            },
            "fontSize": {
                    "title-sm": ["18px", {"lineHeight": "24px", "fontWeight": "600"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                    "display-lg": ["36px", {"lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "data-mono": ["14px", {"lineHeight": "20px", "fontWeight": "500"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col">

<!-- TopAppBar Shell -->
<!-- TopNavBar -->
<header class="fixed top-0 left-0 right-0 z-50 bg-surface dark:bg-inverse-surface border-b border-surface-container-low dark:border-inverse-surface flex justify-between items-center px-margin-canvas h-16 w-full">

    <!-- Left -->
    <div class="flex items-center gap-8">

        <div class="font-headline-md text-headline-md text-primary dark:text-inverse-primary font-bold tracking-tight">
            RetentionPro
        </div>

        <nav class="hidden md:flex gap-6 h-full items-center">

            <a class="font-title-sm text-title-sm text-secondary dark:text-primary-fixed-dim hover:text-primary dark:hover:text-primary-fixed hover:bg-surface-container-high dark:hover:bg-surface-variant transition-colors px-3 py-2 rounded-md flex items-center h-full"
               href="Index.php?page=dashboard">
                General
            </a>

            <a class="font-title-sm text-title-sm text-secondary dark:text-inverse-primary border-b-2 border-primary dark:border-inverse-primary pb-1 flex items-center h-full opacity-80"
               href="Index.php?page=detalle">
                Details
            </a>

            <a class="font-title-sm text-title-sm text-primary dark:text-primary-fixed-dim hover:text-primary dark:hover:text-primary-fixed hover:bg-surface-container-high dark:hover:bg-surface-variant transition-colors px-3 py-2 rounded-md flex items-center h-full"
               href="Index.php?page=reportes">
                Reports
            </a>

        </nav>
    </div>

    <!-- Right -->
    <div class="flex items-center gap-4">

        <div class="relative ml-2">

            <!-- Avatar con imagen -->
            <button onclick="toggleMenu()"
                class="w-8 h-8 rounded-full overflow-hidden border border-outline-variant">
                
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAwqK05HBrYlkiGhXfR5nnbCFjCSXnJF5xKBnDwDfqnMPSOMAViGZ2yzzVgVnDIVJTan7euhtgLEyANKwBSfw-QjTopiw1kD52VQst4FwhNA9pyqXNqwe9FwRtFG9O_dyJs214nL6n-JAKmBAVQG33SxLZMVHiWY322PU14fS0ErCmranYR59CMwGYrPDEWuaehI76FU-GDUNmz6NlVB4G5WZJXz6LUOOXPSCRZilGupwvbIxv1sBrfU1p-1oJ3hj5c7KmNgtEZfgQ"
                     class="w-full h-full object-cover"
                     alt="User profile">

            </button>

            <!-- Dropdown -->
            <div id="userMenu"
                 class="hidden absolute right-0 mt-2 w-40 bg-surface dark:bg-inverse-surface border border-outline-variant rounded-lg shadow-lg overflow-hidden z-50">

                <a href="Index.php?logout=true"
                   class="block px-4 py-3 text-body-sm text-on-surface hover:bg-surface-container transition-colors">
                    Log out
                </a>

            </div>

        </div>

    </div>

</header>

<main class="flex-grow pt-24 pb-12 px-margin-canvas max-w-[1440px] mx-auto w-full">

<!-- Header de Resumen (KPIs) -->
<section class="grid grid-cols-1 gap-gutter-grid mb-margin-canvas md:grid-cols-2">
<div class="bg-surface-container-lowest border border-outline-variant p-padding-card rounded-xl">
<div class="flex justify-between items-start mb-4">
<span class="font-label-caps text-label-caps text-outline uppercase">Actions Taken</span>
<span class="material-symbols-outlined text-primary" data-icon="bolt">bolt</span>
</div>
<div class="text-display-lg font-display-lg"><?php echo $EjecucionesR; ?></div>
<div class="text-body-sm text-secondary mt-1 flex items-center gap-1">
<span class="text-primary font-bold">↑ 20%</span> vs previous month</div>
</div>
<div class="bg-surface-container-lowest border border-outline-variant p-padding-card rounded-xl">
<div class="flex justify-between items-start mb-4">
<span class="font-label-caps text-label-caps text-outline uppercase">Conversion Rate</span>
<span class="material-symbols-outlined text-primary" data-icon="sync_saved_locally">sync_saved_locally</span>
</div>
<div class="text-display-lg font-display-lg">31%</div>
<div class="text-body-sm text-secondary mt-1">Successfully recovered customers</div>
</div>
</section>
<!-- Main Content Area: Bento Grid Layout -->
<div class="grid grid-cols-1 gap-gutter-grid">
<!-- Log de Automatización -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden flex flex-col">
<div class="p-6 border-b border-outline-variant flex justify-between items-center">
<div>
<h2 class="font-title-sm text-title-sm">Log of Automatization</h2>
<p class="text-body-sm text-outline">Last actions executed by n8n</p>
</div>
////<button class="text-primary hover:bg-primary-container/10 px-3 py-1.5 rounded-lg text-body-sm font-semibold transition-colors flex items-center gap-2">
////<span class="material-symbols-outlined text-[18px]" onclick="Reportes.filtrar()"data-icon="filter_list">filter_list</span>
    ////                    Filter</button>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left">
<thead class="bg-surface-container-low">
<tr>
<th class="px-6 py-4 font-label-caps text-label-caps text-outline uppercase">Date/Time</th>
<th class="px-6 py-4 font-label-caps text-label-caps text-outline uppercase">Customer</th>
<th class="px-6 py-4 font-label-caps text-label-caps text-outline uppercase">Risk</th>
<th class="px-6 py-4 font-label-caps text-label-caps text-outline uppercase">Action n8n</th>
<th class="px-6 py-4 font-label-caps text-label-caps text-outline uppercase">Status</th>
</tr>
</thead>
<?php while ($cliente = $resultadoClientes->fetch_assoc()) { ?>
<tbody class="divide-y divide-outline-variant">
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="px-6 py-4 font-data-mono text-data-mono"><?php echo $fecha_hora; ?></td>
<td class="px-6 py-4 font-body-md text-body-md font-medium"><?php echo $cliente['nombre'] . " " . $cliente['apellido']; ?></td>
<td class="px-6 py-4">
<?php
    $score = $cliente['score'];
    if ($score >= 0 && $score <= 33.3) {
        $result = "Critical";
        $ColorA = "#c85454";
    } elseif ($score > 33.3 && $score <= 66.6) {
        $result = "Medium";
        $ColorA = "#e7d954";
    } else{
        $result = "Low";
        $ColorA = "#4caf50";
    }
    $ColorB = "white";
?>
<span class="inline-flex items-center gap-1.5 bg-error-container text-on-error-container px-2.5 py-1 rounded-full text-xs font-bold" style="background-color: <?php echo $ColorA; ?>;color: white;" ><?= $result ?></span>
<span class="w-2 h-2 rounded-full bg-error" style = "color: white;"></span>
</span>
</td>
<td class="px-6 py-4 text-body-sm text-secondary" ><?php
    if($result == "Critical"){
        $accion = "Push RappiAPP,WhatsApp, Email y Intuitive Agent";
    } elseif($result == "Medium"){
        $accion = "Follow-up Email and WhatsApp";
    } else{
        $accion = "RappiAPP Push Notifications with Personalized Offers";
    }
    echo $accion;?>

<td class="px-6 py-4">
<span class="material-symbols-outlined text-[16px]" data-icon="task_alt">send</span>
                                        sent and executed
                                    </span>
</td>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<div class="mt-auto p-4 border-t border-outline-variant flex justify-center">
<button class="text-body-sm text-outline hover:text-primary font-medium transition-colors"></button>
</div>
</div>
<!-- Gráfico de Ahorro de Margen -->
</div>
</main>
<!-- Footer Shell -->
<footer class="bg-inverse-surface dark:bg-surface-container-lowest flex justify-between items-center px-margin-canvas py-8 w-full md:pl-[calc(280px+32px)] z-40 mt-auto">

    <div class="font-label-caps text-label-caps text-on-primary-container dark:text-primary uppercase tracking-widest">
        © 2026 Works On My Machine. All rights reserved.
    </div>

    <div class="flex gap-6">

        <div class="">

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
</body></html>