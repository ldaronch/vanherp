@extends('layouts.admin')

@section('title', 'Circulares - Painel Administrativo')
@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Circulares</h2>
            <p class="text-on-surface-variant font-medium">Gerencie os documentos e circulares da empresa.</p>
        </div>
        <a href="{{ route('admin.circulars.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Nova Circular
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-slate-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Título</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Data</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Acesso</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($circulars as $circular)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-on-surface">{{ $circular->title }}</td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $circular->date ? \Carbon\Carbon::parse($circular->date)->format('d/m/Y') : '-' }}</td>
                        <td class="px-6 py-4">
                            @if(!empty($circular->url))
                                <a href="{{ $circular->url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-xs font-bold text-secondary hover:underline">
                                    <span class="material-symbols-outlined text-sm">link</span>
                                    Abrir link
                                </a>
                            @else
                            <!-- ajuste -->
                                <div class="flex flex-col gap-1">
                                    @forelse($circular->attachments as $attachment)
                                        <a href="{{ route('media', ['path' => $attachment->file_path]) }}" class="inline-flex items-center gap-1 text-[10px] font-bold text-secondary hover:underline" target="_blank" rel="noopener">
                                            <span class="material-symbols-outlined text-xs">description</span>
                                            {{ Str::limit($attachment->original_name, 20) }}
                                        </a>
                                    @empty
                                        <span class="text-[10px] text-slate-300 italic">Sem PDF/Link</span>
                                    @endforelse
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.circulars.edit', $circular) }}" class="inline-flex items-center p-2 text-primary hover:bg-primary/10 rounded-lg">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.circulars.destroy', $circular) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir circular?')">
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
                        <td colspan="4" class="px-6 py-12 text-center text-on-surface-variant italic">Nenhuma circular cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
