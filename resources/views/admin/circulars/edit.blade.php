@extends('layouts.admin')

@section('title', 'Editar Circular - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Editar Circular</h2>
            <p class="text-on-surface-variant font-medium">Atualize os dados da circular: {{ $circular->title }}.</p>
        </div>
        <a href="{{ route('admin.circulars.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-4xl mx-auto">
        <form action="{{ route('admin.circulars.update', $circular) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título 2 (Seção)</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title', $circular->title) }}" required>
                    @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="date" class="block text-sm font-bold text-on-surface-variant mb-2">Data do Documento</label>
                    <input type="date" name="date" id="date" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('date', $circular->date) }}">
                </div>
                <div>
                    <label for="url" class="block text-sm font-bold text-on-surface-variant mb-2">Link (Opcional)</label>
                    <input type="url" name="url" id="url" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('url', $circular->url) }}" placeholder="https://...">
                    <p class="mt-1 text-[10px] text-slate-400 font-medium">Se informar um link, os anexos serão removidos.</p>
                    @error('url') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="attachments" class="block text-sm font-bold text-on-surface-variant mb-2">Adicionar Novos PDFs</label>
                    <input type="file" name="attachments[]" id="attachments" accept=".pdf,application/pdf" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" multiple>
                    <p class="mt-1 text-[10px] text-slate-400 font-medium">Selecione novos arquivos PDF para adicionar à lista atual.</p>
                    @error('attachments.*') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            @if($circular->attachments->count() > 0)
                <div class="pt-4 border-t border-slate-50">
                    <p class="text-xs font-bold text-slate-400 mb-4 uppercase tracking-widest">Arquivos Anexados</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($circular->attachments as $attachment)
                            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-100">
                                <div class="flex items-center gap-2 overflow-hidden">
                                    <span class="text-secondary text-sm">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </span>
                                    <span class="text-xs font-medium text-on-surface truncate">{{ $attachment->original_name }}</span>
                                </div>
                                <button type="button" onclick="if(confirm('Remover este anexo?')) document.getElementById('delete-attachment-{{ $attachment->id }}').submit()" class="text-red-500 hover:text-red-700 p-1">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </button>
                                <form id="delete-attachment-{{ $attachment->id }}" action="{{ route('admin.circulars.attachments.destroy', $attachment) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div>
                <label for="description" class="block text-sm font-bold text-on-surface-variant mb-2">Texto Descritivo (Opcional)</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">{{ old('description', $circular->description) }}</textarea>
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection
