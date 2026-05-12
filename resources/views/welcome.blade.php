<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $contact->site_title ?? '' }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any"/>
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}"/>
        <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96"/>
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}"/>
        <link rel="manifest" href="{{ asset('site.webmanifest') }}"/>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet"/>
    </head>
    <body class="antialiased bg-slate-50 min-h-screen flex flex-col">
        <header class="bg-white/80 backdrop-blurr">
            <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
                <a href="{{ url('/') }}" class="font-black tracking-tight text-slate-900 text-lg">
                        <img alt="Logo" class="h-24 w-auto mb-2" src="{{ route('site.logo') }}"/>    
                </a>
                <nav class="flex items-center gap-6">
                    <ul class="hidden md:flex items-center gap-6">
                        <li><a href="#about-us" class="font-semibold text-slate-700 hover:text-slate-900">About us</a></li>
                        <li><a href="#ports" class="font-semibold text-slate-700 hover:text-slate-900">Ports</a></li>
                        <li><a href="#pi-clubs" class="font-semibold text-slate-700 hover:text-slate-900">P&amp;I Clubs</a></li>
                        <li><a href="#circulars-guidelines" class="font-semibold text-slate-700 hover:text-slate-900">Circulars &amp; Guidelines</a></li>
                        <li><a href="#our-team" class="font-semibold text-slate-700 hover:text-slate-900">Our team</a></li>
                        <li><a href="#contact" class="font-semibold text-slate-700 hover:text-slate-900">Contact</a></li>
                    </ul>
                    <div class="flex items-center gap-4">
                        @foreach($socialNetworks as $social)
                            <a href="{{ $social->url }}" class="text-slate-700 hover:text-slate-900" aria-label="{{ $social->name }}" target="_blank" rel="noopener">
                                <i class="{{ $social->icon ?: 'fa-solid fa-link' }} text-lg"></i>
                            </a>
                        @endforeach
                    </div>
                    <div id="phoneCalls">
                        <div class="labelEmergency">Emergency phones</div>
                        <div class="phoneShow">{{ $contact->emergency_phone ?? '' }}</div>
                        <div class="phoneShow">{{ $contact->phone ?? '' }}</div>
                    </div>
                </nav>
            </div>
        </header>

        <main class="flex-1">
            <div class="relative flex items-center justify-center min-h-[calc(100vh-8rem)]">
                <div class="max-w-6xl mx-auto px-6 text-center">
                    <h1 class="text-6xl font-black text-blue-600 mb-4 tracking-tighter">{{ $contact->site_title ?? 'Vanherp' }}</h1>
                    <p class="text-xl text-slate-500 mb-12 font-medium">Sistema de Informações Portuárias.</p>
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

            <section class="py-16 bg-white border-t border-slate-100" id="about-us">
                <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <h2 class="text-3xl font-black tracking-tight text-slate-900">{{ $about->title ?? 'About us' }}</h2>
                        <div class="mt-4 text-slate-600 leading-relaxed whitespace-pre-line">{{ $about->content ?? 'Conteúdo não cadastrado ainda.' }}</div>
                    </div>
                    <div class="rounded-2xl overflow-hidden bg-slate-100">
                        @if(!empty($about?->image))
                            <img src="{{ asset('storage/'.$about->image) }}" alt="{{ $about->title }}" class="w-full h-80 object-cover">
                        @else
                            <div class="w-full h-80 flex items-center justify-center text-slate-400 font-semibold">Imagem não cadastrada</div>
                        @endif
                    </div>
                </div>
            </section>

            <section class="py-16 bg-slate-50 border-t border-slate-100" id="ports">
                <div class="max-w-6xl mx-auto px-6">
                    <div class="flex items-end justify-between gap-6 mb-8">
                        <div>
                            <h2 class="text-3xl font-black tracking-tight text-slate-900">Ports</h2>
                            <p class="text-slate-600 mt-2">Portos e terminais cadastrados.</p>
                        </div>
                        <div class="text-sm font-semibold text-slate-600">{{ $ports->count() }} itens</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($ports as $port)
                            <div class="bg-white rounded-2xl p-6 border border-slate-100">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="min-w-0">
                                        <div class="text-lg font-black text-slate-900 truncate">{{ $port->name }}</div>
                                        <div class="text-sm text-slate-600 mt-1 truncate">{{ $port->location ?: 'Localização não informada' }}</div>
                                    </div>
                                    <span class="material-symbols-outlined text-slate-400">directions_boat</span>
                                </div>
                                @if($port->description)
                                    <p class="text-sm text-slate-600 mt-4">{{ $port->description }}</p>
                                @endif
                            </div>
                        @empty
                            <div class="text-slate-600 font-semibold">Nenhum porto cadastrado.</div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="py-16 bg-white border-t border-slate-100" id="pi-clubs">
                <div class="max-w-6xl mx-auto px-6">
                    <div class="flex items-end justify-between gap-6 mb-8">
                        <div>
                            <h2 class="text-3xl font-black tracking-tight text-slate-900">P&amp;I Clubs</h2>
                            <p class="text-slate-600 mt-2">Lista de entidades cadastradas.</p>
                        </div>
                        <div class="text-sm font-semibold text-slate-600">{{ $piClubs->count() }} itens</div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($piClubs as $club)
                            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                                <div class="text-sm font-black text-slate-900">{{ $club->company ?: $club->name }}</div>
                                <div class="mt-2 text-sm text-slate-600">
                                    <span class="font-semibold">Contato:</span> {{ $club->name }}
                                </div>
                                <div class="mt-2 text-sm text-slate-600">
                                    {{ $club->email ?: 'E-mail não informado' }}
                                    @if($club->phone)
                                        · {{ $club->phone }}
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-slate-600 font-semibold">Nenhum item cadastrado.</div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="py-16 bg-slate-50 border-t border-slate-100" id="circulars-guidelines">
                <div class="max-w-6xl mx-auto px-6">
                    <h2 class="text-3xl font-black tracking-tight text-slate-900">Circulars &amp; Guidelines</h2>
                    <p class="text-slate-600 mt-2">Últimos documentos publicados.</p>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                        <div class="bg-white rounded-2xl p-6 border border-slate-100">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-black text-slate-900">Circulars</h3>
                                <span class="text-xs font-bold text-slate-500">{{ $circulars->count() }} recentes</span>
                            </div>
                            <div class="mt-4 space-y-3">
                                @forelse($circulars as $circular)
                                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                                        <div class="flex items-start justify-between gap-4">
                                            <div class="min-w-0">
                                                <div class="font-bold text-slate-900 truncate">{{ $circular->title }}</div>
                                                <div class="text-xs text-slate-600 mt-1">
                                                    {{ $circular->date ? \Illuminate\Support\Carbon::parse($circular->date)->format('d/m/Y') : 'Sem data' }}
                                                </div>
                                            </div>
                                        </div>
                                        @if($circular->description)
                                            <div class="text-sm text-slate-600 mt-2">{{ $circular->description }}</div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-slate-600 font-semibold">Nenhuma circular cadastrada.</div>
                                @endforelse
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 border border-slate-100">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-black text-slate-900">Guidelines</h3>
                                <span class="text-xs font-bold text-slate-500">{{ $guidelines->count() }} recentes</span>
                            </div>
                            <div class="mt-4 space-y-3">
                                @forelse($guidelines as $guideline)
                                    <a class="block p-4 rounded-xl bg-slate-50 border border-slate-100 hover:bg-slate-100 transition-colors" href="{{ $guideline->file_path ? asset('storage/'.$guideline->file_path) : '#' }}" target="{{ $guideline->file_path ? '_blank' : '_self' }}" rel="noopener">
                                        <div class="flex items-start justify-between gap-4">
                                            <div class="min-w-0">
                                                <div class="font-bold text-slate-900 truncate">{{ $guideline->title }}</div>
                                                @if($guideline->description)
                                                    <div class="text-sm text-slate-600 mt-2">{{ $guideline->description }}</div>
                                                @endif
                                                <div class="text-xs text-slate-600 mt-2">{{ optional($guideline->created_at)->diffForHumans() }}</div>
                                            </div>
                                            <span class="material-symbols-outlined text-slate-400">download</span>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-slate-600 font-semibold">Nenhuma diretriz cadastrada.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-16 bg-white border-t border-slate-100" id="our-team">
                <div class="max-w-6xl mx-auto px-6">
                    <div class="flex items-end justify-between gap-6 mb-8">
                        <div>
                            <h2 class="text-3xl font-black tracking-tight text-slate-900">Our team</h2>
                            <p class="text-slate-600 mt-2">Cadastros exibidos a partir de Parceiros.</p>
                        </div>
                        <div class="text-sm font-semibold text-slate-600">{{ $team->count() }} itens</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse($team as $member)
                            <a class="bg-slate-50 rounded-2xl p-6 border border-slate-100 hover:bg-slate-100 transition-colors" href="{{ $member->link ?: '#' }}" target="{{ $member->link ? '_blank' : '_self' }}" rel="noopener">
                                <div class="w-full h-20 flex items-center justify-center bg-white rounded-xl border border-slate-100">
                                    @if($member->logo)
                                        <img src="{{ asset('storage/'.$member->logo) }}" alt="{{ $member->name }}" class="max-h-14 max-w-full object-contain">
                                    @else
                                        <span class="text-slate-400 font-semibold text-sm">Sem logo</span>
                                    @endif
                                </div>
                                <div class="mt-4 font-black text-slate-900">{{ $member->name }}</div>
                            </a>
                        @empty
                            <div class="text-slate-600 font-semibold">Nenhum item cadastrado.</div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="py-16 bg-slate-50 border-t border-slate-100" id="contact">
                <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div>
                        <h2 class="text-3xl font-black tracking-tight text-slate-900">Contact</h2>
                        <p class="text-slate-600 mt-2">Informações configuradas em Configurações do Site.</p>

                        <div class="mt-6 space-y-3 text-slate-700">
                            <div><span class="font-black">E-mail:</span> {{ $contact->email_display ?: '-' }}</div>
                            <div>
                                <span class="font-black">Telefones:</span>
                                <span>{{ $contact->phone ?: '-' }}</span>
                                @if($contact->cellphone) · <span>{{ $contact->cellphone }}</span>@endif
                                @if($contact->whatsapp) · <span>{{ $contact->whatsapp }}</span>@endif
                            </div>
                            <div><span class="font-black">Emergência:</span> {{ $contact->emergency_phone ?: '-' }}</div>
                            <div>
                                <span class="font-black">Office:</span>
                                {{ $contact->address ?: '-' }}
                                @if($contact->city || $contact->state || $contact->zip_code)
                                    — {{ trim(($contact->city ? $contact->city.', ' : '').($contact->state ?: '').($contact->zip_code ? ' · '.$contact->zip_code : '')) }}
                                @endif
                            </div>
                            <div><span class="font-black">Mailing:</span> {{ $contact->mailing_address ?: '-' }}</div>
                            <div><span class="font-black">Working hours:</span> {{ $contact->working_hours ?: '-' }}</div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
                        @if($contact->maps_iframe)
                            {!! $contact->maps_iframe !!}
                        @else
                            <div class="w-full h-80 flex items-center justify-center text-slate-400 font-semibold">Mapa não configurado</div>
                        @endif
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-center text-sm text-slate-500 font-semibold">
                {{ $contact->copyright_text ?? ('© '.date('Y').' Vanherp') }}
            </div>
        </footer>
    </body>
</html>
