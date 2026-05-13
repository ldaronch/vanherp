@extends('layouts.admin')

@section('title', 'Editar Seção (Página Circulars & Guidelines) - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Editar Seção</h2>
            <p class="text-on-surface-variant font-medium">Atualize o título e a observação.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.circular-guidelines.items.index', $section) }}" class="flex items-center gap-2 bg-slate-100 text-slate-700 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
                <span class="material-symbols-outlined">list</span>
                Itens
            </a>
            <a href="{{ route('admin.circular-guidelines.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
                <span class="material-symbols-outlined">arrow_back</span>
                Voltar
            </a>
        </div>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 w-full flex-1 flex flex-col">
        <form action="{{ route('admin.circular-guidelines.update', $section) }}" method="POST" class="flex flex-col gap-6 flex-1">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title', $section->title) }}" required>
                    @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-bold text-on-surface-variant mb-2">Ordem</label>
                    <input type="number" name="sort_order" id="sort_order" min="0" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('sort_order', $section->sort_order) }}">
                </div>
            </div>

            <div>
                <label for="note" class="block text-sm font-bold text-on-surface-variant mb-2">Texto de Observação (após a lista)</label>
                <textarea name="note" id="note" rows="6" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">{{ old('note', $section->note) }}</textarea>
                @error('note') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-center justify-between gap-6 bg-surface-container-low px-5 py-4 rounded-xl border border-slate-100">
                    <div>
                        <div class="text-sm font-bold text-on-surface">Ativo</div>
                        <div class="text-xs text-on-surface-variant">Exibir esta seção na página.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $section->is_active) ? 'checked' : '' }}>
                        <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                            <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                        </div>
                    </label>
                </div>

                <div class="flex items-center justify-between gap-6 bg-surface-container-low px-5 py-4 rounded-xl border border-slate-100">
                    <div>
                        <div class="text-sm font-bold text-on-surface">Exibir Observação</div>
                        <div class="text-xs text-on-surface-variant">Mostrar o texto de observação após a lista.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="show_note" value="1" class="sr-only peer" {{ old('show_note', $section->show_note) ? 'checked' : '' }}>
                        <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                            <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end mt-auto">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar
                </button>
            </div>
        </form>
    </div>
@endsection
