@extends('layouts.app')
@section('title',$job->title.' — HireFlow')
@section('content')
<main class="mx-auto max-w-7xl px-5 py-12">
    <a href="{{ route('jobs.index') }}" class="text-sm font-bold text-slate-500">← Back to jobs</a>
    <div class="mt-6 grid gap-8 lg:grid-cols-[1fr_340px]">
        <article class="rounded-3xl border border-slate-200 bg-white p-7 sm:p-10">
            <div class="flex items-start justify-between gap-5"><div><p class="font-bold text-indigo-600">{{ $job->company->name }}</p><h1 class="mt-2 text-4xl font-black">{{ $job->title }}</h1><p class="mt-4 text-slate-500">{{ $job->location }} · {{ $job->type }} · {{ $job->level }}</p></div><span class="rounded-xl bg-indigo-50 px-4 py-2 text-sm font-bold text-indigo-600">{{ $job->category }}</span></div>
            <div class="mt-10 space-y-8"><section><h2 class="text-xl font-black">About the role</h2><div class="prose mt-3 whitespace-pre-line text-slate-600">{{ $job->description }}</div></section><section><h2 class="text-xl font-black">Requirements</h2><div class="prose mt-3 whitespace-pre-line text-slate-600">{{ $job->requirements }}</div></section>@if($job->benefits)<section><h2 class="text-xl font-black">Benefits</h2><div class="mt-3 whitespace-pre-line text-slate-600">{{ $job->benefits }}</div></section>@endif</div>
        </article>
        <aside class="h-fit rounded-3xl border border-slate-200 bg-white p-6">
            <h3 class="font-black">Job overview</h3>
            <dl class="mt-5 space-y-4 text-sm"><div class="flex justify-between"><dt class="text-slate-500">Type</dt><dd class="font-bold">{{ $job->type }}</dd></div><div class="flex justify-between"><dt class="text-slate-500">Experience</dt><dd class="font-bold">{{ $job->level }}</dd></div><div class="flex justify-between"><dt class="text-slate-500">Salary</dt><dd class="font-bold">{{ $job->salary_min ? '$'.number_format($job->salary_min).($job->salary_max ? '–$'.number_format($job->salary_max) : '') : 'Negotiable' }}</dd></div></dl>
            @auth
                @if(auth()->user()->role === 'candidate')
                <form method="POST" action="{{ route('jobs.apply',$job) }}" enctype="multipart/form-data" class="mt-6">@csrf<textarea name="cover_letter" rows="4" placeholder="Short cover letter" class="w-full rounded-xl border-slate-200"></textarea><input name="resume" type="file" accept=".pdf,.doc,.docx" class="mt-3 block w-full text-sm"><button class="mt-4 w-full rounded-xl bg-indigo-600 px-5 py-3 font-bold text-white">Apply now</button></form>
                @else<a href="{{ route('employer.dashboard') }}" class="mt-6 block rounded-xl bg-slate-100 px-5 py-3 text-center font-bold">Employer account</a>
                @endif
            @else<a href="{{ route('login') }}" class="mt-6 block rounded-xl bg-indigo-600 px-5 py-3 text-center font-bold text-white">Log in to apply</a>@endauth
        </aside>
    </div>
</main>
@endsection
