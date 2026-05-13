@extends('layouts.site')

@section('title', 'Our history')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <nav class="text-sm text-slate-500">
            <a href="{{ url('/') }}" class="hover:text-slate-900">Home</a>
            <span class="mx-2">/</span>
            <span class="text-slate-700 font-semibold">Our history</span>
        </nav>

        <h1 class="mt-4 inline-block text-4xl md:text-5xl font-black tracking-tight text-slate-900 py-[2px] border-b-2 border-[#C5A573]">{{ $about->title ?? 'Our history' }}</h1>
        <div class="mt-5 text-slate-600 leading-relaxed whitespace-pre-line">
            {{ $about->content ?? '' }}
        </div>
    </div>

    <div class="w-full">
        @if(!empty($about?->image))
            <img src="{{ route('media', ['path' => $about->image]) }}" alt="{{ $about->title ?? 'History' }}" class="w-full h-[360px] md:h-[520px] object-cover">
        @else
            <div class="w-full h-[360px] md:h-[520px] bg-slate-200"></div>
        @endif
    </div>
@endsection
