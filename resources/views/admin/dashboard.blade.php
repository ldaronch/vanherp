@extends('layouts.admin')

@section('title', 'Painel - Informações Portuárias')

@section('content')
    <header class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <h2 class="text-[2.25rem] md:text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Painel de Informações Portuárias</h2>
            <p class="text-on-surface-variant font-medium">Visão geral do conteúdo cadastrado e acesso rápido às principais áreas.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a class="inline-flex items-center gap-2 bg-primary text-white px-5 py-3 rounded-lg font-bold text-sm shadow-lg shadow-primary/10 hover:brightness-110 active:scale-[0.98] transition-all" href="{{ route('admin.ports.create') }}">
                <span class="material-symbols-outlined text-[20px]">directions_boat</span>
                <span>Novo porto</span>
            </a>
            <a class="inline-flex items-center gap-2 bg-primary/10 text-primary px-5 py-3 rounded-lg font-bold text-sm hover:bg-primary/15 active:scale-[0.98] transition-all" href="{{ route('admin.circulars.create') }}">
                <span class="material-symbols-outlined text-[20px]">description</span>
                <span>Nova circular</span>
            </a>
            <a class="inline-flex items-center gap-2 bg-primary/10 text-primary px-5 py-3 rounded-lg font-bold text-sm hover:bg-primary/15 active:scale-[0.98] transition-all" href="{{ route('admin.posts.create') }}">
                <span class="material-symbols-outlined text-[20px]">newspaper</span>
                <span>Nova notícia</span>
            </a>
        </div>
    </header>

    <div class="grid grid-cols-12 gap-6 mb-12">
        <a class="col-span-12 sm:col-span-6 lg:col-span-4 bg-surface-container-lowest p-7 rounded-xl shadow-sm hover:bg-surface-container-low transition-colors" href="{{ route('admin.ports.index') }}">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs uppercase tracking-widest font-bold text-on-surface-variant mb-2">Portos</div>
                    <div class="text-4xl font-extrabold text-on-surface tracking-tight">{{ number_format($stats['ports']) }}</div>
                    <div class="mt-2 text-xs text-on-surface-variant font-medium">Cadastro de portos e terminais</div>
                </div>
                <span class="material-symbols-outlined text-primary text-3xl">directions_boat</span>
            </div>
        </a>

        <a class="col-span-12 sm:col-span-6 lg:col-span-4 bg-surface-container-lowest p-7 rounded-xl shadow-sm hover:bg-surface-container-low transition-colors" href="{{ route('admin.circulars.index') }}">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs uppercase tracking-widest font-bold text-on-surface-variant mb-2">Circulares</div>
                    <div class="text-4xl font-extrabold text-on-surface tracking-tight">{{ number_format($stats['circulars']) }}</div>
                    <div class="mt-2 text-xs text-on-surface-variant font-medium">Documentos e comunicados</div>
                </div>
                <span class="material-symbols-outlined text-primary text-3xl">description</span>
            </div>
        </a>

        <a class="col-span-12 sm:col-span-6 lg:col-span-4 bg-surface-container-lowest p-7 rounded-xl shadow-sm hover:bg-surface-container-low transition-colors" href="{{ route('admin.guidelines.index') }}">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs uppercase tracking-widest font-bold text-on-surface-variant mb-2">Diretrizes</div>
                    <div class="text-4xl font-extrabold text-on-surface tracking-tight">{{ number_format($stats['guidelines']) }}</div>
                    <div class="mt-2 text-xs text-on-surface-variant font-medium">Normas e instruções operacionais</div>
                </div>
                <span class="material-symbols-outlined text-primary text-3xl">assignment</span>
            </div>
        </a>

        <div class="col-span-12 lg:col-span-8 bg-surface-container-lowest p-7 rounded-xl shadow-sm">
            <div class="flex items-start justify-between gap-6">
                <div>
                    <div class="text-xs uppercase tracking-widest font-bold text-on-surface-variant mb-2">Notícias</div>
                    <div class="text-4xl font-extrabold text-on-surface tracking-tight">{{ number_format($stats['posts_total']) }}</div>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-2 text-xs font-bold px-2.5 py-1 rounded bg-emerald-50 text-emerald-700">
                            <span class="material-symbols-outlined text-[16px]">task_alt</span>
                            <span>{{ number_format($stats['posts_published']) }} publicadas</span>
                        </span>
                        <span class="inline-flex items-center gap-2 text-xs font-bold px-2.5 py-1 rounded bg-amber-50 text-amber-800">
                            <span class="material-symbols-outlined text-[16px]">draft</span>
                            <span>{{ number_format($stats['posts_drafts']) }} rascunhos</span>
                        </span>
                    </div>
                </div>
                <div class="hidden md:flex flex-col items-end">
                    <a class="text-primary text-xs font-bold hover:underline" href="{{ route('admin.posts.index') }}">Gerenciar notícias</a>
                    <div class="mt-6 w-20 h-20 rounded-2xl bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-4xl">newspaper</span>
                    </div>
                </div>
            </div>
        </div>

        <a class="col-span-12 md:col-span-6 lg:col-span-4 bg-surface-container-lowest p-7 rounded-xl shadow-sm hover:bg-surface-container-low transition-colors" href="{{ route('admin.categories.index') }}">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs uppercase tracking-widest font-bold text-on-surface-variant mb-2">Categorias</div>
                    <div class="text-4xl font-extrabold text-on-surface tracking-tight">{{ number_format($stats['categories']) }}</div>
                    <div class="mt-2 text-xs text-on-surface-variant font-medium">Organização das notícias</div>
                </div>
                <span class="material-symbols-outlined text-primary text-3xl">category</span>
            </div>
        </a>

        <a class="col-span-12 md:col-span-6 lg:col-span-3 bg-surface-container-lowest p-7 rounded-xl shadow-sm hover:bg-surface-container-low transition-colors" href="{{ route('admin.banners.index') }}">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs uppercase tracking-widest font-bold text-on-surface-variant mb-2">Banners</div>
                    <div class="text-4xl font-extrabold text-on-surface tracking-tight">{{ number_format($stats['banners']) }}</div>
                    <div class="mt-2 text-xs text-on-surface-variant font-medium">Destaques do site</div>
                </div>
                <span class="material-symbols-outlined text-primary text-3xl">view_carousel</span>
            </div>
        </a>

        <a class="col-span-12 md:col-span-6 lg:col-span-3 bg-surface-container-lowest p-7 rounded-xl shadow-sm hover:bg-surface-container-low transition-colors" href="{{ route('admin.partners.index') }}">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs uppercase tracking-widest font-bold text-on-surface-variant mb-2">Parceiros</div>
                    <div class="text-4xl font-extrabold text-on-surface tracking-tight">{{ number_format($stats['partners']) }}</div>
                    <div class="mt-2 text-xs text-on-surface-variant font-medium">Instituições e apoiadores</div>
                </div>
                <span class="material-symbols-outlined text-primary text-3xl">handshake</span>
            </div>
        </a>

        <a class="col-span-12 md:col-span-6 lg:col-span-3 bg-surface-container-lowest p-7 rounded-xl shadow-sm hover:bg-surface-container-low transition-colors" href="{{ route('admin.clients.index') }}">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs uppercase tracking-widest font-bold text-on-surface-variant mb-2">Clientes</div>
                    <div class="text-4xl font-extrabold text-on-surface tracking-tight">{{ number_format($stats['clients']) }}</div>
                    <div class="mt-2 text-xs text-on-surface-variant font-medium">Empresas e usuários do portal</div>
                </div>
                <span class="material-symbols-outlined text-primary text-3xl">group</span>
            </div>
        </a>

        <a class="col-span-12 md:col-span-6 lg:col-span-3 bg-surface-container-lowest p-7 rounded-xl shadow-sm hover:bg-surface-container-low transition-colors" href="{{ route('admin.users.index') }}">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs uppercase tracking-widest font-bold text-on-surface-variant mb-2">Usuários</div>
                    <div class="text-4xl font-extrabold text-on-surface tracking-tight">{{ number_format($stats['users']) }}</div>
                    <div class="mt-2 text-xs text-on-surface-variant font-medium">Acesso ao painel administrativo</div>
                </div>
                <span class="material-symbols-outlined text-primary text-3xl">person</span>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-4">
        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-on-surface">Últimas circulares</h3>
                <a class="text-primary text-xs font-bold hover:underline" href="{{ route('admin.circulars.index') }}">Ver todas</a>
            </div>
            <div class="space-y-4">
                @forelse($recentCirculars as $circular)
                    <a class="flex items-start gap-4 p-3 rounded-lg hover:bg-surface-container-low transition-colors" href="{{ route('admin.circulars.edit', $circular) }}">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary">description</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-on-surface truncate">{{ $circular->title }}</p>
                            <p class="text-xs text-on-surface-variant font-medium">
                                {{ $circular->date ? \Illuminate\Support\Carbon::parse($circular->date)->format('d/m/Y') : 'Sem data' }}
                                · {{ optional($circular->created_at)->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="text-sm text-on-surface-variant font-medium">Nenhuma circular cadastrada ainda.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-on-surface">Portos recentes</h3>
                <a class="text-primary text-xs font-bold hover:underline" href="{{ route('admin.ports.index') }}">Ver todos</a>
            </div>
            <div class="space-y-4">
                @forelse($recentPorts as $port)
                    <a class="flex items-start gap-4 p-3 rounded-lg hover:bg-surface-container-low transition-colors" href="{{ route('admin.ports.edit', $port) }}">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary">directions_boat</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-on-surface truncate">{{ $port->name }}</p>
                            <p class="text-xs text-on-surface-variant font-medium">
                                {{ $port->location ?: 'Localização não informada' }}
                                · {{ optional($port->created_at)->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="text-sm text-on-surface-variant font-medium">Nenhum porto cadastrado ainda.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-on-surface">Notícias recentes</h3>
                <a class="text-primary text-xs font-bold hover:underline" href="{{ route('admin.posts.index') }}">Ver todas</a>
            </div>
            <div class="space-y-4">
                @forelse($recentPosts as $post)
                    <a class="flex items-start gap-4 p-3 rounded-lg hover:bg-surface-container-low transition-colors" href="{{ route('admin.posts.edit', $post) }}">
                        <div class="w-10 h-10 rounded-lg {{ $post->is_published ? 'bg-emerald-50' : 'bg-amber-50' }} flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined {{ $post->is_published ? 'text-emerald-700' : 'text-amber-800' }}">{{ $post->is_published ? 'task_alt' : 'draft' }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-on-surface truncate">{{ $post->title }}</p>
                            <p class="text-xs text-on-surface-variant font-medium">
                                {{ $post->is_published ? 'Publicada' : 'Rascunho' }}
                                · {{ optional($post->created_at)->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="text-sm text-on-surface-variant font-medium">Nenhuma notícia cadastrada ainda.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="fixed bottom-8 right-8 z-[100]">
        <a class="w-14 h-14 rounded-full bg-primary text-white flex items-center justify-center shadow-xl hover:scale-105 active:scale-95 transition-transform duration-150" href="{{ route('admin.circulars.create') }}">
            <span class="material-symbols-outlined">add</span>
        </a>
    </div>
@endsection
