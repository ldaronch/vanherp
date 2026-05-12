@extends('layouts.admin')

@section('title', 'Editar Slide - Banner dos Portos')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Editar Slide</h2>
            <p class="text-on-surface-variant font-medium">Atualize os dados do slide: {{ $content->title }}.</p>
        </div>
        <a href="{{ route('admin.contents.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 w-full max-w-none">
        <form action="{{ route('admin.contents.update', $content) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title', $content->title) }}" required>
                    @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="subtitle" class="block text-sm font-bold text-on-surface-variant mb-2">Subtítulo</label>
                    <input type="text" name="subtitle" id="subtitle" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('subtitle', $content->subtitle) }}">
                    @error('subtitle') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="primary_text" class="block text-sm font-bold text-on-surface-variant mb-2">Texto (2 linhas)</label>
                    <textarea name="primary_text" id="primary_text" rows="2" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">{{ old('primary_text', $content->primary_text) }}</textarea>
                    @error('primary_text') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="text" class="block text-sm font-bold text-on-surface-variant mb-2">Texto Longo</label>
                    <textarea name="text" id="text" rows="8" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required>{{ old('text', $content->text) }}</textarea>
                    @error('text') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between gap-4 p-4 rounded-xl bg-surface-container-low border border-slate-100">
                    <div>
                        <div class="text-sm font-bold text-on-surface">Ativo</div>
                        <div class="text-xs text-on-surface-variant">Exibir este slide no site.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $content->is_active) ? 'checked' : '' }}>
                        <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                            <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                        </div>
                    </label>
                </div>

                <div>
                    <label for="image" class="block text-sm font-bold text-on-surface-variant mb-2">Imagem de Fundo (Deixe em branco para manter a atual)</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    @error('image') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    @if($content->image)
                        <div class="mt-2 text-xs font-bold text-slate-400">Imagem Atual:</div>
                        <img src="{{ asset('storage/' . $content->image) }}" class="mt-1 h-20 rounded shadow-sm">
                    @endif
                </div>
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection
