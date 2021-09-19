<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Profile extends Model
{
    use HasApiTokens,HasFactory;

    protected $fillable = [
        'email',
        'properties',
        'event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
