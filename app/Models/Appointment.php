<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_name',
        'customer_telephone_number',
        'customer_email',
        'date',
        'canceled',
        'timeblock_id',
        'user_id',
        'treatment_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function timeblock()
    {
        return $this->belongsTo(Timeblock::class);
    }
}
