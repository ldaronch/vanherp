@extends('layouts.admin')

@section('title', 'Editar Notícia - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Editar Notícia</h2>
            <p class="text-on-surface-variant font-medium">Atualize os dados da postagem: {{ $post->title }}.</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar
        </a>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 w-full max-w-none">
        <form id="postForm" action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="date" class="block text-sm font-bold text-on-surface-variant mb-2">Data</label>
                    <input type="date" name="date" id="date" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('date', optional($post->date)->format('Y-m-d')) }}" required>
                    @error('date') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-bold text-on-surface-variant mb-2">Título da Notícia</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('title', $post->title) }}" required>
                    @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="header_line" class="block text-sm font-bold text-on-surface-variant mb-2">Linha de Cabeçalho</label>
                    <input type="text" name="header_line" id="header_line" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('header_line', $post->header_line) }}">
                    @error('header_line') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="slug" class="block text-sm font-bold text-on-surface-variant mb-2">Slug (URL)</label>
                    <input type="text" name="slug" id="slug" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('slug', $post->slug) }}">
                    @error('slug') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-bold text-on-surface-variant mb-2">Categoria</label>
                    <select name="category_id" id="category_id" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                        <option value="">Sem categoria</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="image" class="block text-sm font-bold text-on-surface-variant mb-2">Imagem de Destaque (Deixe em branco para manter)</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    @error('image') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    @if($post->image)
                        <div class="mt-2 text-xs font-bold text-slate-400">Imagem Atual:</div>
                        <img src="{{ url('media/' . $post->image) }}" class="mt-1 h-20 rounded shadow-sm">
                    @endif
                </div>
                <div class="flex items-center gap-6 pt-6 md:col-span-2">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" value="1" class="w-5 h-5 text-primary border-slate-300 rounded focus:ring-primary" {{ $post->is_published ? 'checked' : '' }}>
                    <label for="is_published" class="text-sm font-bold text-on-surface-variant">Publicar Notícia</label>

                    <div class="flex items-center gap-3">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" class="w-5 h-5 text-primary border-slate-300 rounded focus:ring-primary" {{ $post->is_featured ? 'checked' : '' }}>
                        <label for="is_featured" class="text-sm font-bold text-on-surface-variant">Exibir em destaque</label>
                    </div>
                </div>
            </div>
            <div>
                <label for="content" class="block text-sm font-bold text-on-surface-variant mb-2">Conteúdo da Notícia</label>
                <textarea name="content" id="content" rows="7" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">{{ old('content', $post->content) }}</textarea>
                @error('content') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        let postEditor = null;
        ClassicEditor.create(document.querySelector('#content'))
            .then((editor) => {
                postEditor = editor;
            })
            .catch(() => {});

        const postForm = document.getElementById('postForm');
        postForm?.addEventListener('submit', (e) => {
            if (!postEditor) return;
            const data = (postEditor.getData() || '').trim();
            document.getElementById('content').value = data;
            if (!data) {
                e.preventDefault();
                alert('Preencha o conteúdo da notícia.');
                postEditor.editing.view.focus();
            }
        });
    </script>
@endpush
