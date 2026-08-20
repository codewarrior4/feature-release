<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} | Feature Flight</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[radial-gradient(circle_at_top,_#1c4a64,_#071018_52%,_#02050a)] text-white">
        <div class="relative overflow-hidden">
            <div class="absolute inset-x-0 top-0 h-[32rem] bg-[radial-gradient(circle_at_20%_10%,rgba(102,196,255,0.22),transparent_35%),radial-gradient(circle_at_80%_0%,rgba(255,142,82,0.18),transparent_32%)]"></div>
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:3.5rem_3.5rem] [mask-image:linear-gradient(to_bottom,rgba(0,0,0,0.6),transparent_92%)]"></div>

            <main class="relative mx-auto flex min-h-screen w-full max-w-7xl flex-col gap-10 px-6 py-8 sm:px-8 lg:px-12">
                <header class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-2xl space-y-4">
                        <p class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/6 px-4 py-1 text-xs font-medium uppercase tracking-[0.28em] text-cyan-100/80">
                            <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                            Feature Flight
                        </p>
                        <div class="space-y-3">
                            <h1 class="max-w-3xl text-4xl font-semibold tracking-tight text-white sm:text-5xl lg:text-6xl">
                                A Laravel Pennant showcase built like a launch console.
                            </h1>
                            <p class="max-w-2xl text-base leading-7 text-slate-200/80 sm:text-lg">
                                Deployment is code shipping. Release is exposure control. This demo makes modern Pennant features visible through audience targeting, global controls, rich values, and an emergency brake.
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-3 lg:w-[30rem]">
                        <article class="rounded-3xl border border-white/10 bg-white/6 p-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.22em] text-slate-300/70">Audience</p>
                            <p class="mt-3 text-lg font-semibold">{{ $audience->label() }}</p>
                            <p class="mt-2 text-sm leading-6 text-slate-300/75">{{ $audience->description() }}</p>
                        </article>
                        <article class="rounded-3xl border border-white/10 bg-white/6 p-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.22em] text-slate-300/70">Theme</p>
                            <p class="mt-3 text-lg font-semibold">{{ $showcaseTheme->label() }}</p>
                            <p class="mt-2 text-sm leading-6 text-slate-300/75">{{ $showcaseTheme->description() }}</p>
                        </article>
                        <article class="rounded-3xl border border-white/10 bg-white/6 p-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.22em] text-slate-300/70">Launch</p>
                            <p class="mt-3 text-lg font-semibold">{{ $launchStage->label() }}</p>
                            <p class="mt-2 text-sm leading-6 text-slate-300/75">{{ $launchStage->description() }}</p>
                        </article>
                    </div>
                </header>

                @if (session('status'))
                    <div class="rounded-2xl border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                <section class="grid gap-8 lg:grid-cols-[1.25fr_0.75fr]">
                    <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-slate-950/55 shadow-2xl shadow-cyan-950/30 backdrop-blur">
                        <div class="border-b border-white/10 px-6 py-5 sm:px-8">
                            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-cyan-100/65">Live Surface</p>
                                    <h2 class="text-2xl font-semibold tracking-tight sm:text-3xl">
                                        {{ $priorityNavigation ? 'Priority navigation is live for this audience.' : 'Priority navigation is still gated for this audience.' }}
                                    </h2>
                                    <p class="max-w-2xl text-sm leading-6 text-slate-300/75">
                                        The current experience is being resolved with <span class="font-mono text-cyan-100">Feature::for($audience)->values(...)</span> while global controls are resolved through <span class="font-mono text-cyan-100">Feature::globally()</span>.
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span @class([
                                        'rounded-full px-3 py-1 text-xs font-medium uppercase tracking-[0.24em]',
                                        'bg-emerald-400/15 text-emerald-200' => ! $emergencyBrake,
                                        'bg-rose-400/15 text-rose-200' => $emergencyBrake,
                                    ])>
                                        {{ $emergencyBrake ? 'Emergency Brake' : 'Healthy Rollout' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="grid gap-6 px-6 py-6 sm:px-8 lg:grid-cols-[1.1fr_0.9fr]">
                            <div class="space-y-6">
                                <div @class([
                                    'rounded-[1.75rem] border p-6 transition duration-500',
                                    'border-cyan-300/20 bg-cyan-400/10' => $showcaseTheme->value === 'signal',
                                    'border-fuchsia-300/20 bg-fuchsia-400/10' => $showcaseTheme->value === 'immersive',
                                    'border-amber-300/20 bg-amber-400/10' => $showcaseTheme->value === 'control',
                                    'border-rose-300/20 bg-rose-400/10' => $showcaseTheme->value === 'recovery',
                                ])>
                                    <p class="text-sm uppercase tracking-[0.24em] text-white/60">Resolved Experience</p>
                                    <h3 class="mt-4 text-3xl font-semibold tracking-tight">{{ $showcaseTheme->label() }}</h3>
                                    <p class="mt-3 max-w-xl text-sm leading-7 text-slate-100/80">
                                        {{ $showcaseTheme->description() }}
                                    </p>

                                    <div class="mt-8 grid gap-3 sm:grid-cols-2">
                                        <article class="rounded-2xl border border-white/10 bg-black/20 p-4">
                                            <p class="text-xs uppercase tracking-[0.22em] text-slate-300/70">Scoped flag</p>
                                            <p class="mt-3 text-lg font-semibold">
                                                {{ $priorityNavigation ? 'Enabled' : 'Disabled' }}
                                            </p>
                                            <p class="mt-2 text-sm text-slate-300/70">`PriorityNavigation` changes per audience and can be intercepted in-memory.</p>
                                        </article>
                                        <article class="rounded-2xl border border-white/10 bg-black/20 p-4">
                                            <p class="text-xs uppercase tracking-[0.22em] text-slate-300/70">Global stage</p>
                                            <p class="mt-3 text-lg font-semibold">{{ $launchStage->label() }}</p>
                                            <p class="mt-2 text-sm text-slate-300/70">`LaunchMode` is a rich-value feature stored globally with enum support.</p>
                                        </article>
                                    </div>
                                </div>

                                <div class="grid gap-4 sm:grid-cols-3">
                                    @foreach ($audiences as $candidate)
                                        <a
                                            href="{{ route('showcase', ['audience' => $candidate->value]) }}"
                                            @class([
                                                'rounded-2xl border px-4 py-4 transition',
                                                'border-white/10 bg-white/6 hover:bg-white/10' => $candidate !== $audience,
                                                'border-cyan-300/35 bg-cyan-400/12 shadow-lg shadow-cyan-950/40' => $candidate === $audience,
                                            ])
                                        >
                                            <p class="text-xs uppercase tracking-[0.22em] text-slate-300/70">Audience</p>
                                            <p class="mt-3 text-base font-semibold">{{ $candidate->label() }}</p>
                                            <p class="mt-2 text-sm leading-6 text-slate-300/70">{{ $candidate->description() }}</p>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <div class="space-y-4">
                                <article class="rounded-[1.75rem] border border-white/10 bg-white/6 p-5">
                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-300/70">Pennant notes</p>
                                    <div class="mt-4 space-y-3 text-sm leading-7 text-slate-200/80">
                                        <p>Scoped features are keyed against the selected audience enum, so the demo stays deterministic and easy to reason about.</p>
                                        <p>The emergency brake uses a class-based feature <span class="font-mono text-cyan-100">before()</span> method to override stored values without erasing rollout history.</p>
                                        <p>Global toggles persist through Pennant’s database store, which makes the console feel like real release infrastructure.</p>
                                    </div>
                                </article>

                                <article class="rounded-[1.75rem] border border-white/10 bg-white/6 p-5">
                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-300/70">Operator console</p>
                                    <div class="mt-4 grid gap-3">
                                        <div class="rounded-2xl border border-white/10 bg-black/20 p-4">
                                            <div class="flex items-center justify-between gap-4">
                                                <div>
                                                    <p class="text-sm font-semibold">Global overlay</p>
                                                    <p class="mt-1 text-sm text-slate-300/70">Reveals extra operational copy in the hero and metrics rail.</p>
                                                </div>
                                                <span class="rounded-full bg-white/10 px-3 py-1 text-xs uppercase tracking-[0.22em] text-slate-100">
                                                    {{ $operatorConsole ? 'On' : 'Off' }}
                                                </span>
                                            </div>
                                        </div>

                                        @if ($operatorConsole)
                                            <div class="rounded-2xl border border-cyan-300/20 bg-cyan-400/10 p-4 text-sm leading-7 text-cyan-50/90">
                                                Operator overlay is active. This is the kind of global, cross-cutting flag that works cleanly with <span class="font-mono">Feature::globally()</span> in Pennant v1.25+.
                                            </div>
                                        @endif
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>

                    <aside class="space-y-5">
                        <section class="rounded-[2rem] border border-white/10 bg-slate-950/60 p-6 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.28em] text-cyan-100/65">Flight Controls</p>
                            <h2 class="mt-3 text-2xl font-semibold tracking-tight">Global release controls</h2>
                            <p class="mt-3 text-sm leading-7 text-slate-300/75">
                                These controls write directly to Pennant’s global scope so the page state changes without new code deployment.
                            </p>

                            <div class="mt-6 space-y-4">
                                <form method="POST" action="{{ route('controls.update') }}" class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    @csrf
                                    <input type="hidden" name="feature" value="launch_mode">
                                    <p class="text-sm font-semibold">Launch mode</p>
                                    <p class="mt-1 text-sm text-slate-300/70">Choose how aggressively the demo feels released.</p>
                                    <div class="mt-4 grid gap-2 sm:grid-cols-3">
                                        @foreach (\App\Enums\LaunchStage::cases() as $stage)
                                            <button
                                                type="submit"
                                                name="value"
                                                value="{{ $stage->value }}"
                                                @class([
                                                    'rounded-xl border px-3 py-3 text-sm font-medium transition',
                                                    'border-cyan-300/35 bg-cyan-400/15 text-white' => $launchStage === $stage,
                                                    'border-white/10 bg-black/20 text-slate-200 hover:bg-white/10' => $launchStage !== $stage,
                                                ])
                                            >
                                                {{ $stage->label() }}
                                            </button>
                                        @endforeach
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('controls.update') }}" class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    @csrf
                                    <input type="hidden" name="feature" value="operator_console">
                                    <p class="text-sm font-semibold">Operator console</p>
                                    <div class="mt-4 flex gap-2">
                                        <button type="submit" name="state" value="on" class="rounded-xl border border-white/10 bg-emerald-400/15 px-4 py-2 text-sm font-medium text-emerald-100">Enable</button>
                                        <button type="submit" name="state" value="off" class="rounded-xl border border-white/10 bg-black/20 px-4 py-2 text-sm font-medium text-slate-200">Disable</button>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('controls.update') }}" class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    @csrf
                                    <input type="hidden" name="feature" value="emergency_brake">
                                    <p class="text-sm font-semibold">Emergency brake</p>
                                    <p class="mt-1 text-sm text-slate-300/70">Intercepts the scoped features in-memory without removing their stored values.</p>
                                    <div class="mt-4 flex gap-2">
                                        <button type="submit" name="state" value="on" class="rounded-xl border border-rose-300/20 bg-rose-400/15 px-4 py-2 text-sm font-medium text-rose-100">Activate</button>
                                        <button type="submit" name="state" value="off" class="rounded-xl border border-white/10 bg-black/20 px-4 py-2 text-sm font-medium text-slate-200">Release</button>
                                    </div>
                                </form>
                            </div>
                        </section>

                        <section class="rounded-[2rem] border border-white/10 bg-slate-950/60 p-6 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.28em] text-cyan-100/65">Resolved State</p>
                            <div class="mt-5 grid gap-3">
                                <article class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    <p class="text-xs uppercase tracking-[0.22em] text-slate-300/70">Priority navigation</p>
                                    <p class="mt-2 text-lg font-semibold">{{ $priorityNavigation ? 'Enabled' : 'Disabled' }}</p>
                                </article>
                                <article class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    <p class="text-xs uppercase tracking-[0.22em] text-slate-300/70">Launch mode</p>
                                    <p class="mt-2 text-lg font-semibold">{{ $launchStage->label() }}</p>
                                </article>
                                <article class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    <p class="text-xs uppercase tracking-[0.22em] text-slate-300/70">Emergency brake</p>
                                    <p class="mt-2 text-lg font-semibold">{{ $emergencyBrake ? 'Active' : 'Idle' }}</p>
                                </article>
                            </div>
                        </section>
                    </aside>
                </section>
            </main>
        </div>
    </body>
</html>
