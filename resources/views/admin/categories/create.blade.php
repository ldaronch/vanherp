@extends('layouts.admin')

@section('title', 'Nova Categoria - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Nova Categoria</h2>
            <p class="text-on-surface-variant font-medium">Cadastre uma nova categoria para o blog.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-2xl mx-auto">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-bold text-on-surface-variant mb-2">Nome da Categoria</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('name') }}" required placeholder="Ex: Notícias, Eventos">
                @error('name') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="slug" class="block text-sm font-bold text-on-surface-variant mb-2">Slug (Identificador na URL)</label>
                <input type="text" name="slug" id="slug" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('slug') }}" required placeholder="Ex: noticias-recentes">
                @error('slug') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Cadastrar Categoria
                </button>
            </div>
        </form>
    </div>
@endsection
