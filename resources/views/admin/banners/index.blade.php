@extends('layouts.admin')

@section('title', 'Banners Principais - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Banners Principais</h2>
            <p class="text-on-surface-variant font-medium">Gerencie os banners da página inicial.</p>
        </div>
        <a href="{{ route('admin.banners.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Novo Banner
        </a>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($banners as $banner)
            <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-slate-100 flex flex-col">
                <div class="aspect-video relative overflow-hidden bg-slate-100">
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $banner->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                            {{ $banner->is_active ? 'Ativo' : 'Inativo' }}
                        </span>
                    </div>
                </div>
                <div class="p-6 flex-1">
                    <h3 class="text-lg font-bold text-on-surface mb-1">{{ $banner->title ?? 'Sem título' }}</h3>
                    <p class="text-sm text-on-surface-variant mb-4 line-clamp-2">{{ $banner->subtitle ?? 'Sem subtítulo' }}</p>
                    <div class="flex justify-between items-center mt-auto pt-4 border-t border-slate-50">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Ordem: {{ $banner->order }}</span>
                        <div class="flex gap-2">
                            <form action="{{ route('admin.banners.toggle', $banner) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="p-2 {{ $banner->is_active ? 'text-amber-700 hover:bg-amber-50' : 'text-emerald-700 hover:bg-emerald-50' }} rounded-lg transition-colors" title="{{ $banner->is_active ? 'Inativar' : 'Ativar' }}">
                                    <span class="material-symbols-outlined text-sm">{{ $banner->is_active ? 'toggle_off' : 'toggle_on' }}</span>
                                </button>
                            </form>
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Excluir este banner?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-on-surface-variant italic">Nenhum banner cadastrado.</div>
        @endforelse
    </div>
@endsection
