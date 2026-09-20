<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubHistory extends Model
{
    use HasFactory;

    protected $table = 'club_histories';

    protected $fillable = [
        'year',
        'title',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'year' => 'integer',
        'sort_order' => 'integer',
    ];
}