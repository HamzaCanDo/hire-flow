<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'HireFlow')</title>
    <meta name="description" content="HireFlow — discover opportunities and hire exceptional talent.">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
<header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/95 backdrop-blur">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-black tracking-tight text-slate-950">
            <span class="grid h-9 w-9 place-items-center rounded-xl bg-indigo-600 text-white">H</span> HireFlow
        </a>
        <div class="hidden items-center gap-7 md:flex">
            <a class="nav-link" href="{{ route('jobs.index') }}">Find Jobs</a>
            @auth
                <a class="nav-link" href="{{ route(auth()->user()->role === 'employer' ? 'employer.dashboard' : 'candidate.dashboard') }}">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-bold">Log out</button></form>
            @else
                <a class="nav-link" href="{{ route('login') }}">Log in</a>
                <a class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-indigo-200" href="{{ route('register') }}">Get started</a>
            @endauth
        </div>
    </nav>
</header>
@if(session('success'))
    <div class="mx-auto mt-5 max-w-7xl px-5"><div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">{{ session('success') }}</div></div>
@endif
@yield('content')
<footer class="mt-20 border-t border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-5 py-10 text-sm text-slate-500">
        <div class="flex flex-wrap justify-between gap-4"><p>© {{ date('Y') }} HireFlow</p><p>Connect talent with opportunity.</p></div>
    </div>
</footer>
</body>
</html>
