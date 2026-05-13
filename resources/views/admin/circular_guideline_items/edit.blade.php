@extends('layouts.admin')

@section('title', 'Editar Item (Circulars & Guidelines) - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Editar Item - {{ $section->title }}</h2>
            <p class="text-on-surface-variant font-medium">Atualize o item.</p>
        </div>
        <a href="{{ route('admin.circular-guidelines.items.index', $section) }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 w-full flex-1 flex flex-col">
        <form action="{{ route('admin.circular-guidelines.items.update', [$section, $item]) }}" method="POST" class="flex flex-col gap-6 flex-1">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-bold text-on-surface-variant mb-2">Título</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('name', $item->name) }}" required>
                @error('name') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label for="url" class="block text-sm font-bold text-on-surface-variant mb-2">URL (opcional)</label>
                    <input type="url" name="url" id="url" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('url', $item->url) }}" placeholder="https://">
                    @error('url') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-bold text-on-surface-variant mb-2">Ordem</label>
                    <input type="number" name="sort_order" id="sort_order" min="0" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('sort_order', $item->sort_order) }}">
                </div>
            </div>

            <div class="flex items-center justify-between gap-6 bg-surface-container-low px-5 py-4 rounded-xl border border-slate-100">
                <div>
                    <div class="text-sm font-bold text-on-surface">Ativo</div>
                    <div class="text-xs text-on-surface-variant">Exibir este item na página.</div>
                </div>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                    <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                        <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                    </div>
                </label>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end mt-auto">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar
                </button>
            </div>
        </form>
    </div>
@endsection
