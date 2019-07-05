<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = ['id'];
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
    public function publishers()
    {
        return $this->belongsToMany(Publisher::class);
    }
    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }
}
