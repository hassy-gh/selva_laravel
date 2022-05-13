<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'name_sei' => $faker->lastName,
        'name_mei' => $faker->firstName,
        'nickname' => 'ニックネーム',
        'gender' => $faker->randomElement($array = [1, 2]),
        'password' => Hash::make('password'),
        'email' => $faker->safeEmail,
    ];
});
