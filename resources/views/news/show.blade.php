@extends('layouts.site')

@section('title', $post->title)

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12">
        <nav class="text-sm text-slate-500">
            <a href="{{ url('/') }}" class="hover:text-slate-900">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('news.index') }}" class="hover:text-slate-900">News</a>
            <span class="mx-2">/</span>
            <span class="text-slate-700 font-semibold">{{ \Illuminate\Support\Str::limit($post->title, 44) }}</span>
        </nav>

        <div class="mt-6 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            @if($post->image)
                <div class="h-72 bg-slate-100">
                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-8">
                <div class="text-xs font-semibold text-slate-500">
                    {{ optional($post->date ?? $post->created_at)->format('d/m/Y') }}
                </div>

                <h1 class="mt-3 inline-block text-3xl md:text-4xl font-black tracking-tight text-slate-900 py-[2px] border-b-2 border-[#C5A573]">{{ $post->title }}</h1>

                @if(!empty($post->header_line))
                    <div class="mt-3 text-[10px] font-bold uppercase tracking-widest text-[#C5A573]">
                        {{ $post->header_line }}
                    </div>
                @endif

                <div class="prose prose-slate max-w-none mt-8">
                    {!! $post->content !!}
                </div>

                <div class="mt-10">
                    <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#29344D] hover:text-[#C5A573] transition-colors">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        <span>Voltar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
