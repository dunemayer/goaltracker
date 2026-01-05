<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $guarded = [];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function measurables()
    {
        return $this->hasMany(Measurable::class);
    }
}
