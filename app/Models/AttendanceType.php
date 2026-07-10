<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'machine_status_code',
        'color',
        'affects_payroll',
        'late_tolerance_minutes',
        'is_active',
        'description',
    ];

    protected $casts = [
        'affects_payroll'        => 'boolean',
        'is_active'              => 'boolean',
        'late_tolerance_minutes' => 'integer',
        'machine_status_code'    => 'integer',
    ];

    /**
     * Kembalikan label warna Tailwind untuk badge UI.
     */
    public function getColorClassesAttribute(): array
    {
        $map = [
            'emerald' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'dot' => 'bg-emerald-500'],
            'yellow'  => ['bg' => 'bg-yellow-100',  'text' => 'text-yellow-700',  'dot' => 'bg-yellow-500'],
            'red'     => ['bg' => 'bg-red-100',      'text' => 'text-red-700',     'dot' => 'bg-red-500'],
            'blue'    => ['bg' => 'bg-blue-100',     'text' => 'text-blue-700',    'dot' => 'bg-blue-500'],
            'purple'  => ['bg' => 'bg-purple-100',   'text' => 'text-purple-700',  'dot' => 'bg-purple-500'],
            'gray'    => ['bg' => 'bg-gray-100',     'text' => 'text-gray-700',    'dot' => 'bg-gray-400'],
            'orange'  => ['bg' => 'bg-orange-100',   'text' => 'text-orange-700',  'dot' => 'bg-orange-500'],
        ];

        return $map[$this->color] ?? $map['gray'];
    }
}
