<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnboardingTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'department', 'description'];

    public function tasks()
    {
        return $this->hasMany(OnboardingTask::class);
    }
}
