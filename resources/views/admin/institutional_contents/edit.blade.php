@extends('layouts.admin')

@section('title', 'Editar - '.$sectionLabel.' - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Editar - {{ $sectionLabel }}</h2>
            <p class="text-on-surface-variant font-medium">Atualize o conteúdo cadastrado.</p>
        </div>
        <a href="{{ route('admin.institutional-contents.index', $section) }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 w-full max-w-none">
        <form action="{{ route('admin.institutional-contents.update', [$section, $content]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title', $content->title) }}" required>
                    @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-bold text-on-surface-variant mb-2">Ordem</label>
                    <input type="number" name="sort_order" id="sort_order" min="0" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('sort_order', $content->sort_order ?? 0) }}">
                    @error('sort_order') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="text" class="block text-sm font-bold text-on-surface-variant mb-2">Texto</label>
                <textarea name="text" id="text" rows="8" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required>{{ old('text', $content->text) }}</textarea>
                @error('text') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            @if($section === 'our_services')
                <div>
                    <label for="items" class="block text-sm font-bold text-on-surface-variant mb-2">Lista de Itens (um por linha)</label>
                    <textarea name="items" id="items" rows="6" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">{{ old('items', $content->items) }}</textarea>
                    @error('items') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
            @endif

            <div>
                <label for="image" class="block text-sm font-bold text-on-surface-variant mb-2">Imagem</label>
                <input type="file" name="image" id="image" accept="image/*" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                @error('image') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                @if(!empty($content->image))
                    <div class="mt-4">
                        <img src="{{ asset('storage/'.$content->image) }}" alt="{{ $content->title }}" class="w-full max-w-lg rounded-xl border border-slate-100">
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-between gap-6 bg-surface-container-low px-5 py-4 rounded-xl border border-slate-100">
                <div>
                    <div class="text-sm font-bold text-on-surface">Ativo</div>
                    <div class="text-xs text-on-surface-variant">Exibir este conteúdo na página.</div>
                </div>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $content->is_active) ? 'checked' : '' }}>
                    <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                        <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                    </div>
                </label>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar
                </button>
            </div>
        </form>
    </div>
@endsection

