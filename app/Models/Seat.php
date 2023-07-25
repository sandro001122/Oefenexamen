<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class seat extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'seat_number',
    ];
}
