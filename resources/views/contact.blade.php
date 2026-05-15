@extends('layouts.site')

@section('title', 'Contact')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <nav class="text-sm text-slate-500">
            <a href="{{ url('/') }}" class="hover:text-slate-900">Home</a>
            <span class="mx-2">/</span>
            <span class="text-slate-700 font-semibold">Contact</span>
        </nav>

        <h1 class="mt-4 inline-block text-4xl md:text-5xl font-black tracking-tight text-slate-900 py-[2px] border-b-2 border-[#C5A573]">CONTACT</h1>

        <div class="mt-10 bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <div class="lg:col-span-5 space-y-2">
                    <div class="flex items-center gap-4 text-lg">
                        <i class="fa-brands fa-whatsapp text-[#25D366] text-2xl"></i>
                        <div class="text-slate-900 font-semibold">{!! $settings->whatsapp ?? '' !!} / {!! $settings->cellphone ?? '' !!}</div>
                    </div>

                    <div class="flex items-center gap-4 text-lg pt-2">
                        <i class="fa-solid fa-envelope text-[#C5A573] text-2x1"></i>
                        <div class="text-slate-900 font-semibold break-all">{{ $settings->email_display ?? '' }}</div>
                    </div>

                    <div class="text-lg pt-4">
                        <div class="mt-3 font-bold tracking-widest text-slate-700">Office address</div>
                        <div class="text-slate-600 leading-relaxed">
                            {{ $settings->address ?? '' }}
                        </div>
                    </div>

                    <div class="text-lg pt-4">
                        <div class="mt-3 font-bold tracking-widest text-slate-700">Mailing address</div>
                        <div class="text-slate-600 leading-relaxed">
                            {{ $settings->mailing_address ?? '' }}
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="w-full rounded-2xl overflow-hidden border border-slate-100 bg-slate-100">
                        @if(!empty($settings?->maps_iframe))
                            <div class="w-full h-[420px] lg:h-[520px]">
                                {!! $settings->maps_iframe !!}
                            </div>                           
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
