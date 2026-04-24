@extends('layouts.admin')

@section('title', 'Sobre a Empresa - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Sobre a Empresa</h2>
            <p class="text-on-surface-variant font-medium">Gerencie as informações institucionais da sua empresa.</p>
        </div>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-4xl mx-auto">
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título da Seção</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title', $about->title) }}" required placeholder="Ex: Quem Somos">
                @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="content" class="block text-sm font-bold text-on-surface-variant mb-2">Conteúdo Institucional</label>
                <textarea name="content" id="content" rows="10" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required placeholder="Descreva a história e valores da sua empresa...">{{ old('content', $about->content) }}</textarea>
                @error('content') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="image" class="block text-sm font-bold text-on-surface-variant mb-2">Imagem Institucional (Foto da Sede ou Equipe)</label>
                <input type="file" name="image" id="image" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                @error('image') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                @if($about->image)
                    <div class="mt-2 text-xs font-bold text-slate-400">Imagem Atual:</div>
                    <img src="{{ asset('storage/' . $about->image) }}" class="mt-1 h-32 rounded shadow-sm">
                @endif
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:bg-blue-700 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar Informações
                </button>
            </div>
        </form>
    </div>
@endsection
