<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        abort_unless(Auth::check() && Auth::user()->role === 'candidate', 403);
        $data = $request->validate([
            'cover_letter' => 'nullable|string|max:5000',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
        if ($request->hasFile('resume')) $data['resume'] = $request->file('resume')->store('resumes', 'public');
        $data['job_posting_id'] = $job->id;
        $data['user_id'] = Auth::id();
        Application::firstOrCreate(['job_posting_id' => $job->id, 'user_id' => Auth::id()], $data);
        return back()->with('success', 'Your application has been submitted.');
    }
    public function candidateDashboard()
    {
        $applications = Application::with('job.company')->where('user_id', Auth::id())->latest()->get();
        return view('candidate.dashboard', compact('applications'));
    }
}
