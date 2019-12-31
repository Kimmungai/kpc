<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Bank;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(Bank::class, function (Faker $faker) {
    return [
        'name' => 'Family Bank',
        'branch' => 'Kitui',
        'accountName' => 'Kitui Pastoral Center',
        'accountType' => 'Current',
        'accountNumber' => '0310195147206',
        'branchCode' => '035',
    ];
});
