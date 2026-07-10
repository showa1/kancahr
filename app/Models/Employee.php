<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'nik', 'identity_type', 'identity_number',
        'prefix_title', 'full_name', 'initials', 'suffix_title', 'nickname',
        'birth_place', 'birth_date', 'gender', 'blood_type', 'blood_rhesus',
        'religion', 'ethnicity', 'nationality', 'marital_status', 'ptkp_code', 'tax_code',
        'address', 'ktp_address', 'province', 'district', 'sub_district', 'village',
        'latitude', 'longitude', 'phone', 'email',
        'department_id', 'position_id', 'employment_status_id',
        'education', 'education_major', 'employee_type',
        'work_branch', 'employee_grade', 'grade', 'join_date',
        'contract_start_date', 'contract_end_date', 'contract_number', 'contract_file', 'contract_notes',
        'npwp', 'npwp_registration_date', 'npwp_address',
        'bpjs_health_number', 'bpjs_employment_number', 'bpjs_join_date', 'bpjs_end_date',
        'bank_name', 'bank_branch', 'bank_account_number', 'bank_account_name',
        'insurance_number', 'basic_salary', 'pph21_method',
        'height_cm', 'weight_kg', 'house_ownership', 'language_ability',
        'skills', 'expertise', 'interests', 'talents',
        'photo', 'is_active',
    ];

    protected $casts = [
        'birth_date'              => 'date',
        'join_date'               => 'date',
        'contract_start_date'     => 'date',
        'contract_end_date'       => 'date',
        'npwp_registration_date'  => 'date',
        'bpjs_join_date'          => 'date',
        'bpjs_end_date'           => 'date',
        'basic_salary'            => 'decimal:2',
        'is_active'               => 'boolean',
    ];

    // ─── Relationships ─────────────────────────────────────────────
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function employmentStatus(): BelongsTo
    {
        return $this->belongsTo(EmploymentStatus::class);
    }

    // ─── Helpers ───────────────────────────────────────────────────
    public function getDisplayNameAttribute(): string
    {
        $prefix = $this->prefix_title ? $this->prefix_title . ' ' : '';
        $suffix = $this->suffix_title ? ', ' . $this->suffix_title : '';
        return $prefix . $this->full_name . $suffix;
    }

    public function getGenderLabelAttribute(): string
    {
        return $this->gender === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : asset('images/default-avatar.png');
    }
}
