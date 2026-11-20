@extends('layouts.app')
@section('title','Log in — HireFlow')
@section('content')
<main class="mx-auto max-w-md px-5 py-16"><div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-xl"><h1 class="text-3xl font-black">Welcome back</h1><p class="mt-2 text-slate-500">Log in to manage your applications.</p>
<form method="POST" action="{{ route('login') }}" class="mt-7 space-y-5">@csrf
<div><label class="text-sm font-bold">Email</label><input name="email" type="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-xl border-slate-200"></div>
<div><label class="text-sm font-bold">Password</label><input name="password" type="password" required class="mt-2 w-full rounded-xl border-slate-200"></div>
@if($errors->any())<div class="rounded-xl bg-red-50 p-3 text-sm text-red-700">{{ $errors->first() }}</div>@endif
<button class="w-full rounded-xl bg-indigo-600 px-5 py-3 font-bold text-white">Log in</button></form><p class="mt-6 text-center text-sm text-slate-500">New to HireFlow? <a class="font-bold text-indigo-600" href="{{ route('register') }}">Create account</a></p></div></main>
@endsection
