<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\StudentInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(StudentInfo::class, function (Faker $faker) {
    return [
        'student_id'           => $faker->randomElement(User::student()->pluck('id')->toArray()),
        'annee'                => now()->year,
        'classe'               => $faker->randomElement(['sixieme', 'cinquieme', 'quatrieme']),
        'birthday'             => $faker->dateTimeThisCentury->format('Y-m-d'),
        'father_name'          => $faker->name,
        'father_phone_number'  => $faker->randomNumber(8, false),
        'mother_name'          => $faker->name,
        'mother_phone_number'  => $faker->randomNumber(8, false),
    ];
});


$factory->state(StudentInfo::class, 'sixieme', [
    'classe' => 'sixieme'
]);

$factory->state(StudentInfo::class, 'cinquieme', [
    'classe' => 'cinquieme'
]);

$factory->state(StudentInfo::class, 'quatrieme', [
    'classe' => 'quatrieme'
]);