@extends('layouts.admin')

@section('title', 'Nova Diretriz - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Nova Diretriz</h2>
            <p class="text-on-surface-variant font-medium">Faça o upload de uma nova diretriz ou norma.</p>
        </div>
        <a href="{{ route('admin.guidelines.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-4xl mx-auto">
        <form action="{{ route('admin.guidelines.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título da Diretriz</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title') }}" required placeholder="Ex: Manual de Conduta Operacional">
                @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="file_path" class="block text-sm font-bold text-on-surface-variant mb-2">Arquivo (PDF, DOC)</label>
                <input type="file" name="file_path" id="file_path" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required>
                @error('file_path') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-bold text-on-surface-variant mb-2">Descrição (Opcional)</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="Breve resumo da diretriz...">{{ old('description') }}</textarea>
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Cadastrar Diretriz
                </button>
            </div>
        </form>
    </div>
@endsection
