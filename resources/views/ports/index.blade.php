@extends('layouts.site')

@section('title', 'Ports')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <nav class="text-sm text-slate-500">
            <a href="{{ url('/') }}" class="hover:text-slate-900">Home</a>
            <span class="mx-2">/</span>
            <span class="text-slate-700 font-semibold">Ports</span>
        </nav>

        <h1 class="mt-4 inline-block text-4xl md:text-5xl font-black tracking-tight text-slate-900 py-2 border-b-4 border-[#C5A573]">Ports</h1>

        <div class="mt-10 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="divide-y divide-slate-100">
                @forelse($ports as $port)
                    <a href="{{ $port->url ?: '#' }}" target="{{ $port->url ? '_blank' : '_self' }}" rel="noopener" class="flex items-center justify-between px-6 py-5 hover:bg-slate-50 transition-colors">
                        <div class="font-semibold text-slate-900">{{ $port->name }}</div>
                        <i class="fa-solid fa-arrow-up-right-from-square text-slate-400"></i>
                    </a>
                @empty
                    <div class="px-6 py-10 text-slate-500">Nenhum porto ativo cadastrado.</div>
                @endforelse
            </div>
        </div>

        <div id="map" class="mt-10 flex items-center justify-center">
            <img src="{{ asset('map.svg') }}" alt="Map" class="w-[100%] h-auto">
        </div>
    </div>
@endsection
