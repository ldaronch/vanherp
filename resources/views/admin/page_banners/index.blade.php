@extends('layouts.admin')

@section('title', 'Banners das Páginas - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Banners das Páginas</h2>
            <p class="text-on-surface-variant font-medium">Gerencie os banners do topo das subpáginas.</p>
        </div>
        <a href="{{ route('admin.page-banners.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Novo Banner
        </a>
    </header>

    <div class="grid grid-cols-1 gap-6">
        @forelse($banners as $banner)
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-slate-100 overflow-hidden flex flex-col md:flex-row">
                <div class="w-full md:w-72 h-40 bg-slate-100 overflow-hidden">
                    <img src="{{ asset('storage/'.$banner->image) }}" alt="Banner" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-1 flex flex-col md:flex-row md:items-center gap-6">
                    <div class="flex-1">
                        <div class="text-lg font-bold text-on-surface">{{ $pages[$banner->page] ?? $banner->page }}</div>
                        <div class="mt-1 text-xs font-semibold text-on-surface-variant">Route: {{ $banner->page }}</div>
                    </div>
                    <div class="flex items-center gap-3">
                        <form action="{{ route('admin.page-banners.toggle', $banner) }}" method="POST" class="inline-flex items-center">
                            @csrf
                            @method('PATCH')
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" {{ $banner->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                                <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                                    <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                                </div>
                            </label>
                        </form>
                        <a href="{{ route('admin.page-banners.edit', $banner) }}" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-sm">edit</span>
                        </a>
                        <form action="{{ route('admin.page-banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Excluir banner?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-12 text-center text-on-surface-variant italic">Nenhum banner cadastrado.</div>
        @endforelse
    </div>
@endsection

