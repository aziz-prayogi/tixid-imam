<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cinema extends Model
{
    //mendaftarkan softdelete
    use SoftDeletes;

    protected $fillable = ['name','location'];
    // mendefinisikan relasi karna schedule nya itu many jadi jamak
    public function schedules() {
        // hasMany() = one to many
        // hasOne() = one to one
        return $this->hasMany(Schedule::class);
    }
}
