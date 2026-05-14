@extends('layouts.site')

@section('title', 'Our history')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <nav class="text-sm text-slate-500">
            <a href="{{ url('/') }}" class="hover:text-slate-900">Home</a>
            <span class="mx-2">/</span>
            <span class="text-slate-700 font-semibold">Our history</span>
        </nav>

        <h1 class="mt-4 inline-block text-4xl md:text-5xl font-black tracking-tight text-slate-900 py-[2px] border-b-2 border-[#C5A573]">{{ $page->title ?? 'Our history' }}</h1>

        <div class="mt-6 text-slate-600 leading-relaxed whitespace-pre-line">
            {{ $page->text ?? 'Conteúdo em construção.' }}
        </div>

        <div class="mt-10 w-full">
            @if(!empty($page?->image))
                <img src="{{ route('media', ['path' => $page->image]) }}" alt="{{ $page->title ?? 'Our history' }}" class="w-full h-auto object-cover">
                @if(!empty($page?->image_caption))
                    <div class="mt-3 text-sm text-slate-500">{{ $page->image_caption }}</div>
                @endif
            @else
                <div class="w-full h-[360px] md:h-[520px] bg-slate-200"></div>
            @endif
        </div>
    </div>
@endsection
