@extends('layouts.site')

@section('title', 'Our team')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <nav class="text-sm text-slate-500">
            <a href="{{ url('/') }}" class="hover:text-slate-900">Home</a>
            <span class="mx-2">/</span>
            <span class="text-slate-700 font-semibold">Our team</span>
        </nav>

        <h1 class="mt-4 inline-block text-4xl md:text-5xl font-black tracking-tight text-slate-900 py-[2px] border-b-2 border-[#C5A573]">Our team</h1>

        <div class="mt-10 space-y-10">
            @forelse($members as $member)
                <article class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
                        <div class="md:col-span-4">
                            <div class="w-full aspect-square rounded-2xl overflow-hidden bg-slate-200">
                                @if(!empty($member->logo))
                                    <img src="{{ asset('storage/'.$member->logo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                        </div>
                        <div class="md:col-span-8">
                            <h2 class="text-2xl md:text-3xl font-black tracking-tight text-slate-900 uppercase">
                                {{ $member->name }}
                            </h2>

                            @if(!empty($member->role))
                                <div class="mt-1 text-slate-700 font-semibold">
                                    {{ $member->role }}
                                </div>
                            @endif

                            @if(!empty($member->bio))
                                <div class="text-slate-600 leading-relaxed ">
                                    {{ $member->bio }}
                                </div>
                            @endif

                            <div class="mt-1 space-y-1">
                                @if(!empty($member->email))
                                    <div class="text-slate-900 font-bold">
                                        e-mail:
                                        <a href="mailto:{{ $member->email }}" class="text-blue-600 underline break-all">
                                            {{ $member->email }}
                                        </a>
                                    </div>
                                @endif

                                @if(!empty($member->mobile))
                                    <div class="text-slate-900 font-bold">
                                        Mobile:
                                        <span class="text-slate-900">{{ $member->mobile }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="text-slate-500">Nenhum membro ativo cadastrado.</div>
            @endforelse
        </div>
    </div>
@endsection
