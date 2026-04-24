<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = [
        'name',
        'address',
        'description',
    ];

    public function spaces()
    {
        return $this->hasMany(Space::class);
    }
}
