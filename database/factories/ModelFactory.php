<?php

use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use Faker\Generator;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Generator $faker) {
    static $password;

    return [
        'first_name'        => $faker->name,
        'last_name'         => $faker->name,
        'email'             => $faker->safeEmail,
        'password'          => $password ?: $password = bcrypt('secret'),
        'confirmation_code' => md5(uniqid(mt_rand(), true)),
        'remember_token'    => str_random(10),
    ];
});

$factory->state(User::class, 'active', function () {
    return [
        'status' => 1,
    ];
});

$factory->state(User::class, 'inactive', function () {
    return [
        'status' => 0,
    ];
});

$factory->state(User::class, 'confirmed', function () {
    return [
        'confirmed' => 1,
    ];
});

$factory->state(User::class, 'unconfirmed', function () {
    return [
        'confirmed' => 0,
    ];
});

/*
 * Roles
 */
$factory->define(Role::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'all'  => 0,
        'sort' => $faker->numberBetween(1, 100),
    ];
});

$factory->state(Role::class, 'admin', function () {
    return [
        'all' => 1,
    ];
});
