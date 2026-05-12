<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Redefinir senha" name="description">
    <title>Redefinir senha</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any"/>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96"/>
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}"/>
    <link rel="manifest" href="{{ asset('site.webmanifest') }}"/>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@200..700" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#29344D",
                        "secondary": "#C5A573",
                        "surface": "#FBFBFD",
                        "surface-container-lowest": "#FFFFFF",
                        "surface-container-low": "#F2F3F6",
                        "on-surface": "#1A1C1E",
                        "on-surface-variant": "#43474E",
                        "outline-variant": "#C1C6D6",
                        "primary-fixed": "#DDE2FF",
                        "secondary-fixed": "#FFE08A"
                    },
                    fontFamily: {
                        "body": ["Exo 2"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
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
                    <h2 class="text-2xl font-bold text-on-surface tracking-tight">Redefinir senha</h2>
                    <p class="text-on-surface-variant font-medium text-sm mt-1">Defina uma nova senha para acessar o painel.</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-100 text-sm font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="space-y-5" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="email">E-mail</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">mail</span>
                            <input class="w-full bg-surface-container-lowest ghost-border rounded-lg py-3.5 pl-11 pr-4 text-sm font-medium focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all outline-none" id="email" name="email" type="email" value="{{ old('email', $email ?? request()->email) }}" required autocomplete="email"/>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="password">Nova senha</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">lock</span>
                            <input class="w-full bg-surface-container-lowest ghost-border rounded-lg py-3.5 pl-11 pr-4 text-sm font-medium focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all outline-none" id="password" name="password" type="password" required autocomplete="new-password"/>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="password-confirm">Confirmar senha</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">lock</span>
                            <input class="w-full bg-surface-container-lowest ghost-border rounded-lg py-3.5 pl-11 pr-4 text-sm font-medium focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all outline-none" id="password-confirm" name="password_confirmation" type="password" required autocomplete="new-password"/>
                        </div>
                    </div>

                    <button class="w-full bg-primary text-white font-bold py-4 rounded-lg shadow-lg shadow-primary/20 hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-2" type="submit">
                        <span>Salvar nova senha</span>
                        <span class="material-symbols-outlined">check</span>
                    </button>
                </form>

                <div class="mt-6 flex items-center justify-center">
                    <a class="text-xs font-semibold text-primary hover:underline transition-all" href="{{ route('login') }}">Voltar ao login</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
