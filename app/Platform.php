<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $guarded = ['id'];
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
