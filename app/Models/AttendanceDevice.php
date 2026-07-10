<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'serial_number',
        'brand',
        'model_name',
        'ip_address',
        'location',
        'integration_method',
        'adms_token',
        'is_active',
        'last_sync_at',
        'notes',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'last_sync_at' => 'datetime',
    ];

    /**
     * Label metode integrasi yang ramah tampilan.
     */
    public function getIntegrationMethodLabelAttribute(): string
    {
        return match ($this->integration_method) {
            'adms' => 'ADMS (Auto Push)',
            'sdk'  => 'SDK (Pull Terjadwal)',
            default => $this->integration_method,
        };
    }

    /**
     * Badge color untuk metode integrasi.
     */
    public function getMethodColorAttribute(): array
    {
        return match ($this->integration_method) {
            'adms' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700'],
            'sdk'  => ['bg' => 'bg-blue-100',    'text' => 'text-blue-700'],
            default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700'],
        };
    }
}
