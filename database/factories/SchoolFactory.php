<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\School;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(School::class, function (Faker $faker) {
    return [

        'name'        => $faker->name,
        'address'     => e($faker->address),
        'about'       => $faker->sentences(3, true),
        'code'        => date("y").substr(number_format(time() * mt_rand(),0,'',''),0,6),
    ];
});
