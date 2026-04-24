<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Precise Monolith</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="antialiased bg-slate-50">
        <div class="relative flex items-center justify-center min-h-screen">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <h1 class="text-6xl font-black text-blue-600 mb-4 tracking-tighter">Precise Monolith</h1>
                <p class="text-xl text-slate-500 mb-12 font-medium">Painel Administrativo completo criado com Laravel.</p>
                <div class="flex flex-col items-center gap-4">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-3 bg-blue-600 text-white px-10 py-5 rounded-2xl font-black text-lg hover:bg-blue-700 transition-all shadow-2xl hover:scale-105 active:scale-95 duration-150">
                            <span class="material-symbols-outlined">dashboard</span>
                            Ir para Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-3 bg-blue-600 text-white px-10 py-5 rounded-2xl font-black text-lg hover:bg-blue-700 transition-all shadow-2xl hover:scale-105 active:scale-95 duration-150">
                            <span class="material-symbols-outlined">login</span>
                            Acessar Painel
                        </a>
                    @endauth
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Login: admin@admin.com | Senha: password</p>
                </div>
            </div>
        </div>
    </body>
</html>
