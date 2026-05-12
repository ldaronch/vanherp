@extends('layouts.site')

@section('title', 'Our services')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <nav class="text-sm text-slate-500">
            <a href="{{ url('/') }}" class="hover:text-slate-900">Home</a>
            <span class="mx-2">/</span>
            <span class="text-slate-700 font-semibold">Our services</span>
        </nav>

        <h1 class="mt-4 inline-block text-4xl md:text-5xl font-black tracking-tight text-slate-900 py-[2px] border-b-2 border-[#C5A573]">{{ $page->title ?? 'Our services' }}</h1>
        <div class="mt-6 text-slate-600 leading-relaxed whitespace-pre-line">
            {{ $page->text ?? 'Conteúdo em construção.' }}
        </div>

        @php
            $items = !empty($page?->items)
                ? array_values(array_filter(preg_split("/\r\n|\r|\n/", trim($page->items))))
                : [];
        @endphp

        @if(!empty($items))
            <div class="mt-10">
                <ul class="space-y-3">
                    @foreach($items as $item)
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-arrow-right text-[#C5A573] mt-1"></i>
                            <span class="leading-relaxed">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-10 w-full">
            @if(!empty($page?->image))
                <img src="{{ asset('storage/'.$page->image) }}" alt="{{ $page->title ?? 'Our services' }}" class="w-full h-[360px] md:h-[520px] object-cover">
            @else
                <div class="w-full h-[360px] md:h-[520px] bg-slate-200"></div>
            @endif
        </div>
    </div>
@endsection
