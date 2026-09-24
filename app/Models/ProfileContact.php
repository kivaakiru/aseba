<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileContact extends Model
{
    use HasFactory;

    protected $table = 'profile_contacts';

    protected $fillable = [
        'type',
        'label',
        'value',
        'link',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function getIconAttribute()
    {
        return match ($this->type) {

            'instagram' => 'bi-instagram',

            'facebook' => 'bi-facebook',

            'tiktok' => 'bi-tiktok',

            'youtube' => 'bi-youtube',

            'x' => 'bi-twitter-x',

            'whatsapp' => 'bi-whatsapp',

            'telegram' => 'bi-telegram',

            'email' => 'bi-envelope-fill',

            'website' => 'bi-globe2',

            'address' => 'bi-geo-alt-fill',

            default => 'bi-link-45deg',
        };
    }

    public function getTypeNameAttribute()
    {
        return match ($this->type) {

            'instagram' => 'Instagram',

            'facebook' => 'Facebook',

            'tiktok' => 'TikTok',

            'youtube' => 'YouTube',

            'x' => 'X',

            'whatsapp' => 'WhatsApp',

            'telegram' => 'Telegram',

            'email' => 'Email',

            'website' => 'Website',

            'address' => 'Alamat',

            default => ucfirst($this->type),
        };
    }
}