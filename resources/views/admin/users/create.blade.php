@extends('layouts.admin')

@section('title', 'Novo Usuário - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Novo Usuário</h2>
            <p class="text-on-surface-variant font-medium">Cadastre um novo administrador para o painel.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-4xl mx-auto">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-bold text-on-surface-variant mb-2">Nome Completo</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('name') }}" required placeholder="Ex: Alex Architect">
                    @error('name') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-bold text-on-surface-variant mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('email') }}" required placeholder="Ex: alex@admin.com">
                    @error('email') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-bold text-on-surface-variant mb-2">Senha</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required placeholder="Mínimo 8 caracteres">
                    @error('password') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-on-surface-variant mb-2">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required placeholder="Repita a senha">
                </div>
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Criar Usuário
                </button>
            </div>
        </form>
    </div>
@endsection
