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
            $itemsRaw = trim((string) ($page?->items ?? ''));
            $items = [];

            if ($itemsRaw !== '') {
                $decoded = json_decode($itemsRaw, true);
                $items = (json_last_error() === JSON_ERROR_NONE && is_array($decoded))
                    ? $decoded
                    : preg_split("/\r\n|\r|\n/", $itemsRaw);
            }

            $parsedItems = [];

            foreach ($items as $rawItem) {
                if (is_array($rawItem)) {
                    $name = trim((string) ($rawItem['name'] ?? $rawItem['title'] ?? ''));
                    $url = trim((string) ($rawItem['url'] ?? ''));
                } else {
                    $line = trim((string) $rawItem);
                    $line = preg_replace('/^[\-\*\•\x{2022}\x{25CF}\x{25AA}\x{25E6}]+\s*/u', '', $line);

                    $parts = array_map('trim', explode('|', $line, 2));
                    $name = $parts[0] ?? '';
                    $url = $parts[1] ?? '';
                }

                if ($name !== '') {
                    $parsedItems[] = ['name' => $name, 'url' => $url];
                }
            }
        @endphp

        @if(!empty($parsedItems))
            <div class="mt-10 bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
                <ul class="space-y-3">
                    @foreach($parsedItems as $item)
                        <li class="flex items-start gap-3 text-slate-700">
                            <i class="fa-solid fa-arrow-right text-[#C5A573] mt-1"></i>
                            @if(!empty($item['url']))
                                <a href="{{ $item['url'] }}" target="_blank" rel="noopener" class="leading-relaxed hover:text-[#C5A573] transition-colors">
                                    {{ $item['name'] }}
                                </a>
                            @else
                                <span class="leading-relaxed">{{ $item['name'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-10 w-full">
            @if(!empty($page?->image))
                <img src="{{ route('media', ['path' => $page->image]) }}" alt="{{ $page->title ?? 'Our services' }}" class="w-full h-auto object-cover">
            @endif
        </div>
    </div>
@endsection
