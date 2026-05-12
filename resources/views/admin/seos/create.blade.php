@extends('layouts.admin')

@section('title', 'Novo SEO - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Novo SEO</h2>
            <p class="text-on-surface-variant font-medium">Configure o SEO para uma nova página.</p>
        </div>
        <a href="{{ route('admin.seos.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-4xl mx-auto">
        <form action="{{ route('admin.seos.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="page_name" class="block text-sm font-bold text-on-surface-variant mb-2">Nome da Página (URL ou Identificador)</label>
                <input type="text" name="page_name" id="page_name" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('page_name') }}" required placeholder="Ex: home, sobre, contato">
                @error('page_name') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título da Página (Meta Title)</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title') }}" required placeholder="Título que aparece na aba do navegador">
                @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-bold text-on-surface-variant mb-2">Descrição (Meta Description)</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="Resumo da página para os motores de busca">{{ old('description') }}</textarea>
                @error('description') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="keywords" class="block text-sm font-bold text-on-surface-variant mb-2">Palavras-chave (Meta Keywords)</label>
                <textarea name="keywords" id="keywords" rows="2" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="Palavras separadas por vírgula">{{ old('keywords') }}</textarea>
                @error('keywords') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
                    Salvar SEO
                </button>
            </div>
        </form>
    </div>
@endsection
