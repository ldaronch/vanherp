<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $settings->site_title ?? '' }}</title>
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
    </head>
    <body class="antialiased bg-slate-50 min-h-screen flex flex-col">
        <header id="siteHeader" class="sticky top-0 z-50 bg-white transition-all duration-200">
            <div class="max-w-6xl mx-auto px-6 h-24 flex items-center justify-between">
                <a href="{{ url('/') }}" class="font-black tracking-tight text-slate-900 text-lg">
                        <img alt="Logo" class="h-16 w-auto" src="{{ route('site.logo') }}"/>    
                </a>
                <nav class="hidden md:flex items-center gap-6">
                    <ul class="hidden md:flex items-center gap-6">
                        <li class="relative group">
                            <a href="#about-us" data-nav="about-us" class="nav-link font-thin text-slate-700 hover:text-slate-900 inline-flex items-center gap-1">
                                <span>About us</span>
                                <span class="material-symbols-outlined text-[18px]">expand_more</span>
                            </a>
                            <div class="absolute left-0 top-full pt-2 hidden group-hover:block">
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
                        <a href="#about-us" class="mobile-menu-link block px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-100 font-medium">About us</a>
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
                                {!! $settings->phone ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="flex-1">
            <div id="bannerMaster" class="relative flex items-center justify-center ">
                <div id="homeCarousel" class="relative inset-0">
                    <div class="relative w-full h-auto overflow-hidden">
                        @if(isset($banners) && $banners->count())
                            @foreach($banners as $index => $banner)
                                <a href="{{ $banner->link ?: '#' }}" target="{{ $banner->link ? '_blank' : '_self' }}" rel="noopener" class="carousel-slide relative inset-0 opacity-0 transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100' : '' }}" data-slide="{{ $index }}">
                                    <img src="{{ route('media', ['path' => $banner->image]) }}" alt="{{ $banner->title ?: 'Banner' }}" class="w-full h-auto object-cover">
                                    <div class="absolute inset-x-0 bottom-16 px-6">
                                        <div class="max-w-6xl mx-auto">
                                            @if($banner->title)
                                                <div class="text-white text-4xl md:text-5xl font-black tracking-tight">{{ $banner->title }}</div>
                                            @endif
                                            @if($banner->subtitle)
                                                <div class="mt-3 text-white/90 text-lg md:text-xl font-medium max-w-3xl">{{ $banner->subtitle }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="carousel-slide absolute inset-0 opacity-100" data-slide="0">
                                <div class="w-full h-full bg-[#29344D] flex items-center justify-center">
                                    <div class="max-w-6xl mx-auto px-6 text-center">
                                        <div class="text-white text-4xl md:text-5xl font-black tracking-tight">{{ $settings->site_title ?? '' }}</div>
                                        <div class="mt-3 text-white/90 text-lg md:text-xl font-medium">Cadastre banners no painel para exibir o carrossel.</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="absolute inset-x-0 bottom-6 flex items-center justify-center gap-2">
                        @php
                            $dotsCount = (isset($banners) && $banners->count()) ? $banners->count() : 1;
                        @endphp
                        @for($i = 0; $i < $dotsCount; $i++)
                            <button type="button" class="carousel-dot w-2.5 h-2.5 rounded-full bg-[#29344D]/60 {{ $i === 0 ? 'bg-[#C5A573]' : '' }}" data-dot="{{ $i }}" aria-label="Ir para banner {{ $i + 1 }}"></button>
                        @endfor
                    </div>
                </div>
            </div>

            <section class="py-16 bg-white border-t border-slate-100 scroll-mt-28" id="home-text">
                <div class="max-w-6xl mx-auto px-6  text-center">
                    @if(isset($homeText) && !empty($homeText->title))
                        <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-slate-900">{{ $homeText->title }}</h2>
                    @endif
                    @if(isset($homeText) && !empty($homeText->text))
                        <div class="mt-5 text-slate-700 text-lg leading-relaxed whitespace-pre-line text-center">{{ $homeText->text }}</div>
                    @endif
                    @if(isset($homeText) && !empty($homeText->url))
                        <div class="mt-8">
                            <a href="{{ $homeText->url }}" class="inline-flex items-center justify-center px-4 py-1 rounded-full border border-[#C5A573] text-[#29344D] font-semibold hover:bg-[#C5A573] hover:text-white transition-colors" target="_blank" rel="noopener">
                                Learn more
                            </a>
                        </div>
                    @endif
                </div>

                <div class="mt-12 w-full">
                    <div class="relative overflow-hidden">
                        <div class="relative w-full h-[200px] md:h-[660px]">
                            @forelse(($portsBanners ?? collect())->filter(fn($p) => !empty($p->image)) as $index => $banner)
                                <div class="port-slide absolute inset-0 opacity-0 transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100' : '' }}" data-port-slide="{{ $index }}">
                                    <img src="{{ route('media', ['path' => $banner->image]) }}" alt="{{ $banner->title }}" class="w-full h-auto object-cover">
                                </div>
                            @empty
                                <div class="port-slide absolute inset-0 opacity-100" data-port-slide="0">
                                    <div class="w-full h-full bg-slate-200 flex items-center">
                                        <div class="max-w-6xl mx-auto px-6 w-full">
                                            <div class="w-[90%] md:w-[80%] rounded-2xl bg-[#29344D]/50 backdrop-blur-md p-7 md:p-9 text-left text-white">
                                                <div class="text-sm md:text-base font-semibold tracking-widest uppercase text-white/90">Não há cadastros</div>
                                                <div class="mt-4 text-3xl md:text-4xl font-black tracking-tight">Cadastre slides no painel</div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse

                            <button type="button" id="portsBannerPrev" class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-none text-white/50 hover:text-white shadow-sm active:scale-95 transition" aria-label="Anterior">
                                <i class="fa-solid fa-chevron-left fa-3x "></i>
                            </button>
                            <button type="button" id="portsBannerNext" class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-none text-white/50 hover:text-white shadow-sm active:scale-95 transition" aria-label="Próximo">
                                <i class="fa-solid fa-chevron-right fa-3x "></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            </section>

            <section class="py-16 border-t border-slate-100 scroll-mt-28" id="news">
                <div class="w-[90%] mx-auto px-6">
                    <div class="flex items-end justify-center text-center">
                        <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-slate-900">News</h2>
                    </div>

                    <div class="relative mt-8">
                        <button type="button" id="newsPrev" class="absolute left-2 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/85 backdrop-blur-md border border-white/50 text-[#29344D] hover:bg-white shadow-sm active:scale-95 transition z-10" aria-label="Anterior">
                            <i class="fa-solid fa-chevron-left text-xl"></i>
                        </button>
                        <button type="button" id="newsNext" class="absolute right-2 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/85 backdrop-blur-md border border-white/50 text-[#29344D] hover:bg-white shadow-sm active:scale-95 transition z-10" aria-label="Próximo">
                            <i class="fa-solid fa-chevron-right text-xl"></i>
                        </button>

                        <div class="flex justify-center">
                            <div id="newsTrack" class="w-full max-w-8xl flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-4 px-16">
                                @forelse(($newsPosts ?? collect()) as $post)
                                    <article data-slide-item class="snap-start shrink-0 w-[85%] md:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                                    <a href="{{ route('circulars-guidelines.index') }}" class="block h-44 bg-slate-100" aria-label="Ler notícia: {{ $post->title }}">
                                        @if($post->image)
                                            <img src="{{ route('media', ['path' => $post->image]) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200"></div>
                                        @endif
                                    </a>
                                    <div class="p-6">

                                        <h3 class="mt-2 text-lg font-bold text-slate-900 leading-snug">
                                            <a href="{{ route('circulars-guidelines.index') }}" class="hover:text-[#C5A573] transition-colors">{{ $post->title }}</a>
                                        </h3>
                                        @if(!empty($post->content))
                                            <div class="mt-2 text-[14px] font-semibold  tracking-widest text-[#444444]">
                                                {!! $post->content !!}
                                            </div>
                                        @endif
                                        <div class="mt-4">
                                            <div class="flex justify-end">
                                                <a href="{{ route('circulars-guidelines.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#29344D] hover:text-[#C5A573] transition-colors">
                                                    <span>Read more</span>
                                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    </article>
                                @empty
                                    <div class="text-slate-500">Cadastre e publique notícias no painel para exibir este carrossel.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <footer class="mt-auto">
            <div class="bg-[#C5A573] text-lg text-white scroll-mt-28 py-12" id="contact">
                <div class="max-w-6xl mx-auto px-6 py-4 grid grid-cols-1 md:grid-cols-3 ">

                    <div class="items-start gap-3">
                        <div class="font-semibold w-full text-center md:text-left">Phone {{ $settings->phone ?? '' }}</div>
                        <div class="font-semibold w-full text-center md:text-left">Emergency  {!! $settings->emergency_phone ?? '' !!}</div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="font-semibold w-full text-center">WhatsApp {{ $settings->whatsapp ?? '' }}</div>
                    </div>


                    <div class="flex items-start gap-3 w-full">
                        <div class="font-semibold w-full text-center md:text-right">E-mail {{ $settings->email_display ?? '' }}</div>
                    </div>

                </div>
                <hr class="max-w-6xl mx-auto border-0 h-[2px] bg-white my-6">
                <div class="max-w-6xl mx-auto px-6 py-4 grid grid-cols-1 md:grid-cols-2 ">
                    <div class="text-center">
                        <div class="font-bold tracking-widest text-white/90">Office address:</div>
                        <div class="mt-1 text-white/90 leading-relaxed whitespace-pre-line">{{ $settings->address ?? '' }}</div>
                    </div>

                    <div class="text-center">
                        <div class="font-bold tracking-widest text-white/90">Mailing address:</div>
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

            const navLinks = Array.from(document.querySelectorAll('[data-nav]'));
            const sectionIds = ['about-us', 'ports', 'pi-clubs', 'circulars-guidelines', 'our-team', 'contact'];
            const sections = sectionIds
                .map((id) => document.getElementById(id))
                .filter(Boolean);

            function setActive(id) {
                navLinks.forEach((link) => {
                    const isActive = link.getAttribute('data-nav') === id;
                    link.classList.toggle('text-[#C5A573]', isActive);
                    link.classList.toggle('font-semibold', isActive);
                    link.classList.toggle('font-thin', !isActive);
                });
            }

            if (sections.length) {
                const observer = new IntersectionObserver((entries) => {
                    const visible = entries
                        .filter((e) => e.isIntersecting)
                        .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
                    if (visible?.target?.id) {
                        setActive(visible.target.id);
                    }
                }, { rootMargin: '-30% 0px -60% 0px', threshold: [0.1, 0.2, 0.35, 0.5] });

                sections.forEach((section) => observer.observe(section));
            }

            const slides = Array.from(document.querySelectorAll('.carousel-slide'));
            const dots = Array.from(document.querySelectorAll('.carousel-dot'));
            let currentIndex = 0;
            let intervalId = null;

            function renderCarousel(index) {
                currentIndex = index;
                slides.forEach((slide, i) => {
                    slide.classList.toggle('opacity-100', i === index);
                    slide.classList.toggle('opacity-0', i !== index);
                });
                dots.forEach((dot, i) => {
                    dot.classList.toggle('bg-[#C5A573]', i === index);
                    dot.classList.toggle('bg-[#29344D]/60', i !== index);
                });
            }

            function startCarousel() {
                if (slides.length <= 1) return;
                if (intervalId) clearInterval(intervalId);
                intervalId = setInterval(() => {
                    renderCarousel((currentIndex + 1) % slides.length);
                }, 6000);
            }

            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => {
                    renderCarousel(i);
                    startCarousel();
                });
            });

            renderCarousel(0);
            startCarousel();

            syncHeaderState();
            window.addEventListener('scroll', syncHeaderState, { passive: true });

            function setupArrowCarousel(trackId, prevId, nextId, options = {}) {
                const track = document.getElementById(trackId);
                const prev = document.getElementById(prevId);
                const next = document.getElementById(nextId);
                if (!track || !prev || !next) return;

                const firstItem = track.querySelector('[data-slide-item]');
                const getStep = () => {
                    if (!firstItem) return 320;
                    const styles = window.getComputedStyle(track);
                    const gap = parseFloat(styles.columnGap || styles.gap || '0') || 0;
                    return firstItem.getBoundingClientRect().width + gap;
                };
                const getMultiplier = typeof options.getMultiplier === 'function' ? options.getMultiplier : () => 1;

                prev.addEventListener('click', () => {
                    track.scrollBy({ left: -getStep() * getMultiplier(), behavior: 'smooth' });
                });

                next.addEventListener('click', () => {
                    track.scrollBy({ left: getStep() * getMultiplier(), behavior: 'smooth' });
                });
            }

            setupArrowCarousel('partnersTrack', 'partnersPrev', 'partnersNext');
            setupArrowCarousel('newsTrack', 'newsPrev', 'newsNext', {
                getMultiplier: () => (window.innerWidth >= 1024 ? 3 : window.innerWidth >= 768 ? 2 : 1),
            });

            const portSlides = Array.from(document.querySelectorAll('.port-slide'));
            const portsPrev = document.getElementById('portsBannerPrev');
            const portsNext = document.getElementById('portsBannerNext');
            let portIndex = 0;
            let portsIntervalId = null;

            function renderPortsBanner(index) {
                if (!portSlides.length) return;
                portIndex = index;
                portSlides.forEach((slide, i) => {
                    slide.classList.toggle('opacity-100', i === index);
                    slide.classList.toggle('opacity-0', i !== index);
                });
            }

            function startPortsBanner() {
                if (portSlides.length <= 1) return;
                if (portsIntervalId) clearInterval(portsIntervalId);
                portsIntervalId = setInterval(() => {
                    renderPortsBanner((portIndex + 1) % portSlides.length);
                }, 7000);
            }

            portsPrev?.addEventListener('click', () => {
                if (!portSlides.length) return;
                renderPortsBanner((portIndex - 1 + portSlides.length) % portSlides.length);
                startPortsBanner();
            });
            portsNext?.addEventListener('click', () => {
                if (!portSlides.length) return;
                renderPortsBanner((portIndex + 1) % portSlides.length);
                startPortsBanner();
            });

            renderPortsBanner(0);
            startPortsBanner();
        </script>
    </body>
</html>
