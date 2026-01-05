<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurable extends Model
{
    protected $guarded = [];
    public function goal()
    {
        return $this->belongsTo(Goal::class, 'goal_id');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function checkIns()
    {
        return $this->belongsToMany(CheckIn::class, 'check_in_measurable')
            ->withPivot('status', 'integer_value', 'string_value', 'description')
            ->withTimestamps();
    }
}
