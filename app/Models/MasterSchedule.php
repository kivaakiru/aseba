<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasterSchedule extends Model
{
    protected $table = 'master_schedules';

    protected $fillable = [

        'mode',

        'schedule_type',

        'day_name',

        'date',

        'all_day',

        'start_time',

        'end_time',

        'description',

        'is_active',

        'created_by',

    ];

    protected $casts = [

        'date' => 'date',



        'all_day' => 'boolean',

        'is_active' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function creator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPE
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where(
            'is_active',
            true
        );
    }

    public function scopePractice($query)
    {
        return $query->where(
            'mode',
            'practice'
        );
    }

    public function scopeHoliday($query)
    {
        return $query->where(
            'mode',
            'holiday'
        );
    }

    public function scopeOverride($query)
    {
        return $query->where(
            'mode',
            'override'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    public function getDurationAttribute()
    {
        if ($this->all_day) {

            return 'Full Day';

        }

        return substr(
            $this->start_time,
            0,
            5
        ) . ' - ' . substr(
            $this->end_time,
            0,
            5
        );
    }

    public function getBadgeColorAttribute()
    {
        return match ($this->mode) {

            'practice' => 'warning',

            'holiday' => 'danger',

            'override' => 'primary',

            default => 'secondary',

        };
    }

    public function getBadgeTextAttribute()
    {
        return ucfirst(
            $this->mode
        );
    }

    public function getTargetAttribute()
    {
        if ($this->schedule_type == 'weekly') {

            return $this->day_name;

        }

        return optional(
            $this->date
        )->format('d M Y');
    }
}
