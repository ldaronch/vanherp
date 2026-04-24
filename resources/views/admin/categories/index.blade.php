@extends('layouts.admin')

@section('title', 'Categorias do Blog - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Categorias</h2>
            <p class="text-on-surface-variant font-medium">Gerencie as categorias das notícias do blog.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-900 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Nova Categoria
        </a>
    </header>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-100">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-slate-100 max-w-4xl">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Nome</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Slug</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Notícias</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($categories as $category)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-on-surface">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $category->slug }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs font-bold">{{ $category->posts()->count() }}</span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="inline-flex items-center p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir categoria?')">
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
                        <td colspan="4" class="px-6 py-12 text-center text-on-surface-variant italic">Nenhuma categoria cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
