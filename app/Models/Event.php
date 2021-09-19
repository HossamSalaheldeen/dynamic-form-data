<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'event_user');
    }

}
