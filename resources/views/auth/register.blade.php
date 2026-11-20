@extends('layouts.app')
@section('title','Create account — HireFlow')
@section('content')
<main class="mx-auto max-w-md px-5 py-16"><div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-xl"><h1 class="text-3xl font-black">Create your account</h1>
<form method="POST" action="{{ route('register') }}" class="mt-7 space-y-5">@csrf
<div><label class="text-sm font-bold">Full name</label><input name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-xl border-slate-200"></div>
<div><label class="text-sm font-bold">Email</label><input name="email" type="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-xl border-slate-200"></div>
<div><label class="text-sm font-bold">I am</label><select name="role" class="mt-2 w-full rounded-xl border-slate-200"><option value="candidate">Looking for a job</option><option value="employer">Hiring talent</option></select></div>
<div><label class="text-sm font-bold">Password</label><input name="password" type="password" required class="mt-2 w-full rounded-xl border-slate-200"></div>
<div><label class="text-sm font-bold">Confirm password</label><input name="password_confirmation" type="password" required class="mt-2 w-full rounded-xl border-slate-200"></div>
@if($errors->any())<div class="rounded-xl bg-red-50 p-3 text-sm text-red-700">{{ $errors->first() }}</div>@endif
<button class="w-full rounded-xl bg-indigo-600 px-5 py-3 font-bold text-white">Create account</button></form></div></main>
@endsection
