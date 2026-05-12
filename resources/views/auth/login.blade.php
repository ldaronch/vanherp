<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Entrar | Painel Precise Monolith</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any"/>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96"/>
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}"/>
    <link rel="manifest" href="{{ asset('site.webmanifest') }}"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#29344D",
                        "secondary": "#C5A573",
                        "tertiary": "#DABC89",
                        "on-primary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "on-tertiary": "#191c1d",
                        "background": "#f8f9fa",
                        "surface": "#f8f9fa",
                        "on-surface": "#191c1d",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f3f4f5",
                        "surface-container": "#edeeef",
                        "surface-container-high": "#e7e8e9",
                        "surface-container-highest": "#e1e3e4",
                        "on-surface-variant": "#414754",
                        "outline": "#727785",
                        "outline-variant": "#c1c6d6",
                        "primary-container": "#29344D",
                        "on-primary-container": "#ffffff",
                        "primary-fixed": "#29344D",
                        "secondary-fixed": "#C5A573"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.5rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Inter"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .polish-gradient {
            background: linear-gradient(135deg, #29344D 0%, #C5A573 100%);
        }
        .ambient-lift {
            box-shadow: 0px 4px 20px rgba(25, 28, 29, 0.04), 0px 12px 40px rgba(25, 28, 29, 0.08);
        }
        .ghost-border {
            border: 1px solid rgba(193, 198, 214, 0.15);
        }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased min-h-screen flex flex-col items-center justify-center relative overflow-hidden">
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-primary-fixed/30 blur-[120px]"></div>
        <div class="absolute -bottom-[20%] -right-[10%] w-[60%] h-[60%] rounded-full bg-secondary-fixed/20 blur-[120px]"></div>
    </div>
    <main class="relative z-10 w-full max-w-md px-6 py-8 flex items-center justify-center">
        <div class="w-full">
            <div class="bg-surface-container-lowest ambient-lift p-7 md:p-8 rounded-[1rem] ghost-border flex flex-col">
                <div class="flex flex-col items-center mb-6">
                    <img alt="Logo" class="h-24 w-auto mb-2" src="{{ route('site.logo') }}"/>
                </div>
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-bold text-on-surface tracking-tight">Bem-vindo(a)</h2>
                    <p class="text-on-surface-variant font-medium text-sm mt-1">Informe seus dados para acessar o painel.</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-100 text-sm font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="space-y-5" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="email">E-mail</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">mail</span>
                            <input class="w-full bg-surface-container-lowest ghost-border rounded-lg py-3.5 pl-11 pr-4 text-sm font-medium focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all outline-none" id="email" name="email" placeholder="seuemail@dominio.com" type="email" value="{{ old('email') }}" required autofocus/>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="password">Senha</label>
                            <a class="text-xs font-semibold text-primary hover:underline transition-all" href="{{ route('password.request') }}">Esqueci minha senha</a>
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">lock</span>
                            <input class="w-full bg-surface-container-lowest ghost-border rounded-lg py-3.5 pl-11 pr-4 text-sm font-medium focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all outline-none" id="password" name="password" placeholder="••••••••••••" type="password" required/>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 py-1">
                        <input class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary" id="remember" name="remember" type="checkbox"/>
                        <label class="text-sm font-medium text-on-surface-variant cursor-pointer select-none" for="remember">Lembrar neste dispositivo</label>
                    </div>
                    <button class="w-full bg-primary text-white font-bold py-4 rounded-lg shadow-lg shadow-primary/20 hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-2" type="submit">
                        <span>Entrar no painel</span>
                        <span class="material-symbols-outlined">login</span>
                    </button>
                </form>
                <div class="mt-8 flex flex-col items-center space-y-3">
                    <div class="flex items-center gap-4 w-full">
                        <div class="h-[1px] flex-1 bg-outline-variant opacity-20"></div>
                        <span class="text-[10px] uppercase font-bold tracking-[0.2em] text-on-surface-variant/60">Acesso restrito</span>
                        <div class="h-[1px] flex-1 bg-outline-variant opacity-20"></div>
                    </div>
                    <p class="text-xs text-on-surface-variant/80 text-center leading-relaxed">
                        Somente pessoal autorizado. Todas as tentativas de acesso são registradas e monitoradas.
                    </p>
                </div>
            </div>
        </div>
    </main>
    <footer class="w-full py-8 mt-auto z-10 border-t border-outline-variant/10">
        <div class="max-w-[1200px] mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] uppercase tracking-widest font-semibold text-secondary">
                © 2026 Precise Monolith. Sistema operacional.
            </p>
            <div class="flex items-center gap-6">
                <a class="text-[10px] uppercase tracking-widest font-semibold text-secondary hover:text-primary transition-colors" href="#">Política de Privacidade</a>
                <a class="text-[10px] uppercase tracking-widest font-semibold text-secondary hover:text-primary transition-colors" href="#">Termos de Uso</a>
                <a class="text-[10px] uppercase tracking-widest font-semibold text-secondary hover:text-primary transition-colors" href="#">Contato</a>
            </div>
        </div>
    </footer>
</body>
</html>
