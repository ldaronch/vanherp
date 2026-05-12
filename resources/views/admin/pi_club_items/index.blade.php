@extends('layouts.admin')

@section('title', 'Itens P&I Clubs - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Itens - {{ $piClub->title }}</h2>
            <p class="text-on-surface-variant font-medium">Gerencie itens com ou sem link.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.pi-clubs.items.create', $piClub) }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
                <span class="material-symbols-outlined">add</span>
                Novo Item
            </a>
            <a href="{{ route('admin.pi-clubs.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
                <span class="material-symbols-outlined">arrow_back</span>
                Voltar
            </a>
        </div>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-slate-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Título</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">URL</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Ordem</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Ativo</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($items as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-on-surface">{{ $item->name }}</td>
                        <td class="px-6 py-4 text-on-surface-variant break-all">{{ $item->url ?? '—' }}</td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $item->sort_order }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.pi-clubs.items.toggle', [$piClub, $item]) }}" method="POST" class="inline-flex items-center">
                                @csrf
                                @method('PATCH')
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" {{ $item->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                                    <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                                        <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                                    </div>
                                </label>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.pi-clubs.items.edit', [$piClub, $item]) }}" class="inline-flex items-center p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.pi-clubs.items.destroy', [$piClub, $item]) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir item?')">
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
                        <td colspan="5" class="px-6 py-12 text-center text-on-surface-variant italic">Nenhum item cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

