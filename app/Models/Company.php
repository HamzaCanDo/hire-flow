<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'slug', 'logo', 'website', 'industry', 'location', 'size', 'description', 'verified'];
    protected function casts(): array { return ['verified' => 'boolean']; }
    public function owner() { return $this->belongsTo(User::class, 'user_id'); }
    public function jobs() { return $this->hasMany(Job::class); }
}
