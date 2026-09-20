<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'photo',
        'full_name',
        'jersey_name',
        'jersey_number',
        'date_of_birth',
        'age',
        'position',
        'height',
        'weight',
        'social_media_name',
        'social_media_url',
        'status',
    ];
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
