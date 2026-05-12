@extends('layouts.admin')

@section('title', 'Our team - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Our team</h2>
            <p class="text-on-surface-variant font-medium">Gerencie membros e prioridade de exibição.</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg">
            <span class="material-symbols-outlined">add</span>
            Novo Membro
        </a>
    </header>

    <div class="grid grid-cols-1 gap-6">
        @forelse($partners as $partner)
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-slate-100 p-6 flex flex-col md:flex-row md:items-center gap-6">
                <div class="w-24 h-24 rounded-xl overflow-hidden bg-white border border-slate-100 shrink-0">
                    @if($partner->logo)
                        <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}" class="w-full h-full object-cover">
                    @endif
                </div>

                <div class="flex-1 min-w-0">
                    <div class="text-lg font-bold text-on-surface">{{ $partner->name }}</div>
                    @if(!empty($partner->role))
                        <div class="mt-1 text-sm text-on-surface-variant font-medium">{{ $partner->role }}</div>
                    @endif
                    <div class="mt-2 text-xs text-on-surface-variant font-semibold">Prioridade: {{ $partner->priority }}</div>
                </div>

                <div class="flex items-center gap-3">
                    <form action="{{ route('admin.partners.toggle', $partner) }}" method="POST" class="inline-flex items-center">
                        @csrf
                        @method('PATCH')
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" {{ $partner->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                            <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                                <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                            </div>
                        </label>
                    </form>

                    <a href="{{ route('admin.partners.edit', $partner) }}" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </a>
                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" onsubmit="return confirm('Excluir membro?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-sm">delete</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-on-surface-variant italic">Nenhum membro cadastrado.</div>
        @endforelse
    </div>
@endsection
