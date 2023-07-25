<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dot extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'board_id',
        'x',
        'y',
        'color',
        'ip',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
