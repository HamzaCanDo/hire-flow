<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::with('company')->where('is_active', true)
            ->when($request->q, fn($q, $v) => $q->where(function ($x) use ($v) {
                $x->where('title', 'like', "%{$v}%")->orWhere('category', 'like', "%{$v}%");
            }))
            ->when($request->location, fn($q, $v) => $q->where('location', 'like', "%{$v}%"))
            ->when($request->type, fn($q, $v) => $q->where('type', $v))
            ->latest()->paginate(9)->withQueryString();
        $categories = Job::where('is_active', true)->selectRaw('category, count(*) as total')->groupBy('category')->limit(8)->get();
        return view('jobs.index', compact('jobs', 'categories'));
    }
    public function show(Job $job)
    {
        if (!$job->is_active) abort(404);
        $related = Job::with('company')->where('is_active', true)->where('category', $job->category)->whereKeyNot($job->id)->limit(3)->get();
        return view('jobs.show', compact('job', 'related'));
    }
}
