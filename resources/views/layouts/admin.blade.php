<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Precise Monolith - Dashboard')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any"/>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96"/>
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}"/>
    <link rel="manifest" href="{{ asset('site.webmanifest') }}"/>
    
    <!-- Font and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700;800&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet"/>
    
    <!-- Scripts & Styles -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                        "on-primary-container": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.5rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Exo 2"],
                        "body": ["Exo 2"],
                        "label": ["Exo 2"]
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
        .glass-panel {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        body {
            min-height: max(884px, 100dvh);
        }
        .max-w-xs,
        .max-w-sm,
        .max-w-md,
        .max-w-lg,
        .max-w-xl,
        .max-w-2xl,
        .max-w-3xl,
        .max-w-4xl,
        .max-w-5xl,
        .max-w-6xl,
        .max-w-7xl {
            max-width: none !important;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-surface font-body text-on-surface">
    <!-- TopAppBar -->
    <header class="fixed top-0 w-full z-50 bg-slate-50/80 backdrop-blur-md shadow-sm flex items-center justify-between px-6 h-16">
        <div class="flex items-center gap-4">
            <span class="material-symbols-outlined text-primary cursor-pointer">menu</span>
            <h1 class="text-lg font-bold tracking-tight text-primary">Dashboard</h1>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" id="openLogoutModal" class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:brightness-110 transition-colors active:scale-95 duration-150">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                <span class="hidden sm:inline">Sair</span>
            </button>
        </div>
    </header>

    <div id="logoutModal" class="fixed inset-0 z-[80] hidden">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex items-center justify-center p-6">
            <div class="w-full max-w-md rounded-2xl bg-white shadow-2xl border border-slate-100 overflow-hidden">
                <div class="p-6">
                    <div class="text-xl font-black text-slate-900">Sair do painel</div>
                    <div class="mt-2 text-slate-600">Deseja realmente sair do painel administrativo?</div>
                </div>
                <div class="px-6 pb-6 flex items-center justify-end gap-3">
                    <button type="button" id="cancelLogout" class="px-5 py-2.5 rounded-lg bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition-colors">Cancelar</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-white font-semibold hover:brightness-110 transition-colors">Sair</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar / NavigationDrawer -->
    <aside class="fixed inset-y-0 left-0 z-[60] flex flex-col p-4 h-full w-72 rounded-r-xl bg-white shadow-2xl border-none">
        <div class="flex items-center gap-3 px-2 py-6 mb-4">
            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                <img alt="Admin" class="w-full h-full object-cover rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD3MHeWPUjsDfeGCO4KVs1DibRL3L8cBUpM52S8RvYc6NVCYjCyzep5sU-EvolP9RRrDQ4z3CCrMxgKEjR3aQ8Fm4c2bfGZsE3vBpWZnBa10B_yfXSvEjsqjJpSpuHDoyeWAHcBteX6OsnFY_hI-xGODMAzc1thvY4ULusTdyAumOTdAB0dV-Rl-7UK5fVi-q4rh7Cl0_i_obk5X8bwfJjJsosEgPNzYIBqQXi3nvOR3M_q9ZuNKjhnrSRIP2J1_xPwjTwandjSFxzj"/>
            </div>
            <div class="flex flex-col">
                <span class="text-xl font-black text-slate-900">{{ Auth::user()->name ?? 'Admin Architect' }}</span>
                <span class="text-xs font-medium text-slate-500">Admin Access</span>
            </div>
        </div>
        <nav class="flex-1 space-y-1">
            <!-- Overview -->
            <a class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }} rounded-lg font-medium transition-all duration-200" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ request()->routeIs('admin.dashboard') ? 1 : 0 }};">dashboard</span>
                <span>Visão Geral</span>
            </a>

            <!-- Clients -->
            <a class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('admin.pi-clubs.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }} rounded-lg font-medium transition-all duration-200" href="{{ route('admin.pi-clubs.index') }}">
                <span class="material-symbols-outlined">group</span>
                <span>P&amp;I Clubs</span>
            </a>

            <div class="pt-2">
                <button type="button" data-menu-toggle="site-banners" aria-expanded="{{ (request()->routeIs('admin.banners.*') || request()->routeIs('admin.page-banners.*') || request()->routeIs('admin.contents.*')) ? 'true' : 'false' }}" class="w-full flex items-center justify-between px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg font-medium transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined">view_carousel</span>
                        <span>Banners do Site</span>
                    </div>
                    <span data-menu-chevron class="material-symbols-outlined text-sm transition-transform {{ (request()->routeIs('admin.banners.*') || request()->routeIs('admin.page-banners.*') || request()->routeIs('admin.contents.*')) ? 'rotate-180' : '' }}">expand_more</span>
                </button>
                <div data-menu-panel="site-banners" class="pl-12 space-y-1 mt-1 {{ (request()->routeIs('admin.banners.*') || request()->routeIs('admin.page-banners.*') || request()->routeIs('admin.contents.*')) ? '' : 'hidden' }}">
                    <a href="{{ route('admin.banners.index') }}" class="block py-1 text-sm {{ request()->routeIs('admin.banners.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">Banners Principais</a>
                    <a href="{{ route('admin.contents.index') }}" class="block py-1 text-sm {{ request()->routeIs('admin.contents.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">Banner dos Portos</a>
                    <a href="{{ route('admin.page-banners.index') }}" class="block py-1 text-sm {{ request()->routeIs('admin.page-banners.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">Banners das Páginas</a>
                </div>
            </div>

            <!-- SEO Pages -->
            <a class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('admin.seos.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }} rounded-lg font-medium transition-all duration-200" href="{{ route('admin.seos.index') }}">
                <span class="material-symbols-outlined">search</span>
                <span>Gerenciar SEO</span>
            </a>

            <!-- Home Text -->
            <a class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('admin.home-text.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }} rounded-lg font-medium transition-all duration-200" href="{{ route('admin.home-text.edit') }}">
                <span class="material-symbols-outlined">home</span>
                <span>Texto da Home</span>
            </a>

            <!-- Ports -->
            <a class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('admin.ports.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }} rounded-lg font-medium transition-all duration-200" href="{{ route('admin.ports.index') }}">
                <span class="material-symbols-outlined">directions_boat</span>
                <span>Portos</span>
            </a>

            <!-- Site Settings -->
            <a class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('admin.contact.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }} rounded-lg font-medium transition-all duration-200" href="{{ route('admin.contact.edit') }}">
                <span class="material-symbols-outlined">settings</span>
                <span>Configurações do Site</span>
            </a>

            <!-- Circulars & Guidelines -->
            <div class="pt-2">
                <button type="button" data-menu-toggle="circulars-guidelines" aria-expanded="{{ (request()->routeIs('admin.circulars.*') || request()->routeIs('admin.guidelines.*') || request()->routeIs('admin.circular-guidelines.*')) ? 'true' : 'false' }}" class="w-full flex items-center justify-between px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg font-medium transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined">description</span>
                        <span>Circulars &amp; Guidelines</span>
                    </div>
                    <span data-menu-chevron class="material-symbols-outlined text-sm transition-transform {{ (request()->routeIs('admin.circulars.*') || request()->routeIs('admin.guidelines.*') || request()->routeIs('admin.circular-guidelines.*')) ? 'rotate-180' : '' }}">expand_more</span>
                </button>
                <div data-menu-panel="circulars-guidelines" class="pl-12 space-y-1 mt-1 {{ (request()->routeIs('admin.circulars.*') || request()->routeIs('admin.guidelines.*') || request()->routeIs('admin.circular-guidelines.*')) ? '' : 'hidden' }}">
                    <a href="{{ route('admin.circulars.index') }}" class="block py-1 text-sm {{ request()->routeIs('admin.circulars.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">Circulars</a>
                    <a href="{{ route('admin.guidelines.index') }}" class="block py-1 text-sm {{ request()->routeIs('admin.guidelines.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">Guidelines</a>
                    <a href="{{ route('admin.circular-guidelines.index') }}" class="block py-1 text-sm {{ request()->routeIs('admin.circular-guidelines.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">Página (Seções)</a>
                </div>
            </div>

            <!-- Blog -->
            <div class="pt-2">
                <button type="button" data-menu-toggle="blog-news" aria-expanded="{{ (request()->routeIs('admin.posts.*') || request()->routeIs('admin.categories.*')) ? 'true' : 'false' }}" class="w-full flex items-center justify-between px-4 py-2 {{ request()->routeIs('admin.posts.*') || request()->routeIs('admin.categories.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }} rounded-lg font-medium transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined">newspaper</span>
                        <span>Blog e Notícias</span>
                    </div>
                    <span data-menu-chevron class="material-symbols-outlined text-sm transition-transform {{ (request()->routeIs('admin.posts.*') || request()->routeIs('admin.categories.*')) ? 'rotate-180' : '' }}">expand_more</span>
                </button>
                <div data-menu-panel="blog-news" class="pl-12 space-y-1 mt-1 {{ (request()->routeIs('admin.posts.*') || request()->routeIs('admin.categories.*')) ? '' : 'hidden' }}">
                    <a href="{{ route('admin.posts.index') }}" class="block py-1 text-sm {{ request()->routeIs('admin.posts.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">Notícias</a>
                    <a href="{{ route('admin.categories.index') }}" class="block py-1 text-sm {{ request()->routeIs('admin.categories.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">Categorias</a>
                </div>
            </div>

            <!-- About & Partners -->
            <div class="pt-2">
                <button type="button" data-menu-toggle="institutional" aria-expanded="{{ (request()->routeIs('admin.about.*') || request()->routeIs('admin.partners.*') || request()->routeIs('admin.legal-texts.*') || request()->routeIs('admin.social-networks.*') || request()->routeIs('admin.contact.*')) ? 'true' : 'false' }}" class="w-full flex items-center justify-between px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-lg font-medium transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined">business</span>
                        <span>Institucional</span>
                    </div>
                    <span data-menu-chevron class="material-symbols-outlined text-sm transition-transform {{ (request()->routeIs('admin.about.*') || request()->routeIs('admin.partners.*') || request()->routeIs('admin.legal-texts.*') || request()->routeIs('admin.social-networks.*') || request()->routeIs('admin.contact.*')) ? 'rotate-180' : '' }}">expand_more</span>
                </button>
                <div data-menu-panel="institutional" class="pl-12 space-y-1 mt-1 {{ (request()->routeIs('admin.about.*') || request()->routeIs('admin.partners.*') || request()->routeIs('admin.legal-texts.*') || request()->routeIs('admin.social-networks.*') || request()->routeIs('admin.contact.*')) ? '' : 'hidden' }}">
                    <a href="{{ route('admin.about.edit') }}" class="block py-2 text-sm {{ request()->routeIs('admin.about.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">About us</a>
                    <a href="{{ route('admin.partners.index') }}" class="block py-2 text-sm {{ request()->routeIs('admin.partners.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">Our team</a>
                    <a href="{{ route('admin.legal-texts.index') }}" class="block py-2 text-sm {{ request()->routeIs('admin.legal-texts.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">Termos e Privacidade</a>
                    <a href="{{ route('admin.social-networks.index') }}" class="block py-2 text-sm {{ request()->routeIs('admin.social-networks.*') ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary' }}">Redes Sociais</a>
                </div>
            </div>

            <!-- Users -->
            <a class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('admin.users.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }} rounded-lg font-medium transition-all duration-200" href="{{ route('admin.users.index') }}">
                <span class="material-symbols-outlined">person</span>
                <span>Usuários</span>
            </a>
        </nav>
        <div class="mt-auto pt-6 border-t border-slate-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-slate-600 hover:bg-red-50 hover:text-red-600 rounded-lg font-medium transition-all duration-200">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Canvas -->
    <main class="ml-72 pt-24 px-8 pb-12 min-h-screen flex flex-col">
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 text-emerald-700 rounded-lg border border-emerald-100">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

        <!-- Footer -->
        <footer class="w-full py-6 mt-auto flex justify-center items-center px-6 border-t border-slate-200/10">
            <span class="text-[10px] uppercase tracking-widest font-semibold text-slate-400">© 2026 Precise Monolith UI. System Operational.</span>
        </footer>
    </main>

    <script>
        const logoutModal = document.getElementById('logoutModal');
        const openLogoutModal = document.getElementById('openLogoutModal');
        const cancelLogout = document.getElementById('cancelLogout');

        function openModal() {
            if (!logoutModal) return;
            logoutModal.classList.remove('hidden');
        }

        function closeModal() {
            if (!logoutModal) return;
            logoutModal.classList.add('hidden');
        }

        openLogoutModal?.addEventListener('click', openModal);
        cancelLogout?.addEventListener('click', closeModal);
        logoutModal?.addEventListener('click', (e) => {
            if (e.target === logoutModal || e.target === logoutModal.firstElementChild) closeModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });
    </script>
    <script>
        document.querySelectorAll('[data-menu-toggle]').forEach((button) => {
            button.addEventListener('click', () => {
                const key = button.getAttribute('data-menu-toggle');
                if (!key) return;

                const panel = document.querySelector(`[data-menu-panel="${key}"]`);
                if (!panel) return;

                const isOpen = !panel.classList.contains('hidden');
                const nextOpen = !isOpen;

                panel.classList.toggle('hidden', !nextOpen);
                button.setAttribute('aria-expanded', nextOpen ? 'true' : 'false');

                const chevron = button.querySelector('[data-menu-chevron]');
                if (chevron) chevron.classList.toggle('rotate-180', nextOpen);
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
