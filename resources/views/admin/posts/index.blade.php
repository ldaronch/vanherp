@extends('layouts.admin')

@section('title', 'Notícias do Blog - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Notícias</h2>
            <p class="text-on-surface-variant font-medium">Gerencie as postagens do blog.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Nova Notícia
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-slate-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Imagem</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Data</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Título</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Categoria</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Status</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($posts as $post)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="w-16 h-10 object-cover rounded shadow-sm">
                            @else
                                <div class="w-16 h-10 bg-slate-100 rounded flex items-center justify-center text-slate-300">
                                    <span class="material-symbols-outlined text-sm">image</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-on-surface-variant font-semibold">
                            {{ optional($post->date)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-on-surface">
                            {{ Str::limit($post->title, 40) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold text-secondary uppercase">{{ optional($post->category)->name ?: 'Sem categoria' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold {{ $post->is_published ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $post->is_published ? 'Publicado' : 'Rascunho' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <form action="{{ route('admin.posts.toggle', $post) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center px-3 py-2 rounded-lg text-xs font-bold {{ $post->is_published ? 'text-amber-700 bg-amber-100 hover:bg-amber-200' : 'text-emerald-700 bg-emerald-100 hover:bg-emerald-200' }}">
                                    {{ $post->is_published ? 'Desativar' : 'Ativar' }}
                                </button>
                            </form>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex items-center p-2 text-primary hover:bg-primary/10 rounded-lg">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir notícia?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant italic">Nenhuma notícia cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($posts->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
