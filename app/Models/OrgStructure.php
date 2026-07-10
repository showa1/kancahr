<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'sk_number', 'user_id', 'department_id', 'position_id',
        'reports_to_id', 'acting_role', 'formation', 'sort_order',
        'period_start', 'period_end', 'status',
    ];

    protected $casts = [
        'period_start' => 'date',
        'period_end'   => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function reportsTo()
    {
        return $this->belongsTo(OrgStructure::class, 'reports_to_id');
    }

    public function subordinates()
    {
        return $this->hasMany(OrgStructure::class, 'reports_to_id');
    }
}
