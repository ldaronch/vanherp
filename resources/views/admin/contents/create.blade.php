@extends('layouts.admin')

@section('title', 'Novo Conteúdo - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Novo Conteúdo</h2>
            <p class="text-on-surface-variant font-medium">Cadastre um novo bloco de texto com foto.</p>
        </div>
        <a href="{{ route('admin.contents.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-4xl mx-auto">
        <form action="{{ route('admin.contents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título do Bloco</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title') }}" required placeholder="Ex: Nossos Serviços">
                    @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="subtitle" class="block text-sm font-bold text-on-surface-variant mb-2">Subtítulo (Opcional)</label>
                    <input type="text" name="subtitle" id="subtitle" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('subtitle') }}" placeholder="Ex: Confira o que oferecemos">
                    @error('subtitle') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="section" class="block text-sm font-bold text-on-surface-variant mb-2">Seção do Site (Identificador)</label>
                    <input type="text" name="section" id="section" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('section') }}" placeholder="Ex: servicos, equipe, destaque">
                    @error('section') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="image" class="block text-sm font-bold text-on-surface-variant mb-2">Imagem / Foto</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    @error('image') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label for="text" class="block text-sm font-bold text-on-surface-variant mb-2">Texto do Conteúdo</label>
                <textarea name="text" id="text" rows="8" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required placeholder="Digite o conteúdo aqui...">{{ old('text') }}</textarea>
                @error('text') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Cadastrar Conteúdo
                </button>
            </div>
        </form>
    </div>
@endsection
