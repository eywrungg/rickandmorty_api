@extends('layouts.app')

@section('title', 'Explore the Multiverse')

@section('content')
<section class="relative isolate overflow-hidden border-b border-[#01b4c6]/16 bg-[#10212b]">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_20%_18%,rgba(151,206,76,.2),transparent_28%),radial-gradient(circle_at_82%_10%,rgba(1,180,198,.16),transparent_30%),linear-gradient(135deg,#10212b_0%,#17313f_48%,#0a171e_100%)]"></div>
    <div class="absolute left-1/2 top-10 -z-10 h-[28rem] w-[28rem] -translate-x-1/2 rounded-full border border-[#97ce4c]/14 opacity-50"></div>

    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-[minmax(0,1fr)_520px] lg:items-center lg:px-8 lg:py-20">
        <div class="max-w-3xl">
            <h1 class="max-w-4xl font-display text-5xl font-extrabold leading-[0.95] tracking-[-0.05em] text-white sm:text-6xl lg:text-7xl">
                Explore the multiverse without losing the signal.
            </h1>

            <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                Browse characters, scan episodes, and keep favorites in a clean Laravel portal powered by the Rick and Morty API.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex min-h-12 items-center justify-center gap-3 rounded-lg bg-[#97ce4c] px-6 text-base font-extrabold text-[#10212b] shadow-[0_0_34px_rgba(151,206,76,.28)] transition hover:-translate-y-0.5 hover:bg-[#fff874]">
                        Open Dashboard
                        <x-ui.icon name="arrow-right" class="h-5 w-5" />
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex min-h-12 items-center justify-center gap-3 rounded-lg bg-[#97ce4c] px-6 text-base font-extrabold text-[#10212b] shadow-[0_0_34px_rgba(151,206,76,.28)] transition hover:-translate-y-0.5 hover:bg-[#fff874]">
                        Start Exploring
                        <x-ui.icon name="arrow-right" class="h-5 w-5" />
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex min-h-12 items-center justify-center rounded-lg border border-white/10 bg-white/[0.05] px-6 text-base font-bold text-white transition hover:border-[#01b4c6]/45 hover:bg-[#01b4c6]/12">
                        Login
                    </a>
                @endauth
            </div>

            <dl class="mt-10 grid max-w-xl grid-cols-2 gap-3 sm:grid-cols-4">
                <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <dt class="font-mono text-[0.65rem] uppercase tracking-[0.18em] text-slate-500">Characters</dt>
                    <dd class="mt-1 font-display text-2xl font-extrabold text-white">826+</dd>
                </div>
                <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <dt class="font-mono text-[0.65rem] uppercase tracking-[0.18em] text-slate-500">Episodes</dt>
                    <dd class="mt-1 font-display text-2xl font-extrabold text-white">51</dd>
                </div>
                <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <dt class="font-mono text-[0.65rem] uppercase tracking-[0.18em] text-slate-500">Locations</dt>
                    <dd class="mt-1 font-display text-2xl font-extrabold text-white">126</dd>
                </div>
                <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                    <dt class="font-mono text-[0.65rem] uppercase tracking-[0.18em] text-slate-500">Stack</dt>
                    <dd class="mt-1 font-display text-2xl font-extrabold text-white">API</dd>
                </div>
            </dl>
        </div>

        <div class="relative">
            <div class="absolute -inset-4 -z-10 rounded-[2rem] bg-[#97ce4c]/12 blur-3xl"></div>
            <div class="grid grid-cols-2 gap-3 sm:gap-4">
                <article class="col-span-2 overflow-hidden rounded-xl border border-white/10 bg-white/[0.06] shadow-2xl">
                    <img src="https://rickandmortyapi.com/api/character/avatar/1.jpeg" alt="Rick Sanchez" class="h-64 w-full object-cover object-top sm:h-72">
                    <div class="flex items-center justify-between border-t border-white/10 p-4">
                        <div>
                            <p class="font-display text-xl font-extrabold text-white">Rick Sanchez</p>
                            <p class="text-sm text-slate-400">Human · Earth C-137</p>
                        </div>
                        <span class="rounded-full border border-[#97ce4c]/35 bg-[#97ce4c]/14 px-3 py-1 font-mono text-xs font-semibold uppercase tracking-[0.15em] text-[#fff874]">Alive</span>
                    </div>
                </article>

                <article class="overflow-hidden rounded-xl border border-white/10 bg-white/[0.05]">
                    <img src="https://rickandmortyapi.com/api/character/avatar/2.jpeg" alt="Morty Smith" class="aspect-square w-full object-cover">
                    <div class="p-3">
                        <p class="font-bold text-white">Morty Smith</p>
                        <p class="text-sm text-slate-400">Sidekick signal</p>
                    </div>
                </article>

                <article class="overflow-hidden rounded-xl border border-white/10 bg-white/[0.05]">
                    <img src="https://rickandmortyapi.com/api/character/avatar/3.jpeg" alt="Summer Smith" class="aspect-square w-full object-cover">
                    <div class="p-3">
                        <p class="font-bold text-white">Summer Smith</p>
                        <p class="text-sm text-slate-400">Family archive</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto grid max-w-7xl gap-4 px-4 py-10 sm:px-6 md:grid-cols-3 lg:px-8">
    <a href="{{ route('characters.index') }}" class="group rounded-xl border border-white/10 bg-white/[0.04] p-5 transition hover:-translate-y-1 hover:border-[#97ce4c]/40 hover:bg-[#97ce4c]/12">
        <div class="mb-8 flex items-center justify-between text-[#fff874]">
            <x-ui.icon name="dossier" class="h-6 w-6" />
            <x-ui.icon name="arrow-right" class="h-5 w-5 transition group-hover:translate-x-1" />
        </div>
        <h2 class="font-display text-2xl font-extrabold text-white">Characters</h2>
        <p class="mt-2 text-sm leading-6 text-slate-400">Search the cast, open detailed records, and save the ones you want to revisit.</p>
    </a>

    <a href="{{ route('episodes.index') }}" class="group rounded-xl border border-white/10 bg-white/[0.04] p-5 transition hover:-translate-y-1 hover:border-[#01b4c6]/40 hover:bg-[#01b4c6]/12">
        <div class="mb-8 flex items-center justify-between text-[#01b4c6]">
            <x-ui.icon name="archive" class="h-6 w-6" />
            <x-ui.icon name="arrow-right" class="h-5 w-5 transition group-hover:translate-x-1" />
        </div>
        <h2 class="font-display text-2xl font-extrabold text-white">Episodes</h2>
        <p class="mt-2 text-sm leading-6 text-slate-400">Filter by title, season, or episode number and inspect the cast per episode.</p>
    </a>

    <a href="{{ route('favorites.index') }}" class="group rounded-xl border border-white/10 bg-white/[0.04] p-5 transition hover:-translate-y-1 hover:border-[#fff874]/35 hover:bg-[#fff874]/10">
        <div class="mb-8 flex items-center justify-between text-[#fff874]">
            <x-ui.icon name="favorite" class="h-6 w-6" />
            <x-ui.icon name="arrow-right" class="h-5 w-5 transition group-hover:translate-x-1" />
        </div>
        <h2 class="font-display text-2xl font-extrabold text-white">Favorites</h2>
        <p class="mt-2 text-sm leading-6 text-slate-400">Build a personal shortlist after logging in, stored against your account.</p>
    </a>
</section>
@endsection
