<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Each specialty may be assigned to one or many docotrs.
     */
    public function benefits(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}
