<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }} | Launch Observatory</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#07100f] font-sans text-[#e9f0dc] antialiased">
        <div class="min-h-screen overflow-hidden bg-[radial-gradient(circle_at_48%_-10%,rgba(154,208,95,0.17),transparent_32%),linear-gradient(120deg,#07100f_0%,#0b1714_55%,#10140e_100%)]">
            <div class="pointer-events-none fixed inset-0 bg-[linear-gradient(rgba(226,247,204,0.025)_1px,transparent_1px),linear-gradient(90deg,rgba(226,247,204,0.025)_1px,transparent_1px)] bg-[size:44px_44px] [mask-image:linear-gradient(to_bottom,black,transparent_82%)]"></div>

            <div class="relative mx-auto flex min-h-screen max-w-[1540px] flex-col lg:flex-row">
                <aside class="flex shrink-0 flex-col border-b border-white/10 bg-black/10 px-5 py-5 lg:min-h-screen lg:w-24 lg:border-b-0 lg:border-r lg:px-4 lg:py-7">
                    <div class="flex items-center justify-between lg:flex-col lg:gap-12">
                        <a href="{{ route('showcase') }}" class="group flex items-center gap-3 lg:flex-col">
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#c6f36b] text-sm font-black tracking-[-0.12em] text-[#10200f] shadow-[0_0_34px_rgba(198,243,107,0.18)] transition group-hover:rotate-6">PX</span>
                            <span class="hidden text-[0.55rem] font-bold uppercase tracking-[0.3em] text-white/45 lg:block">Pennant</span>
                        </a>
                        <div class="flex items-center gap-2 text-[0.6rem] font-bold uppercase tracking-[0.25em] text-white/45 lg:flex-col">
                            <span class="h-2 w-2 rounded-full bg-[#c6f36b] shadow-[0_0_12px_#c6f36b]"></span>
                            <span class="lg:[writing-mode:vertical-rl]">Live system</span>
                        </div>
                    </div>
                    <nav class="mt-7 hidden flex-1 flex-col items-center gap-7 lg:flex">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#c6f36b]/35 bg-[#c6f36b]/10 text-[#c6f36b]" title="Observatory"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 19V9m5 10V5m6 14v-7m5 7V3" stroke-linecap="round"/></svg></span>
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl text-white/35" title="Signals"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 18h16M6 15l3-4 3 2 5-7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl text-white/35" title="Scopes"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="3"/></svg></span>
                    </nav>
                    <div class="hidden flex-col items-center gap-3 lg:flex"><span class="h-px w-8 bg-white/10"></span><span class="text-[0.55rem] font-bold uppercase tracking-[0.3em] text-white/25 [writing-mode:vertical-rl]">v1.26</span></div>
                </aside>

                <main class="min-w-0 flex-1 px-5 py-6 sm:px-8 lg:px-10 lg:py-8">
                    <header class="flex flex-col gap-6 border-b border-white/10 pb-7 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <div class="flex items-center gap-3 text-[0.65rem] font-bold uppercase tracking-[0.3em] text-[#c6f36b]"><span>01 / Observatory</span><span class="h-px w-8 bg-[#c6f36b]/50"></span><span class="text-white/35">Feature flight</span></div>
                            <h1 class="mt-5 max-w-3xl text-4xl font-semibold leading-[0.98] tracking-[-0.06em] text-white sm:text-6xl lg:text-7xl">Ship the code.<br><span class="text-[#c6f36b]">Control the moment.</span></h1>
                        </div>
                        <div class="flex items-center gap-4 sm:pb-1"><div class="text-right"><p class="text-[0.6rem] font-bold uppercase tracking-[0.28em] text-white/35">Last sync</p><p class="mt-1 font-mono text-sm text-white/75">{{ now()->format('H:i:s') }} UTC</p></div><span class="flex h-10 w-10 items-center justify-center rounded-full border border-[#c6f36b]/25 bg-[#c6f36b]/10"><span class="h-2 w-2 rounded-full bg-[#c6f36b] shadow-[0_0_14px_#c6f36b]"></span></span></div>
                    </header>

                    @if (session('status'))
                        <div class="mt-6 flex items-center gap-3 border border-[#c6f36b]/25 bg-[#c6f36b]/10 px-4 py-3 text-sm text-[#dff7b2]"><span class="h-2 w-2 rounded-full bg-[#c6f36b]"></span>{{ session('status') }}</div>
                    @endif

                    <div class="mt-8 grid gap-8 xl:grid-cols-[minmax(0,1fr)_19rem]">
                        <div class="min-w-0">
                            <section class="relative overflow-hidden border border-white/12 bg-[#101d19] p-5 sm:p-7 lg:p-9">
                                <div class="absolute right-0 top-0 h-64 w-64 rounded-full bg-[#c6f36b]/10 blur-3xl"></div>
                                <div class="relative flex flex-col gap-10 lg:flex-row lg:items-end lg:justify-between">
                                    <div class="max-w-2xl">
                                        <div class="flex flex-wrap items-center gap-3"><span class="border border-white/15 px-3 py-1.5 text-[0.6rem] font-bold uppercase tracking-[0.25em] text-white/55">Resolved experience</span><span @class(['px-3 py-1.5 text-[0.6rem] font-bold uppercase tracking-[0.25em]', 'bg-[#c6f36b] text-[#10200f]' => ! $emergencyBrake, 'bg-[#ff735f] text-[#260b08]' => $emergencyBrake])>{{ $emergencyBrake ? 'Brake engaged' : 'Nominal' }}</span></div>
                                        <h2 class="mt-8 text-3xl font-semibold leading-[1.05] tracking-[-0.045em] text-white sm:text-5xl">{{ $priorityNavigation ? 'Priority navigation is live.' : 'Priority navigation is held back.' }}</h2>
                                        <p class="mt-5 max-w-xl text-sm leading-7 text-white/55 sm:text-base">{{ $priorityNavigation ? 'The selected scope has crossed the threshold and is seeing the new experience.' : 'The selected scope is protected by a conservative rollout while the release earns more signal.' }}</p>
                                    </div>
                                    <div class="relative shrink-0 border-l border-white/10 pl-5 lg:w-40"><p class="text-[0.6rem] font-bold uppercase tracking-[0.28em] text-white/35">Active wave</p><p class="mt-2 text-4xl font-semibold tracking-[-0.06em] text-[#c6f36b]">{{ $launchStage->exposure() }}</p><p class="mt-2 text-xs leading-5 text-white/45">{{ $launchStage->monitorFocus() }}</p></div>
                                </div>
                                <div class="relative mt-12 border-t border-white/10 pt-5"><div class="flex items-center justify-between text-[0.6rem] font-bold uppercase tracking-[0.25em] text-white/35"><span>Release confidence</span><span>{{ $launchStage->label() }}</span></div><div class="mt-4 grid grid-cols-12 gap-1.5">@for ($index = 1; $index <= 12; $index++)<span @class(['h-2', 'bg-[#c6f36b]' => $index <= match ($launchStage->value) { 'steady' => 3, 'canary' => 7, 'wide' => 12 }, 'bg-white/10' => $index > match ($launchStage->value) { 'steady' => 3, 'canary' => 7, 'wide' => 12 }])></span>@endfor</div></div>
                            </section>

                            <section class="mt-8"><div class="flex items-end justify-between gap-4"><div><p class="text-[0.65rem] font-bold uppercase tracking-[0.3em] text-white/35">Scope matrix</p><h2 class="mt-2 text-2xl font-semibold tracking-[-0.04em] text-white">Who sees what?</h2></div><p class="hidden text-right text-xs leading-5 text-white/35 sm:block">Select a scope<br>to inspect the flight.</p></div>
                                <div class="mt-5 divide-y divide-white/10 border-y border-white/10">
                                    @foreach ($audiences as $candidate)
                                        <a href="{{ route('showcase', ['audience' => $candidate->value]) }}" class="group grid gap-4 py-5 transition hover:bg-white/[0.025] sm:grid-cols-[minmax(10rem,0.8fr)_minmax(0,1.4fr)_auto] sm:items-center sm:px-4"><div class="flex items-center gap-3"><span @class(['h-2 w-2 rounded-full', 'bg-[#c6f36b] shadow-[0_0_10px_#c6f36b]' => $candidate === $audience, 'bg-white/20' => $candidate !== $audience])></span><span class="font-semibold text-white">{{ $candidate->label() }}</span>@if ($candidate === $audience)<span class="text-[0.55rem] font-bold uppercase tracking-[0.2em] text-[#c6f36b]">Viewing</span>@endif</div><p class="text-sm leading-6 text-white/40">{{ $candidate->description() }}</p><span class="text-lg text-white/25 transition group-hover:translate-x-1 group-hover:text-[#c6f36b]">&rarr;</span></a>
                                    @endforeach
                                </div>
                            </section>

                            <section class="mt-8 grid gap-px border border-white/10 bg-white/10 sm:grid-cols-3"><div class="bg-[#0d1916] p-5"><p class="text-[0.6rem] font-bold uppercase tracking-[0.25em] text-white/35">Visual mode</p><p class="mt-3 text-lg font-semibold text-white">{{ $showcaseTheme->label() }}</p><p class="mt-2 text-xs leading-5 text-white/40">{{ $showcaseTheme->description() }}</p></div><div class="bg-[#0d1916] p-5"><p class="text-[0.6rem] font-bold uppercase tracking-[0.25em] text-white/35">Operator layer</p><p class="mt-3 text-lg font-semibold text-white">{{ $operatorConsole ? 'Visible' : 'Hidden' }}</p><p class="mt-2 text-xs leading-5 text-white/40">Global flag, shared across every scope.</p></div><div class="bg-[#0d1916] p-5"><p class="text-[0.6rem] font-bold uppercase tracking-[0.25em] text-white/35">Recovery path</p><p class="mt-3 text-lg font-semibold {{ $emergencyBrake ? 'text-[#ff735f]' : 'text-white' }}">{{ $emergencyBrake ? 'Intercepting' : 'Standing by' }}</p><p class="mt-2 text-xs leading-5 text-white/40">In-memory override, no history lost.</p></div></section>
                        </div>

                        <aside class="min-w-0 xl:sticky xl:top-8 xl:self-start">
                            <div class="border border-white/12 bg-[#dce9c4] p-5 text-[#10200f] sm:p-6"><div class="flex items-start justify-between gap-4"><div><p class="text-[0.6rem] font-bold uppercase tracking-[0.28em] text-[#48603b]">Operator deck</p><h2 class="mt-3 text-2xl font-semibold tracking-[-0.05em]">Change the flight.</h2></div><span class="font-mono text-xs text-[#48603b]">LIVE</span></div>
                                <div class="mt-8 space-y-8">
                                    <form method="POST" action="{{ route('controls.update') }}">@csrf<input type="hidden" name="feature" value="launch_mode"><div class="flex items-baseline justify-between gap-3"><label class="text-sm font-semibold">Release wave</label><span class="font-mono text-xs text-[#48603b]">{{ $launchStage->exposure() }} exposed</span></div><div class="mt-3 grid gap-2">@foreach (\App\Enums\LaunchStage::cases() as $stage)<button type="submit" name="value" value="{{ $stage->value }}" @class(['flex items-center justify-between border px-3 py-3 text-left text-sm transition', 'border-[#10200f] bg-[#10200f] text-[#dff7b2]' => $launchStage === $stage, 'border-[#a9bc91] bg-transparent text-[#294224] hover:border-[#10200f]' => $launchStage !== $stage])><span class="font-semibold">{{ $stage->label() }}</span><span class="font-mono text-xs opacity-65">{{ $stage->exposure() }}</span></button>@endforeach</div></form>
                                    <form method="POST" action="{{ route('controls.update') }}" class="border-t border-[#a9bc91] pt-6">@csrf<input type="hidden" name="feature" value="operator_console"><div class="flex items-center justify-between gap-3"><div><label class="text-sm font-semibold">Operator layer</label><p class="mt-1 text-xs text-[#48603b]">Reveal system detail</p></div><span class="font-mono text-xs text-[#48603b]">{{ $operatorConsole ? 'ON' : 'OFF' }}</span></div><div class="mt-3 grid grid-cols-2 gap-2"><button type="submit" name="state" value="on" class="bg-[#10200f] px-3 py-2.5 text-xs font-bold uppercase tracking-[0.15em] text-[#dff7b2]">Enable</button><button type="submit" name="state" value="off" class="border border-[#a9bc91] px-3 py-2.5 text-xs font-bold uppercase tracking-[0.15em] text-[#294224]">Disable</button></div></form>
                                    <form method="POST" action="{{ route('controls.update') }}" class="border-t border-[#a9bc91] pt-6">@csrf<input type="hidden" name="feature" value="emergency_brake"><div class="flex items-center justify-between gap-3"><div><label class="text-sm font-semibold">Emergency brake</label><p class="mt-1 text-xs text-[#48603b]">Force recovery skin</p></div><span class="font-mono text-xs {{ $emergencyBrake ? 'text-[#c03f32]' : 'text-[#48603b]' }}">{{ $emergencyBrake ? 'ARMED' : 'IDLE' }}</span></div><div class="mt-3 grid grid-cols-2 gap-2"><button type="submit" name="state" value="on" class="bg-[#e35d4d] px-3 py-2.5 text-xs font-bold uppercase tracking-[0.15em] text-[#260b08]">Engage</button><button type="submit" name="state" value="off" class="border border-[#a9bc91] px-3 py-2.5 text-xs font-bold uppercase tracking-[0.15em] text-[#294224]">Release</button></div></form>
                                </div>
                            </div>
                            <div class="mt-5 border border-white/10 bg-white/[0.035] p-5"><div class="flex items-center justify-between"><p class="text-[0.6rem] font-bold uppercase tracking-[0.28em] text-white/35">Current readout</p><span class="font-mono text-[0.65rem] text-[#c6f36b]">{{ $audience->value }}</span></div><dl class="mt-5 divide-y divide-white/10 text-sm"><div class="flex justify-between gap-4 py-3"><dt class="text-white/40">Priority nav</dt><dd class="font-medium text-white">{{ $priorityNavigation ? 'Enabled' : 'Disabled' }}</dd></div><div class="flex justify-between gap-4 py-3"><dt class="text-white/40">Theme</dt><dd class="font-medium text-white">{{ $showcaseTheme->label() }}</dd></div><div class="flex justify-between gap-4 py-3"><dt class="text-white/40">Release</dt><dd class="font-medium text-white">{{ $launchStage->label() }}</dd></div></dl></div>
                        </aside>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
