@extends('layouts.app')
@section('title','HireFlow — Find work that matters')
@section('content')
<main>
    <section class="overflow-hidden bg-slate-950 text-white">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-5 py-20 lg:grid-cols-[1.15fr_.85fr] lg:py-28">
            <div>
                <span class="inline-flex rounded-full border border-indigo-400/30 bg-indigo-400/10 px-4 py-2 text-sm font-bold text-indigo-300">The future of work starts here</span>
                <h1 class="mt-7 max-w-3xl text-5xl font-black leading-[1.05] tracking-tight sm:text-6xl">Find a role where you can <span class="text-indigo-400">thrive.</span></h1>
                <p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">Explore curated roles from ambitious companies and take your next career step with confidence.</p>
                <form action="{{ route('jobs.index') }}" class="mt-9 flex max-w-2xl flex-col gap-3 rounded-2xl bg-white p-3 sm:flex-row">
                    <input name="q" placeholder="Job title or keyword" class="min-w-0 flex-1 rounded-xl px-4 py-3 text-slate-900 outline-none">
                    <input name="location" placeholder="Location" class="rounded-xl border-slate-200 px-4 py-3 text-slate-900 sm:w-44">
                    <button class="rounded-xl bg-indigo-600 px-6 py-3 font-bold">Search</button>
                </form>
            </div>
            <div class="relative hidden lg:block">
                <div class="absolute -inset-10 rounded-full bg-indigo-600/20 blur-3xl"></div>
                <div class="relative grid grid-cols-2 gap-4">
                    @foreach($featured->take(4) as $job)
                    <div class="rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                        <p class="text-xs font-bold uppercase tracking-widest text-indigo-300">{{ $job->type }}</p>
                        <p class="mt-3 font-bold">{{ $job->title }}</p><p class="mt-1 text-sm text-slate-400">{{ $job->company->name }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="mx-auto max-w-7xl px-5 py-16">
        <div class="flex items-end justify-between"><div><p class="text-sm font-bold text-indigo-600">LATEST OPPORTUNITIES</p><h2 class="mt-2 text-3xl font-black">Jobs picked for you</h2></div><a class="font-bold text-indigo-600" href="{{ route('jobs.index') }}">View all jobs →</a></div>
        <div class="mt-8 grid gap-5 md:grid-cols-2">
            @forelse($latest as $job)
            <a href="{{ route('jobs.show', $job) }}" class="group rounded-2xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl">
                <div class="flex justify-between gap-4"><div><p class="text-sm font-bold text-indigo-600">{{ $job->company->name }}</p><h3 class="mt-2 text-xl font-black group-hover:text-indigo-600">{{ $job->title }}</h3></div><span class="h-fit rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-bold">{{ $job->type }}</span></div>
                <p class="mt-5 text-sm text-slate-500">{{ $job->location }} · {{ $job->level }}</p>
            </a>
            @empty
            <p class="text-slate-500">New positions are coming soon.</p>
            @endforelse
        </div>
    </section>
    @if($companies->isNotEmpty())
    <section class="border-y border-slate-200 bg-white py-14">
        <div class="mx-auto max-w-7xl px-5"><p class="text-center text-sm font-bold uppercase tracking-widest text-slate-400">Trusted companies</p><div class="mt-7 grid grid-cols-2 gap-4 md:grid-cols-4">@foreach($companies as $company)<div class="rounded-xl border border-slate-100 p-5 text-center font-black text-slate-700">{{ $company->name }}</div>@endforeach</div></div>
    </section>
    @endif
</main>
@endsection
