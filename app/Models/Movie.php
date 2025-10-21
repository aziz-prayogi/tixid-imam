<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','genre','duration','director','description','age_rating','poster','activated'];
    public function schedules() {
        return $this->hasMany(Schedule::class);
    }
}
