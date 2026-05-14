@extends('layouts.admin')

@section('title', 'Editar Banner - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Editar Banner</h2>
            <p class="text-on-surface-variant font-medium">Atualize as configurações do banner.</p>
        </div>
        <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 w-full flex-1 flex flex-col">
        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6 flex-1">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-1">
                <div>
                    <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título do Banner</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title', $banner->title) }}">
                    @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="subtitle" class="block text-sm font-bold text-on-surface-variant mb-2">Subtítulo</label>
                    <input type="text" name="subtitle" id="subtitle" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('subtitle', $banner->subtitle) }}">
                    @error('subtitle') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="image" class="block text-sm font-bold text-on-surface-variant mb-2">Imagem do Banner (Deixe em branco para manter a atual)</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    @error('image') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    @if($banner->image)
                        <div class="mt-2 text-xs font-bold text-slate-400">Imagem Atual:</div>
                        <img src="{{ url('media/' . $banner->image) }}" class="mt-1 h-20 rounded shadow-sm">
                    @endif
                </div>
                <div>
                    <label for="link" class="block text-sm font-bold text-on-surface-variant mb-2">Link (URL)</label>
                    <input type="url" name="link" id="link" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('link', $banner->link) }}">
                    @error('link') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="order" class="block text-sm font-bold text-on-surface-variant mb-2">Ordem de Exibição</label>
                    <input type="number" name="order" id="order" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('order', $banner->order) }}">
                    @error('order') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="flex items-center gap-3 pt-6">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" class="w-5 h-5 text-primary border-slate-300 rounded focus:ring-primary" {{ $banner->is_active ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm font-bold text-on-surface-variant">Banner Ativo</label>
                </div>
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end mt-auto">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
                    Atualizar Banner
                </button>
            </div>
        </form>
    </div>
@endsection
