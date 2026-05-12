@extends('layouts.admin')

@section('title', 'Configurações do Site - Painel Administrativo')

@section('content')
    <header class="mb-10 flex justify-between items-center">
        <div>
            <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Configurações do Site</h2>
            <p class="text-on-surface-variant font-medium">Gerencie título, copyright, contatos e endereços.</p>
        </div>
    </header>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-8 border border-slate-100 max-w-5xl mx-auto">
        <form action="{{ route('admin.contact.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="site_title" class="block text-sm font-bold text-on-surface-variant mb-2">Título do Site</label>
                    <input type="text" name="site_title" id="site_title" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('site_title', $contact->site_title) }}" placeholder="Ex: Nome da Empresa - Serviços de Logística">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-50">
                <div>
                    <label for="email_display" class="block text-sm font-bold text-on-surface-variant mb-2">Email de Exibição (Site)</label>
                    <input type="email" name="email_display" id="email_display" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('email_display', $contact->email_display) }}">
                </div>
                <div>
                    <label for="email_leads" class="block text-sm font-bold text-on-surface-variant mb-2">Email para Receber Leads (Formulários)</label>
                    <input type="email" name="email_leads" id="email_leads" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('email_leads', $contact->email_leads) }}">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 pt-4 border-t border-slate-50">
                <div>
                    <label for="phone" class="block text-sm font-bold text-on-surface-variant mb-2">Telefone</label>
                    <input type="text" name="phone" id="phone" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('phone', $contact->phone) }}">
                </div>
                <div>
                    <label for="cellphone" class="block text-sm font-bold text-on-surface-variant mb-2">Celular</label>
                    <input type="text" name="cellphone" id="cellphone" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('cellphone', $contact->cellphone) }}">
                </div>
                <div>
                    <label for="whatsapp" class="block text-sm font-bold text-on-surface-variant mb-2">WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('whatsapp', $contact->whatsapp) }}">
                </div>
                <div>
                    <label for="emergency_phone" class="block text-sm font-bold text-on-surface-variant mb-2">Telefone de Emergência</label>
                    <input type="text" name="emergency_phone" id="emergency_phone" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('emergency_phone', $contact->emergency_phone) }}">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-50">
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-bold text-on-surface-variant mb-2">Endereço do Escritório</label>
                    <textarea name="address" id="address" rows="3" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">{{ old('address', $contact->address) }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="mailing_address" class="block text-sm font-bold text-on-surface-variant mb-2">Endereço de Correspondência</label>
                    <textarea name="mailing_address" id="mailing_address" rows="3" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all">{{ old('mailing_address', $contact->mailing_address) }}</textarea>
                </div>
            </div>

            <div class="space-y-4 pt-4 border-t border-slate-50">
                <div>
                    <label for="copyright_text" class="block text-sm font-bold text-on-surface-variant mb-2">Texto de Copyright (Rodapé)</label>
                    <input type="text" name="copyright_text" id="copyright_text" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" value="{{ old('copyright_text', $contact->copyright_text) }}" placeholder="Ex: © 2026 Nome da Empresa. Todos os direitos reservados.">
                </div>
                <div>
                    <label for="maps_iframe" class="block text-sm font-bold text-on-surface-variant mb-2">Iframe do Google Maps</label>
                    <textarea name="maps_iframe" id="maps_iframe" rows="4" class="w-full px-4 py-3 bg-surface-container-low border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="Cole aqui o código de incorporação do Google Maps">{{ old('maps_iframe', $contact->maps_iframe) }}</textarea>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl font-bold hover:brightness-110 transition-colors shadow-lg active:scale-95 duration-150">
                    Salvar Configurações
                </button>
            </div>
        </form>
    </div>
@endsection
