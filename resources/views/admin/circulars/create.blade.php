@extends('layouts.admin')

@section('title', 'Nova Circular - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Nova Circular</h2>
            <p class="text-on-surface-variant font-medium">Faça o upload de uma nova circular ou documento.</p>
        </div>
        <a href="{{ route('admin.circulars.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-4xl mx-auto">
        <form action="{{ route('admin.circulars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título da Circular</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title') }}" required placeholder="Ex: Circular 001/2024 - Normas de Segurança">
                    @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="date" class="block text-sm font-bold text-on-surface-variant mb-2">Data do Documento</label>
                    <input type="date" name="date" id="date" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('date') }}">
                </div>
                <div>
                    <label for="attachments" class="block text-sm font-bold text-on-surface-variant mb-2">Anexar Arquivos para Download</label>
                    <input type="file" name="attachments[]" id="attachments" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" multiple>
                    <p class="mt-1 text-[10px] text-slate-400 font-medium">Você pode selecionar vários arquivos (PDF, DOC, XLS, Imagens).</p>
                    @error('attachments.*') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label for="description" class="block text-sm font-bold text-on-surface-variant mb-2">Breve Descrição (Opcional)</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="Resumo do conteúdo do documento...">{{ old('description') }}</textarea>
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:bg-blue-900 transition-colors shadow-lg active:scale-95 duration-150">
                    Cadastrar Circular
                </button>
            </div>
        </form>
    </div>
@endsection
