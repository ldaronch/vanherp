@extends('layouts.admin')

@section('title', 'Termos e Privacidade - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Termos e Privacidade</h2>
            <p class="text-on-surface-variant font-medium">Gerencie os textos legais do site.</p>
        </div>
        <a href="{{ route('admin.legal-texts.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-900 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Novo Texto Legal
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-slate-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Título</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Slug (URL)</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-widest font-bold text-on-surface-variant text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($texts as $text)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-on-surface">{{ $text->title }}</td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $text->slug }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.legal-texts.edit', $text) }}" class="inline-flex items-center p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.legal-texts.destroy', $text) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir texto legal?')">
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
                        <td colspan="3" class="px-6 py-12 text-center text-on-surface-variant italic">Nenhum texto legal cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
