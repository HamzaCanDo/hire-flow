@extends('layouts.app')
@section('title','Candidate Dashboard — HireFlow')
@section('content')
<main class="mx-auto max-w-7xl px-5 py-12"><p class="text-sm font-bold text-indigo-600">CANDIDATE DASHBOARD</p><h1 class="mt-2 text-4xl font-black">My applications</h1>
<div class="mt-8 space-y-4">@forelse($applications as $application)<div class="flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-6"><div><p class="font-bold text-indigo-600">{{ $application->job->company->name }}</p><a class="mt-1 block text-xl font-black" href="{{ route('jobs.show',$application->job) }}">{{ $application->job->title }}</a><p class="mt-2 text-sm text-slate-500">Applied {{ $application->created_at->diffForHumans() }}</p></div><span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-bold capitalize">{{ $application->status }}</span></div>@empty<div class="rounded-2xl border border-dashed border-slate-300 p-12 text-center"><p class="font-bold">You haven’t applied to a job yet.</p><a class="mt-4 inline-block rounded-xl bg-indigo-600 px-5 py-3 font-bold text-white" href="{{ route('jobs.index') }}">Browse jobs</a></div>@endforelse</div></main>
@endsection
