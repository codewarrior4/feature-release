<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} | Feature Flight</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[var(--page)] text-[var(--ink)]">
        <div class="relative overflow-hidden">
            <div class="pointer-events-none absolute inset-x-0 top-0 h-[32rem] bg-[radial-gradient(circle_at_top_left,rgba(255,143,92,0.34),transparent_42%),radial-gradient(circle_at_85%_10%,rgba(38,110,255,0.18),transparent_30%)]"></div>
            <div class="pointer-events-none absolute left-[-10rem] top-[20rem] h-[24rem] w-[24rem] rounded-full bg-[rgba(255,195,123,0.28)] blur-3xl"></div>
            <div class="pointer-events-none absolute right-[-8rem] top-[38rem] h-[20rem] w-[20rem] rounded-full bg-[rgba(64,145,255,0.16)] blur-3xl"></div>

            <main class="relative mx-auto flex min-h-screen w-full max-w-7xl flex-col gap-12 px-5 py-6 sm:px-8 lg:px-10 lg:py-8">
                <header class="flex flex-col gap-5 rounded-[2rem] border border-black/8 bg-white/72 px-5 py-4 shadow-[0_20px_60px_rgba(43,33,24,0.08)] backdrop-blur sm:px-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-[var(--ink)] text-sm font-semibold tracking-[0.2em] text-white">
                                FF
                            </span>
                            <div>
                                <p class="text-[0.7rem] font-semibold uppercase tracking-[0.34em] text-[var(--muted)]">Feature Flight</p>
                                <p class="text-sm text-[var(--muted)]">Laravel Pennant release choreography</p>
                            </div>
                        </div>
                        <p class="max-w-2xl text-sm leading-7 text-[var(--muted)]">
                            A live showcase for audience-scoped flags, global release controls, rich values, and recovery behavior.
                        </p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-3 lg:min-w-[32rem]">
                        <article class="rounded-[1.4rem] bg-[var(--panel)] px-4 py-4">
                            <p class="text-[0.65rem] font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">Audience</p>
                            <p class="mt-3 text-lg font-semibold">{{ $audience->label() }}</p>
                            <p class="mt-2 text-sm leading-6 text-[var(--muted)]">{{ $audience->description() }}</p>
                        </article>
                        <article class="rounded-[1.4rem] bg-[var(--panel)] px-4 py-4">
                            <p class="text-[0.65rem] font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">Theme</p>
                            <p class="mt-3 text-lg font-semibold">{{ $showcaseTheme->label() }}</p>
                            <p class="mt-2 text-sm leading-6 text-[var(--muted)]">{{ $showcaseTheme->description() }}</p>
                        </article>
                        <article class="rounded-[1.4rem] bg-[var(--panel)] px-4 py-4">
                            <p class="text-[0.65rem] font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">Release</p>
                            <p class="mt-3 text-lg font-semibold">{{ $launchStage->label() }}</p>
                            <p class="mt-2 text-sm leading-6 text-[var(--muted)]">{{ $launchStage->description() }}</p>
                        </article>
                    </div>
                </header>

                @if (session('status'))
                    <div class="rounded-[1.5rem] border border-[rgba(24,131,89,0.18)] bg-[rgba(240,255,247,0.94)] px-5 py-4 text-sm text-[var(--ink)] shadow-[0_15px_45px_rgba(32,94,67,0.08)]">
                        {{ session('status') }}
                    </div>
                @endif

                <section class="grid gap-8 lg:grid-cols-[minmax(0,1.15fr)_22rem]">
                    <div class="space-y-8">
                        <section class="grid gap-6 lg:grid-cols-[minmax(0,1.2fr)_minmax(17rem,0.8fr)]">
                            <article class="release-hero rounded-[2.4rem] p-6 sm:p-8 lg:p-10">
                                <div class="flex flex-wrap items-center gap-3">
                                    <span class="rounded-full bg-white/18 px-4 py-2 text-[0.68rem] font-semibold uppercase tracking-[0.32em] text-white/92">
                                        Deployment is not release
                                    </span>
                                    <span @class([
                                        'rounded-full px-4 py-2 text-[0.68rem] font-semibold uppercase tracking-[0.32em]',
                                        'bg-[rgba(255,255,255,0.16)] text-white' => ! $emergencyBrake,
                                        'bg-[rgba(54,12,8,0.28)] text-[rgba(255,236,231,1)]' => $emergencyBrake,
                                    ])>
                                        {{ $emergencyBrake ? 'Recovery Mode Active' : 'Healthy Rollout' }}
                                    </span>
                                </div>

                                <div class="mt-8 grid gap-8 lg:grid-cols-[minmax(0,1fr)_14rem]">
                                    <div class="space-y-6">
                                        <h1 class="max-w-3xl text-4xl font-semibold leading-[1.02] tracking-tight text-white sm:text-5xl lg:text-[4.5rem]">
                                            {{ $priorityNavigation ? 'This audience is already inside the new experience.' : 'This audience is still watching the rollout from the safe side.' }}
                                        </h1>
                                        <p class="max-w-2xl text-base leading-8 text-white/82 sm:text-lg">
                                            Pennant is resolving the experience in real time. Scoped flags shape the surface for the selected audience, while global controls can widen the release, reveal the operator layer, or trigger a recovery override instantly.
                                        </p>
                                    </div>

                                    <div class="flex flex-col justify-between rounded-[1.8rem] bg-[rgba(255,255,255,0.11)] p-5 text-white/94 backdrop-blur">
                                        <div>
                                            <p class="text-[0.68rem] uppercase tracking-[0.28em] text-white/66">Wave size</p>
                                            <p class="mt-4 text-5xl font-semibold">{{ $launchStage->exposure() }}</p>
                                        </div>
                                        <div class="space-y-3">
                                            <div>
                                                <p class="text-[0.68rem] uppercase tracking-[0.28em] text-white/66">Watch closely</p>
                                                <p class="mt-2 text-base font-medium">{{ $launchStage->monitorFocus() }}</p>
                                            </div>
                                            <div>
                                                <p class="text-[0.68rem] uppercase tracking-[0.28em] text-white/66">Storage</p>
                                                <p class="mt-2 text-base font-medium">Pennant database store</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="rounded-[2rem] border border-black/8 bg-white/80 p-6 shadow-[0_20px_60px_rgba(43,33,24,0.08)]">
                                <p class="text-[0.7rem] font-semibold uppercase tracking-[0.34em] text-[var(--muted)]">Resolved surface</p>
                                <div class="mt-5 space-y-5">
                                    <div class="rounded-[1.6rem] bg-[var(--panel)] p-5">
                                        <p class="text-sm font-medium text-[var(--muted)]">Visual mode</p>
                                        <h2 class="mt-3 text-2xl font-semibold">{{ $showcaseTheme->label() }}</h2>
                                        <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $showcaseTheme->description() }}</p>
                                    </div>
                                    <div class="grid gap-3">
                                        <div class="rounded-[1.4rem] border border-black/8 bg-white px-4 py-4">
                                            <p class="text-[0.65rem] font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">Scoped feature</p>
                                            <p class="mt-2 text-lg font-semibold">{{ $priorityNavigation ? 'Priority navigation on' : 'Priority navigation off' }}</p>
                                        </div>
                                        <div class="rounded-[1.4rem] border border-black/8 bg-white px-4 py-4">
                                            <p class="text-[0.65rem] font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">Operator layer</p>
                                            <p class="mt-2 text-lg font-semibold">{{ $operatorConsole ? 'Visible' : 'Hidden' }}</p>
                                        </div>
                                        <div class="rounded-[1.4rem] border border-black/8 bg-white px-4 py-4">
                                            <p class="text-[0.65rem] font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">Recovery path</p>
                                            <p class="mt-2 text-lg font-semibold">{{ $emergencyBrake ? 'Intercepting in memory' : 'Standing by' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </section>

                        <section class="rounded-[2.2rem] border border-black/8 bg-white/78 p-6 shadow-[0_20px_60px_rgba(43,33,24,0.08)] sm:p-8">
                            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                                <div>
                                    <p class="text-[0.7rem] font-semibold uppercase tracking-[0.34em] text-[var(--muted)]">Audience tracks</p>
                                    <h2 class="mt-3 text-3xl font-semibold tracking-tight">Swap the viewer and watch the release posture change.</h2>
                                </div>
                                <p class="max-w-xl text-sm leading-7 text-[var(--muted)]">
                                    The selected audience acts as the Pennant scope. Each card below resolves the same feature set through a different release lens.
                                </p>
                            </div>

                            <div class="mt-8 grid gap-4 lg:grid-cols-3">
                                @foreach ($audiences as $candidate)
                                    <a
                                        href="{{ route('showcase', ['audience' => $candidate->value]) }}"
                                        @class([
                                            'group rounded-[1.9rem] border p-5 transition duration-300',
                                            'border-black/8 bg-[var(--panel)] hover:-translate-y-1 hover:shadow-[0_24px_55px_rgba(43,33,24,0.08)]' => $candidate !== $audience,
                                            'border-[rgba(216,101,55,0.28)] bg-[var(--accent-soft)] shadow-[0_24px_55px_rgba(191,98,59,0.14)]' => $candidate === $audience,
                                        ])
                                    >
                                        <div class="flex items-center justify-between gap-4">
                                            <p class="text-[0.68rem] font-semibold uppercase tracking-[0.32em] text-[var(--muted)]">Track</p>
                                            <span @class([
                                                'rounded-full px-3 py-1 text-[0.68rem] font-semibold uppercase tracking-[0.28em]',
                                                'bg-black/6 text-[var(--muted)]' => $candidate !== $audience,
                                                'bg-[var(--ink)] text-white' => $candidate === $audience,
                                            ])>
                                                {{ $candidate === $audience ? 'Active' : 'Preview' }}
                                            </span>
                                        </div>
                                        <h3 class="mt-6 text-2xl font-semibold tracking-tight">{{ $candidate->label() }}</h3>
                                        <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $candidate->description() }}</p>
                                        <div class="mt-8 flex items-end justify-between gap-4">
                                            <div>
                                                <p class="text-[0.68rem] uppercase tracking-[0.28em] text-[var(--muted)]">Expected surface</p>
                                                <p class="mt-2 text-lg font-semibold">
                                                    @if ($candidate->value === 'public')
                                                        Conservative
                                                    @elseif ($candidate->value === 'beta')
                                                        Experimental
                                                    @else
                                                        Full access
                                                    @endif
                                                </p>
                                            </div>
                                            <span class="text-2xl transition group-hover:translate-x-1">&rarr;</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </section>

                        <section class="rounded-[2.2rem] border border-black/8 bg-[var(--ink)] px-6 py-6 text-white shadow-[0_24px_70px_rgba(43,33,24,0.14)] sm:px-8 sm:py-8">
                            <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_20rem]">
                                <div>
                                    <p class="text-[0.7rem] font-semibold uppercase tracking-[0.34em] text-white/54">Release score</p>
                                    <div class="mt-5 grid gap-4 sm:grid-cols-3">
                                        <article class="rounded-[1.6rem] bg-white/8 p-4">
                                            <p class="text-[0.68rem] uppercase tracking-[0.28em] text-white/54">Current wave</p>
                                            <p class="mt-3 text-3xl font-semibold">{{ $launchStage->label() }}</p>
                                        </article>
                                        <article class="rounded-[1.6rem] bg-white/8 p-4">
                                            <p class="text-[0.68rem] uppercase tracking-[0.28em] text-white/54">Exposure</p>
                                            <p class="mt-3 text-3xl font-semibold">{{ $launchStage->exposure() }}</p>
                                        </article>
                                        <article class="rounded-[1.6rem] bg-white/8 p-4">
                                            <p class="text-[0.68rem] uppercase tracking-[0.28em] text-white/54">Primary watch</p>
                                            <p class="mt-3 text-lg font-semibold">{{ $launchStage->monitorFocus() }}</p>
                                        </article>
                                    </div>

                                    <div class="mt-8 grid gap-3">
                                        @php
                                            $timeline = [
                                                ['label' => 'Steady', 'key' => 'steady', 'copy' => 'Small blast radius, safe operator feedback loop.'],
                                                ['label' => 'Canary', 'key' => 'canary', 'copy' => 'Measured expansion once the surface proves itself.'],
                                                ['label' => 'Wide', 'key' => 'wide', 'copy' => 'The showcase has earned broad availability.'],
                                            ];
                                        @endphp
                                        @foreach ($timeline as $step)
                                            <div @class([
                                                'rounded-[1.5rem] border px-4 py-4 transition',
                                                'border-white/30 bg-white/12' => $launchStage->value === $step['key'],
                                                'border-white/10 bg-white/4' => $launchStage->value !== $step['key'],
                                            ])>
                                                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                                    <div>
                                                        <p class="text-sm font-semibold">{{ $step['label'] }}</p>
                                                        <p class="mt-1 text-sm text-white/64">{{ $step['copy'] }}</p>
                                                    </div>
                                                    <span @class([
                                                        'rounded-full px-3 py-1 text-[0.68rem] font-semibold uppercase tracking-[0.28em]',
                                                        'bg-white text-[var(--ink)]' => $launchStage->value === $step['key'],
                                                        'bg-white/10 text-white/64' => $launchStage->value !== $step['key'],
                                                    ])>
                                                        {{ $launchStage->value === $step['key'] ? 'Current' : 'Standby' }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="rounded-[1.9rem] bg-white/8 p-5">
                                    <p class="text-[0.7rem] font-semibold uppercase tracking-[0.34em] text-white/54">Pennant notes</p>
                                    <div class="mt-5 space-y-4 text-sm leading-7 text-white/76">
                                        <p>The selected audience is a serializable enum scope, so the demo stays deterministic and easy to verify.</p>
                                        <p>The emergency brake is a class-based feature with a <span class="font-mono text-white">before()</span> interception hook, which lets us override stored values without wiping rollout history.</p>
                                        <p>The launch stage is a rich-value global feature. Its enum value drives this whole band without changing any code paths.</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <aside class="lg:sticky lg:top-6 lg:self-start">
                        <section class="rounded-[2.3rem] border border-black/8 bg-white/82 p-5 shadow-[0_24px_70px_rgba(43,33,24,0.1)] backdrop-blur sm:p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-[0.7rem] font-semibold uppercase tracking-[0.34em] text-[var(--muted)]">Control column</p>
                                    <h2 class="mt-3 text-2xl font-semibold tracking-tight">Release actions</h2>
                                </div>
                                <div class="rounded-full bg-[var(--panel)] px-3 py-2 text-[0.7rem] font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">
                                    Live
                                </div>
                            </div>

                            <div class="mt-6 space-y-4">
                                <form method="POST" action="{{ route('controls.update') }}" class="rounded-[1.7rem] bg-[var(--panel)] p-4">
                                    @csrf
                                    <input type="hidden" name="feature" value="launch_mode">
                                    <p class="text-sm font-semibold">Change the release wave</p>
                                    <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Update the rich-value global feature that drives the rollout posture.</p>
                                    <div class="mt-4 grid gap-2">
                                        @foreach (\App\Enums\LaunchStage::cases() as $stage)
                                            <button
                                                type="submit"
                                                name="value"
                                                value="{{ $stage->value }}"
                                                @class([
                                                    'flex items-center justify-between rounded-[1.15rem] border px-4 py-3 text-left text-sm transition',
                                                    'border-[rgba(216,101,55,0.24)] bg-white text-[var(--ink)]' => $launchStage === $stage,
                                                    'border-black/8 bg-transparent text-[var(--ink)] hover:bg-white/70' => $launchStage !== $stage,
                                                ])
                                            >
                                                <span class="font-semibold">{{ $stage->label() }}</span>
                                                <span class="text-[var(--muted)]">{{ $stage->exposure() }}</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('controls.update') }}" class="rounded-[1.7rem] bg-[var(--panel)] p-4">
                                    @csrf
                                    <input type="hidden" name="feature" value="operator_console">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="text-sm font-semibold">Operator layer</p>
                                            <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Reveals the deeper operational narrative on the page.</p>
                                        </div>
                                        <span class="rounded-full bg-white px-3 py-1 text-[0.68rem] font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">
                                            {{ $operatorConsole ? 'On' : 'Off' }}
                                        </span>
                                    </div>
                                    <div class="mt-4 grid grid-cols-2 gap-2">
                                        <button type="submit" name="state" value="on" class="rounded-[1.1rem] bg-[var(--ink)] px-4 py-3 text-sm font-semibold text-white">Enable</button>
                                        <button type="submit" name="state" value="off" class="rounded-[1.1rem] border border-black/8 bg-white px-4 py-3 text-sm font-semibold text-[var(--ink)]">Disable</button>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('controls.update') }}" class="rounded-[1.7rem] bg-[rgba(122,43,24,0.08)] p-4">
                                    @csrf
                                    <input type="hidden" name="feature" value="emergency_brake">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="text-sm font-semibold">Emergency brake</p>
                                            <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Forces a safer surface immediately through Pennant interception.</p>
                                        </div>
                                        <span @class([
                                            'rounded-full px-3 py-1 text-[0.68rem] font-semibold uppercase tracking-[0.28em]',
                                            'bg-[rgba(139,33,3,0.12)] text-[rgb(110,30,11)]' => $emergencyBrake,
                                            'bg-white text-[var(--muted)]' => ! $emergencyBrake,
                                        ])>
                                            {{ $emergencyBrake ? 'Active' : 'Idle' }}
                                        </span>
                                    </div>
                                    <div class="mt-4 grid grid-cols-2 gap-2">
                                        <button type="submit" name="state" value="on" class="rounded-[1.1rem] bg-[rgb(110,30,11)] px-4 py-3 text-sm font-semibold text-white">Activate</button>
                                        <button type="submit" name="state" value="off" class="rounded-[1.1rem] border border-black/8 bg-white px-4 py-3 text-sm font-semibold text-[var(--ink)]">Release</button>
                                    </div>
                                </form>
                            </div>

                            <div class="mt-6 rounded-[1.7rem] border border-dashed border-black/10 px-4 py-4">
                                <p class="text-[0.68rem] font-semibold uppercase tracking-[0.3em] text-[var(--muted)]">Current readout</p>
                                <div class="mt-4 grid gap-3">
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="text-sm text-[var(--muted)]">Priority navigation</span>
                                        <span class="text-sm font-semibold">{{ $priorityNavigation ? 'Enabled' : 'Disabled' }}</span>
                                    </div>
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="text-sm text-[var(--muted)]">Theme variant</span>
                                        <span class="text-sm font-semibold">{{ $showcaseTheme->label() }}</span>
                                    </div>
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="text-sm text-[var(--muted)]">Wave size</span>
                                        <span class="text-sm font-semibold">{{ $launchStage->exposure() }}</span>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </aside>
                </section>
            </main>
        </div>
    </body>
</html>
