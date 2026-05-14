@extends('layouts.site')

@section('title', 'Circulars & Guidelines')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <nav class="text-sm text-slate-500">
            <a href="{{ url('/') }}" class="hover:text-slate-900">Home</a>
            <span class="mx-2">/</span>
            <span class="text-slate-700 font-semibold">Circulars &amp; Guidelines</span>
        </nav>

        <h1 class="mt-4 inline-block text-4xl md:text-5xl font-black tracking-tight text-slate-900 py-2 border-b-4 border-[#C5A573]">Circulars &amp; Guidelines</h1>

        <div class="mt-10 space-y-10">
            @forelse($sections as $section)
                <section class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-slate-900">{{ $section->title }}</h2>

                    @if($section->items->count())
                        <div class="mt-6">
                            <ul class="space-y-3">
                                @foreach($section->items as $item)
                                    <li class="flex items-start gap-3 text-slate-700">
                                        <i class="fa-solid fa-arrow-right text-[#C5A573] mt-1"></i>
                                        @if(!empty($item->file_path) || !empty($item->url))
                                            <a href="{{ !empty($item->file_path) ? asset('storage/' . $item->file_path) : $item->url }}" target="_blank" rel="noopener" class="leading-relaxed hover:text-[#C5A573] transition-colors">
                                                {{ $item->name }}
                                            </a>
                                        @else
                                            <span class="leading-relaxed">{{ $item->name }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($section->show_note && !empty($section->note))
                        <div class="mt-8 text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                            {{ $section->note }}
                        </div>
                    @endif
                </section>
            @empty
                <div class="text-slate-500">Nenhuma seção ativa cadastrada.</div>
            @endforelse
        </div>

    </div>
@endsection
