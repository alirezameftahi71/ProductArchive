<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $guarded = ['id'];
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
