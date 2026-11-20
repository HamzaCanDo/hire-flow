<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployerController;
use App\Models\Job;
use App\Models\Company;
use Illuminate\Support\Facades\Artisan;

Route::get('/setup-hireflow/{token}', function (string $token) {
    $expected = env('SETUP_TOKEN');
    if (!$expected || !hash_equals($expected, $token)) {
        abort(404);
    }
    Artisan::call('migrate', ['--force' => true]);
    if (request('seed') === '1') {
        Artisan::call('db:seed', ['--force' => true]);
    }
    return response('HireFlow database setup complete.');
});

Route::get('/', function () {
    $featured = Job::with('company')->where('is_active', true)->where('featured', true)->latest()->limit(6)->get();
    $latest = Job::with('company')->where('is_active', true)->latest()->limit(8)->get();
    $companies = Company::withCount('jobs')->latest()->limit(8)->get();
    return view('home', compact('featured', 'latest', 'companies'));
})->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job:slug}', [JobController::class, 'show'])->name('jobs.show');
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::middleware('auth')->group(function () {
    Route::post('/jobs/{job:slug}/apply', [ApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('/dashboard', [ApplicationController::class, 'candidateDashboard'])->name('candidate.dashboard');
    Route::get('/employer', [EmployerController::class, 'dashboard'])->name('employer.dashboard');
    Route::get('/employer/company', [EmployerController::class, 'createCompanyForm'])->name('employer.company');
    Route::post('/employer/company', [EmployerController::class, 'storeCompany'])->name('employer.company.store');
    Route::get('/employer/jobs/create', [EmployerController::class, 'createJobForm'])->name('employer.jobs.create');
    Route::post('/employer/jobs', [EmployerController::class, 'storeJob'])->name('employer.jobs.store');
});
