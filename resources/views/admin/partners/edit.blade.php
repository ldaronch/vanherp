@extends('layouts.admin')

@section('title', 'Editar Membro - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Editar Membro</h2>
            <p class="text-on-surface-variant font-medium">Atualize os dados: {{ $partner->name }}.</p>
        </div>
        <a href="{{ route('admin.partners.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 w-full max-w-none">
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-bold text-on-surface-variant mb-2">Nome</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('name', $partner->name) }}" required>
                @error('name') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="role" class="block text-sm font-bold text-on-surface-variant mb-2">Cargo</label>
                <input type="text" name="role" id="role" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('role', $partner->role) }}">
                @error('role') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="bio" class="block text-sm font-bold text-on-surface-variant mb-2">Texto</label>
                <textarea name="bio" id="bio" rows="10" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">{{ old('bio', $partner->bio) }}</textarea>
                @error('bio') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-sm font-bold text-on-surface-variant mb-2">E-mail</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('email', $partner->email) }}">
                    @error('email') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="mobile" class="block text-sm font-bold text-on-surface-variant mb-2">Mobile</label>
                    <input type="text" name="mobile" id="mobile" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('mobile', $partner->mobile) }}">
                    @error('mobile') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="priority" class="block text-sm font-bold text-on-surface-variant mb-2">Prioridade</label>
                    <input type="number" name="priority" id="priority" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('priority', $partner->priority) }}">
                    @error('priority') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="link" class="block text-sm font-bold text-on-surface-variant mb-2">Link (opcional)</label>
                    <input type="url" name="link" id="link" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('link', $partner->link) }}" placeholder="https://">
                    @error('link') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="logo" class="block text-sm font-bold text-on-surface-variant mb-2">Foto (Deixe em branco para manter a atual)</label>
                <input type="file" name="logo" id="logo" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                @error('logo') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                @if($partner->logo)
                    <div class="mt-2 text-xs font-bold text-slate-400">Foto Atual:</div>
                    <div class="mt-1 w-32 h-32 bg-white border border-slate-100 flex items-center justify-center rounded overflow-hidden">
                        <img src="{{ url('media/' . $partner->logo) }}" class="w-full h-full object-cover">
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-between gap-6 bg-surface-container-low px-5 py-4 rounded-xl border border-slate-100">
                <div>
                    <div class="text-sm font-bold text-on-surface">Ativo</div>
                    <div class="text-xs text-on-surface-variant">Exibir este membro na página Our team.</div>
                </div>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $partner->is_active) ? 'checked' : '' }}>
                    <div class="relative w-12 h-7 bg-slate-300 rounded-full peer peer-checked:bg-primary transition-colors">
                        <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                    </div>
                </label>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection
