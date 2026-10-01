<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>RetentionPro - Login</title>
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
<body class="bg-background text-on-background min-h-screen flex items-center justify-center p-margin-canvas">
<!-- Transactional Screen: Navigation suppressed -->
<main class="w-full max-w-md bg-surface-container-lowest border border-outline-variant rounded-lg p-padding-card shadow-sm flex flex-col gap-6">
<!-- Header -->
<div class="flex flex-col items-center gap-2 text-center">
<div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mb-2">
<span class="material-symbols-outlined text-on-primary text-3xl" style="font-variation-settings: 'FILL' 1;">insights</span>
</div>
<h1 class="font-headline-md text-headline-md text-on-surface">RetentionPro</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Sign in to your analytical dashboard</p>
</div>
<!-- Form -->
<form class="flex flex-col gap-4" method="POST" action="Index.php?page=validar">
<div class="flex flex-col gap-1">
<label class="font-label-caps text-label-caps text-on-surface" for="email">Email Address</label>
<input class="w-full h-12 px-4 rounded border border-outline-variant bg-surface focus:border-primary focus:ring-2 focus:ring-primary focus:ring-offset-2 text-on-surface font-body-md text-body-md" id="email" name="email" placeholder="name@company.com" required="" type="email"/>
</div>
<div class="flex flex-col gap-1">
<div class="flex justify-between items-center">
<label class="font-label-caps text-label-caps text-on-surface" for="password">Password</label>
<a class="font-label-caps text-label-caps text-primary hover:text-primary-container" href="#">Forgot password?</a>
</div>
<input class="w-full h-12 px-4 rounded border border-outline-variant bg-surface focus:border-primary focus:ring-2 focus:ring-primary focus:ring-offset-2 text-on-surface font-body-md text-body-md" id="password" name="password" placeholder="••••••••" required="" type="password"/>
</div>
<div class="flex items-center gap-2 mt-2">
<input class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary" id="remember" type="checkbox"/>
<label class="font-body-sm text-body-sm text-on-surface-variant" for="remember">Remember me for 30 days</label>
</div>
<button class="w-full h-12 mt-4 bg-on-background text-on-primary rounded-lg font-title-sm text-title-sm flex items-center justify-center hover:bg-primary transition-colors" type="submit">
                Sign In
            </button>
</form>
<!-- Footer -->
<div class="text-center mt-4 border-t border-outline-variant pt-4">
<p class="font-body-sm text-body-sm text-on-surface-variant">
                Don't have an account? <a class="text-primary font-bold hover:underline" href="#">Contact Us</a>
</p>
</div>
</main>
<!-- Footer Component (Simplified for transactional intent) -->
<footer class="fixed bottom-0 left-0 w-full py-4 text-center">
<p class="font-label-caps text-label-caps text-outline">© 2026 Works On My Machine. All rights reserved.</p>
</footer>
</body></html>