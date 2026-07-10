<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnboardingTask extends Model
{
    use HasFactory;

    protected $fillable = ['onboarding_template_id', 'title', 'description', 'duration_days'];

    public function template()
    {
        return $this->belongsTo(OnboardingTemplate::class, 'onboarding_template_id');
    }

    public function employeeOnboardings()
    {
        return $this->hasMany(EmployeeOnboarding::class);
    }
}
