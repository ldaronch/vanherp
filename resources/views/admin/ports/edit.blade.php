@extends('layouts.admin')

@section('title', 'Editar Porto - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Editar Porto</h2>
            <p class="text-on-surface-variant font-medium">Atualize os dados do porto: {{ $port->name }}.</p>
        </div>
        <a href="{{ route('admin.ports.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-4xl mx-auto">
        <form action="{{ route('admin.ports.update', $port) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-bold text-on-surface-variant mb-2">Nome do Porto</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('name', $port->name) }}" required>
                    @error('name') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="location" class="block text-sm font-bold text-on-surface-variant mb-2">Localização (Cidade/Estado)</label>
                    <input type="text" name="location" id="location" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('location', $port->location) }}">
                </div>
            </div>
            <div>
                <label for="description" class="block text-sm font-bold text-on-surface-variant mb-2">Descrição / Informações</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">{{ old('description', $port->description) }}</textarea>
            </div>
            <div>
                <label for="image" class="block text-sm font-bold text-on-surface-variant mb-2">Imagem Ilustrativa (Deixe em branco para manter)</label>
                <input type="file" name="image" id="image" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                @error('image') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                @if($port->image)
                    <div class="mt-2 text-xs font-bold text-slate-400">Imagem Atual:</div>
                    <img src="{{ asset('storage/' . $port->image) }}" class="mt-1 h-20 rounded shadow-sm">
                @endif
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection
