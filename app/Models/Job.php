<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;
    protected $table = 'job_postings';
    protected $fillable = [
        'company_id', 'posted_by', 'title', 'slug', 'location', 'type', 'level',
        'category', 'salary_min', 'salary_max', 'description', 'requirements',
        'benefits', 'featured', 'is_active', 'deadline',
    ];
    protected function casts(): array
    {
        return ['featured' => 'boolean', 'is_active' => 'boolean', 'deadline' => 'datetime'];
    }
    public function company() { return $this->belongsTo(Company::class); }
    public function poster() { return $this->belongsTo(User::class, 'posted_by'); }
    public function applications() { return $this->hasMany(Application::class, 'job_posting_id'); }
}
