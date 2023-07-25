<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel',
        'slug',
        'description',
        'width',
        'height',
        'timer',
        'background',
    ];

    public function dots()
    {
        return $this->hasMany(Dot::class);
    }
}
