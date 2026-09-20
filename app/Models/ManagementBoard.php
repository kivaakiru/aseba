<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementBoard extends Model
{
    use HasFactory;

    protected $table = 'management_boards';

    protected $fillable = [
        'name',
        'role',
        'photo',
        'phone',
        'email',
        'instagram',
        'linkedin',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Memisahkan role berdasarkan koma.
     *
     * Contoh:
     * OWNER, CLUB MANAGER, HEAD COACH
     *
     * menjadi:
     * [
     *     'OWNER',
     *     'CLUB MANAGER',
     *     'HEAD COACH'
     * ]
     */
    public function getRolesAttribute(): array
    {
        return collect(explode(',', $this->role))
            ->map(fn ($role) => trim($role))
            ->filter()
            ->values()
            ->toArray();
    }
}