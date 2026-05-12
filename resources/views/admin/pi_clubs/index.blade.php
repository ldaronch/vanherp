@extends('layouts.admin')

@section('title', 'P&I Clubs - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">P&amp;I Clubs</h2>
            <p class="text-on-surface-variant font-medium">Gerencie seções e links.</p>
        </div>
        <a href="{{ route('admin.pi-clubs.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Nova Seção
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-slate-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Seção</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Itens</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Ordem</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Ativo</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($sections as $section)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-on-surface">{{ $section->title }}</td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $section->links_count }}</td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $section->sort_order }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.pi-clubs.toggle', $section) }}" method="POST" class="inline-flex items-center">
                                @csrf
                                @method('PATCH')
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" {{ $section->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                                    <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                                        <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                                    </div>
                                </label>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.pi-clubs.items.index', $section) }}" class="inline-flex items-center p-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-colors" title="Itens">
                                <span class="material-symbols-outlined text-sm">list</span>
                            </a>
                            <a href="{{ route('admin.pi-clubs.edit', $section) }}" class="inline-flex items-center p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.pi-clubs.destroy', $section) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir seção?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-on-surface-variant italic">Nenhuma seção cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
