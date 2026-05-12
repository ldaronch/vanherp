@extends('layouts.site')

@section('title', 'News')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <nav class="text-sm text-slate-500">
            <a href="{{ url('/') }}" class="hover:text-slate-900">Home</a>
            <span class="mx-2">/</span>
            <span class="text-slate-700 font-semibold">News</span>
        </nav>

        <h1 class="mt-4 inline-block text-4xl md:text-5xl font-black tracking-tight text-slate-900 py-[2px] border-b-2 border-[#C5A573]">News</h1>
        <p class="mt-4 text-slate-600 leading-relaxed">Acompanhe as últimas publicações.</p>

        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
                <article class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <a href="{{ route('news.show', $post->slug) }}" class="block aspect-[16/9] bg-slate-100">
                        @if($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-slate-200"></div>
                        @endif
                    </a>
                    <div class="p-6">
                        <div class="text-xs font-semibold text-slate-500">
                            {{ optional($post->date ?? $post->created_at)->format('d/m/Y') }}
                        </div>

                        <h2 class="mt-2 text-lg font-bold text-slate-900 leading-snug">
                            <a href="{{ route('news.show', $post->slug) }}" class="hover:text-[#C5A573] transition-colors">
                                {{ $post->title }}
                            </a>
                        </h2>

                        @if(!empty($post->header_line))
                            <div class="mt-2 text-[10px] font-bold uppercase tracking-widest text-[#C5A573]">
                                {{ $post->header_line }}
                            </div>
                        @endif

                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#29344D] hover:text-[#C5A573] transition-colors">
                                <span>Read more</span>
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="text-slate-500">Nenhuma notícia publicada.</div>
            @endforelse
        </div>

        @if($posts->hasPages())
            <div class="mt-10">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
