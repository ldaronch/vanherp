@extends('layouts.admin')

@section('title', 'Redes Sociais - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Redes Sociais</h2>
            <p class="text-on-surface-variant font-medium">Gerencie os links das redes sociais da empresa.</p>
        </div>
        <a href="{{ route('admin.social-networks.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Nova Rede Social
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-slate-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Nome</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">URL</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Status</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($networks as $network)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-on-surface">
                            <div class="flex items-center gap-3">
                                <span class="text-secondary text-lg">
                                    <i class="{{ $network->icon ?: 'fa-solid fa-link' }}"></i>
                                </span>
                                {{ $network->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $network->url }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $network->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                {{ $network->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <form action="{{ route('admin.social-networks.toggle', $network) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center p-2 {{ $network->is_active ? 'text-amber-700 hover:bg-amber-50' : 'text-emerald-700 hover:bg-emerald-50' }} rounded-lg transition-colors" title="{{ $network->is_active ? 'Inativar' : 'Ativar' }}">
                                    <span class="material-symbols-outlined text-sm">{{ $network->is_active ? 'toggle_off' : 'toggle_on' }}</span>
                                </button>
                            </form>
                            <a href="{{ route('admin.social-networks.edit', $network) }}" class="inline-flex items-center p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.social-networks.destroy', $network) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir rede social?')">
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
                        <td colspan="4" class="px-6 py-12 text-center text-on-surface-variant italic">Nenhuma rede social cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
