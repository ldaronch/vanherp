<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', ($settings->site_title ?? 'Vanherp'))</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any"/>
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}"/>
        <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96"/>
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}"/>
        <link rel="manifest" href="{{ asset('site.webmanifest') }}"/>
        <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700;800&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet"/>
        <style>
            body { font-family: 'Exo 2', sans-serif; }
        </style>
        @stack('styles')
    </head>
    <body class="antialiased bg-slate-50 min-h-screen flex flex-col">
        <header id="siteHeader" class="sticky top-0 z-50 bg-white transition-all duration-200">
            <div class="max-w-6xl mx-auto px-6 h-24 flex items-center justify-between">
                <a href="{{ url('/') }}" class="font-black tracking-tight text-slate-900 text-lg">
                    <img alt="Logo" class="h-16 w-auto" src="{{ route('site.logo') }}"/>
                </a>
                <nav class="hidden md:flex items-center gap-3">
                    <ul class="hidden md:flex items-center gap-3">
                        <li><a href="{{ url('/') }}" class="nav-link font-thin text-slate-700 hover:text-slate-900">Home</a></li>

                        <li class="relative group">
                            <a href="{{ url('/#about-us') }}" class="nav-link font-thin inline-flex items-center gap-1 px-3 py-2 rounded-xl text-slate-700 hover:bg-[#C5A573] hover:text-white group-hover:bg-[#C5A573] group-hover:text-white transition-colors">
                                <span>About us</span>
                                <span class="material-symbols-outlined text-[18px]">expand_more</span>
                            </a>
                            <div class="absolute left-0 top-[25px] pt-2 hidden group-hover:block">
                                <div class="min-w-44 rounded-xl bg-[#C5A573] shadow-lg overflow-hidden">
                                    <a href="{{ url('/our-history') }}" class="block px-4 py-3 text-white/90 font-thin hover:bg-black/10 hover:text-white">Our history</a>
                                    <a href="{{ url('/our-services') }}" class="block px-4 py-3 text-white/90 font-thin hover:bg-black/10 hover:text-white">Our services</a>
                                </div>
                            </div>
                        </li>
                        <li><a href="{{ route('ports.index') }}" class="nav-link font-thin text-slate-700 hover:text-slate-900">Ports</a></li>
                        <li><a href="{{ route('pi-clubs.index') }}" class="nav-link font-thin text-slate-700 hover:text-slate-900">P&amp;I Clubs</a></li>
                        <li><a href="{{ route('circulars-guidelines.index') }}" class="nav-link font-thin text-slate-700 hover:text-slate-900">Circulars &amp; Guidelines</a></li>
                        <li><a href="{{ route('our-team.index') }}" class="nav-link font-thin text-slate-700 hover:text-slate-900">Our team</a></li>
                        <li><a href="{{ route('contact.index') }}" class="nav-link font-thin text-slate-700 hover:text-slate-900">Contact</a></li>
                    </ul>
                    <div class="flex items-center gap-4 px-3">
                        @foreach($socialNetworks as $social)
                            <a href="{{ $social->url }}" class="text-slate-700 hover:text-slate-900" aria-label="{{ $social->name }}" target="_blank" rel="noopener">
                                <i class="{{ $social->icon ?: 'fa-solid fa-link' }} text-lg"></i>
                            </a>
                        @endforeach
                    </div>
                    <div id="phoneCalls">
                        <div class="labelEmergency"><i class="fa-solid fa-phone fa-flip-horizontal"></i> Emergency phones</div>
                        <div class="phoneShow">
                            {!! $settings->emergency_phone ?? '' !!}<br/>
                            {!! $settings->phone ?? '' !!}
                        </div>
                    </div>
                </nav>
                <button type="button" id="mobileMenuOpen" class="md:hidden inline-flex items-center justify-center w-11 h-11 rounded-full bg-slate-100 text-slate-700 hover:bg-slate-200 transition-colors" aria-label="Abrir menu">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </header>

        <div id="mobileMenu" class="fixed inset-0 z-[70] hidden md:hidden">
            <div id="mobileMenuBackdrop" class="absolute inset-0 bg-black/50"></div>
            <div id="mobileMenuPanel" class="absolute inset-y-0 left-0 w-[85%] max-w-sm bg-white shadow-2xl -translate-x-full transition-transform duration-300">
                <div class="h-24 px-6 flex items-center justify-between border-b border-slate-100">
                    <a href="{{ url('/') }}" class="font-black tracking-tight text-slate-900 text-lg">
                        <img alt="Logo" class="h-12 w-auto" src="{{ route('site.logo') }}"/>
                    </a>
                    <button type="button" id="mobileMenuClose" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-slate-100 text-slate-700 hover:bg-slate-200 transition-colors" aria-label="Fechar menu">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <div class="px-6 py-6">
                    <nav class="space-y-1">
                        <a href="{{ url('/#about-us') }}" class="mobile-menu-link block px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-100 font-medium">About us</a>
                        <a href="{{ url('/our-history') }}" class="mobile-menu-link block px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-100 font-medium">Our history</a>
                        <a href="{{ url('/our-services') }}" class="mobile-menu-link block px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-100 font-medium">Our services</a>
                        <a href="{{ route('ports.index') }}" class="mobile-menu-link block px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-100 font-medium">Ports</a>
                        <a href="{{ route('pi-clubs.index') }}" class="mobile-menu-link block px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-100 font-medium">P&amp;I Clubs</a>
                        <a href="{{ route('circulars-guidelines.index') }}" class="mobile-menu-link block px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-100 font-medium">Circulars &amp; Guidelines</a>
                        <a href="{{ route('our-team.index') }}" class="mobile-menu-link block px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-100 font-medium">Our team</a>
                        <a href="{{ route('contact.index') }}" class="mobile-menu-link block px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-100 font-medium">Contact</a>
                    </nav>

                    <div class="mt-6 border-t border-slate-100 pt-4">
                        <div class="flex items-center gap-4">
                            @foreach($socialNetworks as $social)
                                <a href="{{ $social->url }}" class="text-slate-700 hover:text-slate-900" aria-label="{{ $social->name }}" target="_blank" rel="noopener">
                                    <i class="{{ $social->icon ?: 'fa-solid fa-link' }} text-lg"></i>
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-4 text-sm text-slate-700">
                            <div class="font-semibold">Emergency phones</div>
                            <div class="mt-1">
                                {!! $settings->emergency_phone ?? '' !!}<br/>
                                {!! $settings->cellphone ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($pageBanner?->image))
            <div class="w-full h-[220px] md:h-[300px] bg-slate-200 overflow-hidden">
                <img src="{{ route('media', ['path' => $pageBanner->image]) }}" alt="Page banner" class="w-full h-full object-cover">
            </div>
        @endif

        <main class="flex-1">
            @yield('content')
        </main>

        <footer class="mt-auto">
            <div class="bg-[#C5A573] text-white scroll-mt-28 py-12" id="contact">
                <div class="max-w-6xl mx-auto px-6 py-4 grid grid-cols-1 md:grid-cols-3">
                    <div class="items-start gap-3">
                        <div class="font-semibold w-full text-center md:text-left">Phone: {{ $settings->phone ?? '' }}</div>
                        <div class="font-semibold w-full text-center md:text-left">Emergency: {!! $settings->emergency_phone ?? '' !!}</div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="font-semibold w-full text-center">WhatsApp: {{ $settings->whatsapp ?? '' }}</div>
                    </div>
                    <div class="flex items-start gap-3 w-full">
                        <div class="font-semibold w-full text-center md:text-right">E-mail: {{ $settings->email_display ?? '' }}</div>
                    </div>
                </div>
                <hr class="border-0 h-[2px] bg-white my-3">
                <div class="max-w-6xl mx-auto px-6 py-4 grid grid-cols-1 md:grid-cols-2">
                    <div class="text-center">
                        <div class="text-sm font-bold tracking-widest text-white/90">Endereço do Escritório</div>
                        <div class="mt-1 text-white/90 leading-relaxed whitespace-pre-line">{{ $settings->address ?? '' }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-sm font-bold tracking-widest text-white/90">Endereço de Correspondência</div>
                        <div class="mt-1 text-white/90 leading-relaxed whitespace-pre-line">{{ $settings->mailing_address ?? '' }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-[#29344D] text-white">
                <div class="max-w-6xl mx-auto px-6 py-5 text-center text-sm font-thin tracking-tight">
                    ©Copyright 2026 | Van Herp &amp; Frumento | Todos os Direitos Reservados
                </div>
            </div>
        </footer>

        <script>
            const siteHeader = document.getElementById('siteHeader');

            function syncHeaderState() {
                if (!siteHeader) return;
                const isFloating = window.scrollY > 8;
                siteHeader.classList.toggle('bg-white', !isFloating);
                siteHeader.classList.toggle('bg-white/80', isFloating);
                siteHeader.classList.toggle('backdrop-blur-md', isFloating);
                siteHeader.classList.toggle('shadow-sm', isFloating);
            }

            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuPanel = document.getElementById('mobileMenuPanel');
            const mobileMenuOpen = document.getElementById('mobileMenuOpen');
            const mobileMenuClose = document.getElementById('mobileMenuClose');
            const mobileMenuBackdrop = document.getElementById('mobileMenuBackdrop');
            const mobileMenuLinks = Array.from(document.querySelectorAll('.mobile-menu-link'));
            let mobileMenuCloseTimeoutId = null;

            function openMobileMenu() {
                if (!mobileMenu || !mobileMenuPanel) return;
                if (mobileMenuCloseTimeoutId) clearTimeout(mobileMenuCloseTimeoutId);
                mobileMenu.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                requestAnimationFrame(() => {
                    mobileMenuPanel.classList.remove('-translate-x-full');
                });
            }

            function closeMobileMenu() {
                if (!mobileMenu || !mobileMenuPanel) return;
                mobileMenuPanel.classList.add('-translate-x-full');
                document.body.style.overflow = '';
                mobileMenuCloseTimeoutId = setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            }

            mobileMenuOpen?.addEventListener('click', openMobileMenu);
            mobileMenuClose?.addEventListener('click', closeMobileMenu);
            mobileMenuBackdrop?.addEventListener('click', closeMobileMenu);
            mobileMenuLinks.forEach((link) => link.addEventListener('click', closeMobileMenu));
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeMobileMenu();
            });

            syncHeaderState();
            window.addEventListener('scroll', syncHeaderState, { passive: true });
        </script>
        @stack('scripts')
    </body>
</html>
