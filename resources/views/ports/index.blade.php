@extends('layouts.site')

@section('title', 'Ports')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <nav class="text-sm text-slate-500">
            <a href="{{ url('/') }}" class="hover:text-slate-900">Home</a>
            <span class="mx-2">/</span>
            <span class="text-slate-700 font-semibold">Ports</span>
        </nav>

        <h1 class="mt-4 inline-block text-4xl md:text-5xl font-black tracking-tight text-slate-900 py-[2px] border-b-2 border-[#C5A573]">Ports</h1>

        <div class="mt-10 bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
            @forelse($ports as $port)
                @if($loop->first)
                    <ul class="space-y-3">
                @endif
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-arrow-right text-[#C5A573] mt-1"></i>
                            @if(!empty($port->url))
                                <a href="{{ $port->url }}" target="_blank" rel="noopener" class="leading-relaxed hover:text-[#C5A573] transition-colors">
                                    {{ $port->name }}
                                </a>
                            @else
                                <span class="leading-relaxed">{{ $port->name }}</span>
                            @endif
                        </li>
                @if($loop->last)
                    </ul>
                @endif
            @empty
                <div class="text-slate-500">Nenhum porto ativo cadastrado.</div>
            @endforelse
        </div>

        <div id="map" class="mt-10 flex items-center justify-center">
            <object data="{{ asset('map.svg') }}" type="image/svg+xml" class="w-[90%] h-auto" aria-label="Map"></object>
        </div>
    </div>
@endsection
