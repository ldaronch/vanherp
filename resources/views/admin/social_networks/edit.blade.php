@extends('layouts.admin')

@section('title', 'Editar Rede Social - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Editar Rede Social</h2>
            <p class="text-on-surface-variant font-medium">Atualize os dados da rede social: {{ $socialNetwork->name }}.</p>
        </div>
        <a href="{{ route('admin.social-networks.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-2xl mx-auto">
        <form action="{{ route('admin.social-networks.update', $socialNetwork) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-bold text-on-surface-variant mb-2">Nome da Rede Social</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('name', $socialNetwork->name) }}" required>
                @error('name') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="url" class="block text-sm font-bold text-on-surface-variant mb-2">URL do Perfil</label>
                <input type="url" name="url" id="url" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('url', $socialNetwork->url) }}" required>
                @error('url') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="icon" class="block text-sm font-bold text-on-surface-variant mb-2">Ícone (Material Symbol Name)</label>
                <input type="text" name="icon" id="icon" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('icon', $socialNetwork->icon) }}">
            </div>
            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" class="w-5 h-5 text-primary border-slate-300 rounded focus:ring-primary" {{ $socialNetwork->is_active ? 'checked' : '' }}>
                <label for="is_active" class="text-sm font-bold text-on-surface-variant">Ativo</label>
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:bg-blue-900 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection
