<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;
    protected $fillable = ['job_posting_id', 'user_id', 'resume', 'cover_letter', 'status'];
    public function job() { return $this->belongsTo(Job::class, 'job_posting_id'); }
    public function user() { return $this->belongsTo(User::class); }
}
