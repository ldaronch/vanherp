@extends('layouts.admin')

@section('title', 'Banner dos Portos - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Banner dos Portos</h2>
            <p class="text-on-surface-variant font-medium">Gerencie os slides exibidos no banner secundário (abaixo do texto da home).</p>
        </div>
        <a href="{{ route('admin.contents.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Novo Slide
        </a>
    </header>

    <div class="grid grid-cols-1 gap-6">
        @forelse($contents as $content)
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-slate-100 p-6 flex gap-6">
                @if($content->image)
                    <div class="w-48 h-32 flex-shrink-0 bg-slate-50 rounded-lg overflow-hidden">
                        <img src="{{ url('media/' . $content->image) }}" alt="{{ $content->title }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="text-xl font-bold text-on-surface">{{ $content->title }}</h3>
                        </div>
                        <div class="flex gap-2">
                            <form action="{{ route('admin.contents.toggle', $content) }}" method="POST" class="inline-flex items-center">
                                @csrf
                                @method('PATCH')
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" class="sr-only peer" {{ $content->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                                    <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                                        <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                                    </div>
                                </label>
                            </form>
                            <a href="{{ route('admin.contents.edit', $content) }}" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.contents.destroy', $content) }}" method="POST" onsubmit="return confirm('Excluir este conteúdo?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <p class="text-on-surface-variant line-clamp-2">{{ Str::limit(strip_tags($content->text), 200) }}</p>
                </div>
            </div>
        @empty
            <div class="py-12 text-center text-on-surface-variant italic bg-surface-container-lowest rounded-xl border border-slate-100">Nenhum conteúdo cadastrado.</div>
        @endforelse
    </div>
@endsection
