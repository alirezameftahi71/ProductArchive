<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserList;
use Faker\Generator as Faker;

$factory->define(UserList::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_id' => 1
    ];
});
