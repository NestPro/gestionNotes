<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Classe;
use App\Models\School;
use Faker\Generator as Faker;

$factory->define(Classe::class, function (Faker $faker) {
    static $code = 1;
    return [
        'code' => $code++,
        'name' => $faker->unique()->randomElement(['CI','CP','CE1', 'CE2','CM1','CM2']),
        'school_id'    => function() use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        }
    ];
});
