<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
