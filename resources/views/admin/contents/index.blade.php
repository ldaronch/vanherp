@extends('layouts.admin')

@section('title', 'Textos e Fotos - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Textos e Fotos</h2>
            <p class="text-on-surface-variant font-medium">Gerencie blocos de conteúdo com imagens para o site.</p>
        </div>
        <a href="{{ route('admin.contents.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Novo Conteúdo
        </a>
    </header>

    <div class="grid grid-cols-1 gap-6">
        @forelse($contents as $content)
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-slate-100 p-6 flex gap-6">
                @if($content->image)
                    <div class="w-48 h-32 flex-shrink-0 bg-slate-50 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $content->image) }}" alt="{{ $content->title }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span class="text-[10px] uppercase tracking-widest font-bold text-primary mb-1 block">{{ $content->section ?? 'Geral' }}</span>
                            <h3 class="text-xl font-bold text-on-surface">{{ $content->title }}</h3>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.contents.edit', $content) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.contents.destroy', $content) }}" method="POST" onsubmit="return confirm('Excluir este conteúdo?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <p class="text-on-surface-variant line-clamp-2">{{ Str::limit(strip_tags($content->text), 200) }}</p>
                </div>
            </div>
        @empty
            <div class="py-12 text-center text-on-surface-variant italic bg-surface-container-lowest rounded-xl border border-slate-100">Nenhum conteúdo cadastrado.</div>
        @endforelse
    </div>
@endsection
