<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treatment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
