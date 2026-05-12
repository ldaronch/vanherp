@extends('layouts.admin')

@section('title', 'Diretrizes - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Diretrizes</h2>
            <p class="text-on-surface-variant font-medium">Gerencie as diretrizes e normas operacionais.</p>
        </div>
        <a href="{{ route('admin.guidelines.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Nova Diretriz
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-slate-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Título</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Acesso</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($guidelines as $guideline)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-on-surface">{{ $guideline->title }}</td>
                        <td class="px-6 py-4">
                            @if(!empty($guideline->url))
                                <a href="{{ $guideline->url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-xs font-bold text-secondary hover:underline">
                                    <span class="material-symbols-outlined text-sm">link</span>
                                    Abrir link
                                </a>
                            @elseif(!empty($guideline->file_path))
                                <a href="{{ asset('storage/' . $guideline->file_path) }}" class="inline-flex items-center gap-1 text-xs font-bold text-secondary hover:underline" target="_blank" rel="noopener">
                                    <span class="material-symbols-outlined text-sm">description</span>
                                    Visualizar PDF
                                </a>
                            @else
                                <span class="text-[10px] text-slate-300 italic">Sem PDF/Link</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.guidelines.edit', $guideline) }}" class="inline-flex items-center p-2 text-primary hover:bg-primary/10 rounded-lg">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.guidelines.destroy', $guideline) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir diretriz?')">
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
                        <td colspan="3" class="px-6 py-12 text-center text-on-surface-variant italic">Nenhuma diretriz cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
