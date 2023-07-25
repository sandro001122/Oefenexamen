<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeblock extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
