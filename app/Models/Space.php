<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $fillable = [
      'local_id',
      'name',
      'type',
      'capacity',
      'status',
    ];
    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function resources()
    {
        return $this->belongsToMany(Resource::class)->withPivot('quantity')->withTimestamps();
    }
}
