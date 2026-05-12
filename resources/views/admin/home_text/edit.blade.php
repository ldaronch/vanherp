@extends('layouts.admin')

@section('title', 'Texto da Home - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Texto da Home</h2>
            <p class="text-on-surface-variant font-medium">Gerencie o título e o texto exibidos logo abaixo do banner principal.</p>
        </div>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 w-full max-w-none">
        <form action="{{ route('admin.home-text.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title', $homeText->title) }}">
                </div>
                <div>
                    <label for="text" class="block text-sm font-bold text-on-surface-variant mb-2">Texto</label>
                    <textarea name="text" id="text" rows="8" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">{{ old('text', $homeText->text) }}</textarea>
                </div>
                <div>
                    <label for="url" class="block text-sm font-bold text-on-surface-variant mb-2">URL</label>
                    <input type="url" name="url" id="url" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('url', $homeText->url) }}">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar
                </button>
            </div>
        </form>
    </div>
@endsection
