@extends('layouts.admin')

@section('title', 'Portos - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Portos</h2>
            <p class="text-on-surface-variant font-medium">Gerencie os portos exibidos na página de Ports.</p>
        </div>
        <a href="{{ route('admin.ports.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Novo Porto
        </a>
    </header>

    <div class="grid grid-cols-1 gap-6">
        @forelse($ports as $port)
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-slate-100 p-6 flex flex-col md:flex-row md:items-center gap-6">
                <div class="flex-1">
                    <div class="text-lg font-bold text-on-surface">{{ $port->name }}</div>
                    <div class="mt-1 text-sm text-on-surface-variant break-all">{{ $port->url ?? '—' }}</div>
                </div>
                <div class="flex items-center gap-3">
                    <form action="{{ route('admin.ports.toggle', $port) }}" method="POST" class="inline-flex items-center">
                        @csrf
                        @method('PATCH')
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" {{ $port->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                            <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                                <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                            </div>
                        </label>
                    </form>
                    <a href="{{ route('admin.ports.edit', $port) }}" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </a>
                    <form action="{{ route('admin.ports.destroy', $port) }}" method="POST" onsubmit="return confirm('Excluir este porto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-sm">delete</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-on-surface-variant italic">Nenhum porto cadastrado.</div>
        @endforelse
    </div>
@endsection
