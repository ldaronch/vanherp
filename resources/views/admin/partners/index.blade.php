@extends('layouts.admin')

@section('title', 'Parceiros - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Parceiros</h2>
            <p class="text-on-surface-variant font-medium">Gerencie os logotipos e links dos seus parceiros.</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Novo Parceiro
        </a>
    </header>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
        @forelse($partners as $partner)
            <div class="bg-surface-container-lowest rounded-xl shadow-sm p-4 border border-slate-100 flex flex-col items-center group relative">
                <div class="w-full aspect-square bg-white flex items-center justify-center mb-3 rounded-lg border border-slate-50 p-4">
                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
                <h3 class="text-sm font-bold text-on-surface text-center line-clamp-1">{{ $partner->name }}</h3>
                
                <div class="absolute inset-0 bg-white/90 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 rounded-xl">
                    <a href="{{ route('admin.partners.edit', $partner) }}" class="p-2 text-primary hover:bg-primary/10 rounded-lg">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </a>
                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" onsubmit="return confirm('Excluir parceiro?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                            <span class="material-symbols-outlined text-sm">delete</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-on-surface-variant italic">Nenhum parceiro cadastrado.</div>
        @endforelse
    </div>
@endsection
