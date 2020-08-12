<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Classe;
use App\Models\School;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    
    //static $password;

    return [
        'name'           => e($faker->name),
        'email'          => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        //'password'     => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'password'       => bcrypt('secret'),
        'remember_token' => Str::random(10),
        'active'         => 1,
        'role'           => $faker->randomElement(['student', 'teacher', 'admin']),
        'school_id' => function () use ($faker) {
          if (School::count())
            return $faker->randomElement(School::pluck('id')->toArray());
          else return factory(School::class)->create()->id;
        },
        'code' => function () use ($faker) {
          if (School::count())
            return $faker->randomElement(School::pluck('code')->toArray());
          else return factory(School::class)->create()->code;
        },
        'student_code'   => $faker->unique()->randomNumber(7, false),
        'address'        => e($faker->address),
        'about'          => $faker->sentences(3, true),
        'phone_number'   => $faker->unique()->phoneNumber,
        'verified'       => 1,
        'nationality'    => 'Benin',
        'gender'         => $faker->randomElement(['male', 'female']),
        'classe_id'      => function () use ($faker) {
          if (Classe::count())
            return $faker->randomElement(Classe::pluck('id')->toArray());
          else return factory(Classe::class)->create()->id;
        },
    ];
});


$factory->state(User::class, 'master', [
    'role' => 'master'
]);

$factory->state(User::class, 'admin', [
    'role' => 'admin'
]);

$factory->state(User::class, 'teacher', [
    'role' => 'teacher'
]);

$factory->state(User::class, 'student', [
    'role' => 'student'
]);
