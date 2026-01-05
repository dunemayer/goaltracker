<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckIn extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
    ];

    protected $casts = [
        'type' => 'string',
    ];

    public function measurables()
    {
        return $this->belongsToMany(Measurable::class, 'check_in_measurable')
            ->withPivot('status', 'integer_value', 'string_value', 'description')
            ->withTimestamps();
    }
}
