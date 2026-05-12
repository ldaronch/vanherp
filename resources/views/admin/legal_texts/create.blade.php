@extends('layouts.admin')

@section('title', 'Novo Texto Legal - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Novo Texto Legal</h2>
            <p class="text-on-surface-variant font-medium">Cadastre um novo termo de uso ou política de privacidade.</p>
        </div>
        <a href="{{ route('admin.legal-texts.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-5xl mx-auto">
        <form action="{{ route('admin.legal-texts.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título do Texto</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title') }}" required placeholder="Ex: Termos de Uso">
                    @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="slug" class="block text-sm font-bold text-on-surface-variant mb-2">Slug (Identificador na URL)</label>
                    <input type="text" name="slug" id="slug" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('slug') }}" required placeholder="Ex: termos-de-uso">
                    @error('slug') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label for="content" class="block text-sm font-bold text-on-surface-variant mb-2">Conteúdo Jurídico</label>
                <textarea name="content" id="content" rows="15" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required placeholder="Digite o conteúdo legal completo aqui...">{{ old('content') }}</textarea>
                @error('content') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Cadastrar Texto Legal
                </button>
            </div>
        </form>
    </div>
@endsection
