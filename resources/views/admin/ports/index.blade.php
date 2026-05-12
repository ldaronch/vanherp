@extends('layouts.admin')

@section('title', 'Portos - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Portos</h2>
            <p class="text-on-surface-variant font-medium">Gerencie os portos de atuação da empresa.</p>
        </div>
        <a href="{{ route('admin.ports.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Novo Porto
        </a>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($ports as $port)
            <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-slate-100 flex flex-col">
                <div class="aspect-video relative overflow-hidden bg-slate-100">
                    @if($port->image)
                        <img src="{{ asset('storage/' . $port->image) }}" alt="{{ $port->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <span class="material-symbols-outlined text-5xl">directions_boat</span>
                        </div>
                    @endif
                </div>
                <div class="p-6 flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-on-surface">{{ $port->name }}</h3>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.ports.edit', $port) }}" class="p-2 text-primary hover:bg-primary/10 rounded-lg">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.ports.destroy', $port) }}" method="POST" onsubmit="return confirm('Excluir este porto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <p class="text-xs font-bold text-secondary uppercase tracking-widest mb-3">{{ $port->location ?? 'Localização não informada' }}</p>
                    <p class="text-sm text-on-surface-variant line-clamp-3">{{ $port->description ?? 'Sem descrição' }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-on-surface-variant italic">Nenhum porto cadastrado.</div>
        @endforelse
    </div>
@endsection
