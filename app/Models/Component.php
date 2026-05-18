<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    /** @use HasFactory<\Database\Factories\ComponentFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'motherboard_id',
        'mac_address',
        'processor_id',
        'ram',
        'harddisk_id',
        'video_card_id',
        'audio_card_id',
        'sos',
        'ofimatics',
        'navegators'
    ];
    
    protected $casts = [
        'sos' => 'array',
        'ofimatics' => 'array',
        'navegators' => 'array',
    ];

    // ¡Añade estas relaciones!
    public function motherboard()
    {
        return $this->belongsTo(Classification::class, 'motherboard_id');
    }

    public function processor()
    {
        return $this->belongsTo(Classification::class, 'processor_id');
    }

    public function harddisk()
    {
        return $this->belongsTo(Classification::class, 'harddisk_id');
    }

    public function videoCard()
    {
        return $this->belongsTo(Classification::class, 'video_card_id');
    }

    public function audioCard()
    {
        return $this->belongsTo(Classification::class, 'audio_card_id');
    }
}
