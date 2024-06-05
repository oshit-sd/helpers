<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $guarded = ['id'];

    public function getImageAttribute($value)
    {
        return !empty($value) ? url("/storage/{$value}") : null;
    }
}
