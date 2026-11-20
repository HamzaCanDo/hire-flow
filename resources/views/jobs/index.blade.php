@extends('layouts.app')
@section('title','Browse Jobs — HireFlow')
@section('content')
<main class="mx-auto max-w-7xl px-5 py-12">
    <div class="rounded-3xl bg-slate-950 px-7 py-10 text-white"><h1 class="text-4xl font-black">Find your next opportunity</h1><form class="mt-7 grid gap-3 md:grid-cols-[1fr_.7fr_.5fr_auto]">
        <input name="q" value="{{ request('q') }}" placeholder="Job title or keyword" class="rounded-xl border-0 px-4 py-3 text-slate-900"><input name="location" value="{{ request('location') }}" placeholder="Location" class="rounded-xl border-0 px-4 py-3 text-slate-900">
        <select name="type" class="rounded-xl border-0 px-4 py-3 text-slate-900"><option value="">All types</option>@foreach(['Full-time','Part-time','Contract','Internship','Remote'] as $type)<option @selected(request('type')==$type)>{{ $type }}</option>@endforeach</select><button class="rounded-xl bg-indigo-600 px-6 py-3 font-bold">Search</button>
    </form></div>
    <div class="mt-10 grid gap-8 lg:grid-cols-[1fr_260px]">
        <div class="space-y-4">@forelse($jobs as $job)<a href="{{ route('jobs.show',$job) }}" class="block rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-indigo-200 hover:shadow-lg"><div class="flex justify-between gap-4"><div><p class="text-sm font-bold text-indigo-600">{{ $job->company->name }}</p><h2 class="mt-1 text-xl font-black">{{ $job->title }}</h2><p class="mt-3 text-sm text-slate-500">{{ $job->location }} · {{ $job->level }}</p></div><span class="h-fit rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-bold">{{ $job->type }}</span></div></a>@empty<div class="rounded-2xl border border-dashed border-slate-300 p-10 text-center text-slate-500">No matching jobs found.</div>@endforelse
        <div>{{ $jobs->links() }}</div></div>
        <aside class="h-fit rounded-2xl border border-slate-200 bg-white p-5"><h3 class="font-black">Categories</h3><div class="mt-4 space-y-3">@foreach($categories as $category)<div class="flex justify-between text-sm"><span>{{ $category->category }}</span><span class="rounded-full bg-slate-100 px-2 text-slate-500">{{ $category->total }}</span></div>@endforeach</div></aside>
    </div>
</main>
@endsection
