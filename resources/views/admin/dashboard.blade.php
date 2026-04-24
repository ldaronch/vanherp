@extends('layouts.admin')

@section('title', 'Dashboard - Visão Geral')

@section('content')
    <!-- Hero Section -->
    <header class="mb-10">
        <h2 class="text-[2.75rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Saúde do Sistema</h2>
        <p class="text-on-surface-variant font-medium">Métricas de desempenho em tempo real e visão operacional.</p>
    </header>

    <!-- Bento Grid Metrics -->
    <div class="grid grid-cols-12 gap-6 mb-12">
        <!-- Large Metric -->
        <div class="col-span-12 lg:col-span-8 bg-surface-container-lowest p-8 rounded-xl shadow-sm flex flex-col justify-between border-none">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs uppercase tracking-widest font-bold text-on-surface-variant mb-4 block">Crescimento Primário</span>
                    <div class="text-[3.5rem] font-extrabold text-primary tracking-tighter">14,285</div>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="flex items-center text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded text-xs font-bold">
                            <span class="material-symbols-outlined text-xs mr-1">trending_up</span> +12.4%
                        </span>
                        <span class="text-xs text-on-surface-variant font-medium">vs último mês</span>
                    </div>
                </div>
                <div class="w-1/2 h-32 opacity-20">
                    <img alt="Chart Visualization" class="w-full h-full object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2d3mdbkl0jj4DtqecRyguLho_gKJwuPyXLeQ40ebYDOwcf2pvnLFK4MsWFyYCeofVY08FuVOGnr0Y6KfJN_Z5c9d4B3t8ZFqL4XrtbwVuX-IuyeZg5uyFKCrZUJyCM4vBNZFjbwVpEsitSI9px2cbTGdkD_8xdORSANS2YkYNsr7p9Qo6jKPgauZYYzvqW-qDDCRutIcdculoWf78mOA9XpGTTpCoOo6yRJBZLs-rWO33RNCwbZNXXDMAtu0ZNIFmKK2svNYJmPp4"/>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-slate-50 flex gap-12">
                <div>
                    <div class="text-label-md text-on-surface-variant font-semibold">Total de Usuários</div>
                    <div class="text-xl font-bold text-on-surface">1.2M</div>
                </div>
                <div>
                    <div class="text-label-md text-on-surface-variant font-semibold">Nós Ativos</div>
                    <div class="text-xl font-bold text-on-surface">842</div>
                </div>
            </div>
        </div>

        <!-- Small Metric 1 -->
        <div class="col-span-12 md:col-span-6 lg:col-span-4 bg-surface-container-low p-8 rounded-xl flex flex-col justify-between">
            <span class="material-symbols-outlined text-tertiary text-3xl mb-4">bolt</span>
            <div>
                <span class="text-xs uppercase tracking-widest font-bold text-on-surface-variant block mb-1">Sessões Ativas</span>
                <div class="text-3xl font-extrabold text-on-surface">4,912</div>
                <div class="mt-4 h-1.5 w-full bg-slate-200 rounded-full overflow-hidden">
                    <div class="h-full bg-tertiary w-3/4"></div>
                </div>
            </div>
        </div>

        <!-- Small Metric 2 -->
        <div class="col-span-12 md:col-span-6 lg:col-span-4 bg-surface-container-low p-8 rounded-xl flex flex-col justify-between">
            <span class="material-symbols-outlined text-blue-600 text-3xl mb-4">task_alt</span>
            <div>
                <span class="text-xs uppercase tracking-widest font-bold text-on-surface-variant block mb-1">Tarefas Pendentes</span>
                <div class="text-3xl font-extrabold text-on-surface">28</div>
                <div class="mt-2 text-xs font-medium text-on-surface-variant italic">Fila de alta prioridade: 4</div>
            </div>
        </div>

        <!-- CTA Card -->
        <div class="col-span-12 lg:col-span-8 polish-gradient p-8 rounded-xl flex items-center justify-between text-white overflow-hidden relative">
            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-2">Nova Atualização do Sistema Disponível</h3>
                <p class="text-blue-100 opacity-90 max-w-md mb-6">Experimente as últimas melhorias arquiteturais e patches de desempenho v4.2.0.</p>
                <button class="bg-white text-primary px-6 py-2.5 rounded font-bold text-sm hover:bg-blue-50 transition-colors shadow-lg">Instalar Agora</button>
            </div>
            <div class="absolute right-0 top-0 h-full w-1/3 overflow-hidden opacity-20 transform translate-x-10">
                <span class="material-symbols-outlined text-[12rem] text-white">architecture</span>
            </div>
        </div>
    </div>

    <!-- Secondary Content Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-4">
        <div class="bg-surface-container-lowest p-8 rounded-xl">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-on-surface">Atividade Recente</h3>
                <button class="text-primary text-xs font-bold hover:underline">Ver Tudo</button>
            </div>
            <div class="space-y-6">
                <div class="flex items-center gap-4 py-1">
                    <div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-surface-variant">person_add</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Novo registro de usuário: <span class="text-primary">Sarah Miller</span></p>
                        <p class="text-xs text-on-surface-variant">há 2 minutos</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 py-1">
                    <div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-surface-variant">shield</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Configuração do sistema modificada: <span class="text-tertiary">Protocolos de Auth</span></p>
                        <p class="text-xs text-on-surface-variant">há 1 hora</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 py-1">
                    <div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-surface-variant">database</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Otimização de banco de dados concluída</p>
                        <p class="text-xs text-on-surface-variant">há 4 horas</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-8 rounded-xl overflow-hidden relative">
            <img alt="Office Context" class="absolute inset-0 w-full h-full object-cover opacity-10" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCoW1GVl45BoSBgpM_gdd924KiH2_ih2iH9iwu4O5dJTbfklcMVgDAKBX0RaODxSsziKwDO_MvO2giY7DPn88QTMXyphdBYRhKIL7HI36QbAvN9uXVPvLOrUI8wJqM6cjvYScNrnaLgjsVZeLLBk12TGNxhIuFy5HK-65A8ZqylzCTZEl3R57zM5X2rYZxPP7ozzFMdzu7cJTiMd67UgUQRoz9gR-SddYoxRVgUQQ4KM8CXCS8zmU6Sh1VT4wFO0EwUt14uHkW8BUY8"/>
            <div class="relative z-10 flex flex-col h-full">
                <h3 class="text-lg font-bold text-on-surface mb-6">Acesso Regional</h3>
                <div class="flex-1 bg-surface-container-low rounded-lg flex items-center justify-center border border-slate-200/20">
                    <div class="text-center p-6">
                        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">map</span>
                        <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Mapa Global de Nós</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-between">
                    <div class="flex gap-4">
                        <div class="flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-[10px] font-bold text-on-surface-variant">Online</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <span class="text-[10px] font-bold text-on-surface-variant">Aviso</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="fixed bottom-8 right-8 z-[100]">
        <button class="w-14 h-14 rounded-full polish-gradient text-white flex items-center justify-center shadow-xl hover:scale-105 active:scale-95 transition-transform duration-150">
            <span class="material-symbols-outlined">add</span>
        </button>
    </div>
@endsection
