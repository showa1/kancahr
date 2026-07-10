<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'alias', 'start_time', 'end_time', 'cross_midnight', 'status',
    ];

    protected $casts = [
        'cross_midnight' => 'boolean',
    ];

    public function getStartTimeFormattedAttribute(): string
    {
        return substr($this->start_time, 0, 5); // HH:MM
    }

    public function getEndTimeFormattedAttribute(): string
    {
        return substr($this->end_time, 0, 5); // HH:MM
    }

    public function getDurationAttribute(): string
    {
        $start = \Carbon\Carbon::createFromFormat('H:i:s', $this->start_time);
        $end   = \Carbon\Carbon::createFromFormat('H:i:s', $this->end_time);
        if ($this->cross_midnight && $end->lte($start)) {
            $end->addDay();
        }
        $minutes = $start->diffInMinutes($end);
        $h = intdiv($minutes, 60);
        $m = $minutes % 60;
        return "{$h}j " . ($m > 0 ? "{$m}m" : "");
    }
}
