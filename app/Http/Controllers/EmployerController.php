<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EmployerController extends Controller
{
    private function employerOnly() { abort_unless(Auth::check() && Auth::user()->role === 'employer', 403); }
    public function dashboard()
    {
        $this->employerOnly();
        $company = Company::where('user_id', Auth::id())->first();
        $jobs = $company ? Job::withCount('applications')->where('company_id', $company->id)->latest()->get() : collect();
        return view('employer.dashboard', compact('company', 'jobs'));
    }
    public function createCompanyForm() { $this->employerOnly(); return view('employer.company'); }
    public function storeCompany(Request $request)
    {
        $this->employerOnly();
        $data = $request->validate([
            'name' => 'required|max:255', 'website' => 'nullable|url',
            'industry' => 'required|max:255', 'location' => 'required|max:255',
            'size' => 'nullable|max:255', 'description' => 'nullable|max:5000',
            'logo' => 'nullable|image|max:2048',
        ]);
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));
        $data['user_id'] = Auth::id();
        if ($request->hasFile('logo')) $data['logo'] = $request->file('logo')->store('logos', 'public');
        Company::updateOrCreate(['user_id' => Auth::id()], $data);
        return redirect()->route('employer.dashboard')->with('success', 'Company profile saved.');
    }
    public function createJobForm()
    {
        $this->employerOnly();
        if (!Company::where('user_id', Auth::id())->exists()) return redirect()->route('employer.company');
        return view('employer.create-job');
    }
    public function storeJob(Request $request)
    {
        $this->employerOnly();
        $company = Company::where('user_id', Auth::id())->firstOrFail();
        $data = $request->validate([
            'title' => 'required|max:255', 'location' => 'required|max:255',
            'type' => 'required|in:Full-time,Part-time,Contract,Internship,Remote',
            'level' => 'required|in:Entry,Mid,Senior,Lead,Executive',
            'category' => 'required|max:255', 'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gte:salary_min', 'description' => 'required|max:10000',
            'requirements' => 'required|max:10000', 'benefits' => 'nullable|max:5000',
            'deadline' => 'nullable|date',
        ]);
        $data['company_id'] = $company->id;
        $data['posted_by'] = Auth::id();
        $data['slug'] = Str::slug($data['title']) . '-' . Str::lower(Str::random(6));
        $data['is_active'] = true;
        $job = Job::create($data);
        return redirect()->route('jobs.show', $job)->with('success', 'Job published successfully.');
    }
}
