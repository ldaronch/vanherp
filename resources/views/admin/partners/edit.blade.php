@extends('layouts.admin')

@section('title', 'Editar Parceiro - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Editar Parceiro</h2>
            <p class="text-on-surface-variant font-medium">Atualize os dados do parceiro: {{ $partner->name }}.</p>
        </div>
        <a href="{{ route('admin.partners.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-4xl mx-auto">
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-bold text-on-surface-variant mb-2">Nome do Parceiro</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('name', $partner->name) }}" required>
                @error('name') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="logo" class="block text-sm font-bold text-on-surface-variant mb-2">Logotipo (Deixe em branco para manter o atual)</label>
                <input type="file" name="logo" id="logo" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                @error('logo') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                @if($partner->logo)
                    <div class="mt-2 text-xs font-bold text-slate-400">Logotipo Atual:</div>
                    <div class="mt-1 w-32 h-32 bg-white border border-slate-100 flex items-center justify-center rounded p-2">
                        <img src="{{ asset('storage/' . $partner->logo) }}" class="max-w-full max-h-full object-contain">
                    </div>
                @endif
            </div>
            <div>
                <label for="link" class="block text-sm font-bold text-on-surface-variant mb-2">Link do Parceiro (URL)</label>
                <input type="url" name="link" id="link" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('link', $partner->link) }}">
                @error('link') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection
