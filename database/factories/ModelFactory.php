<?php

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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

/**
 * Factory definition for model App\Task.
 */
$factory->define(App\Task::class, function ($faker) {
    return [
        'project_id' => $faker->key,
    ];
});

/**
 * Factory definition for model App\Proposal.
 */
$factory->define(App\Proposal::class, function ($faker) {
    return [
        'user_id' => $faker->key,
    ];
});

/**
 * Factory definition for model App\Role.
 */
$factory->define(App\Role::class, function ($faker) {
    return [
        // Fields here
    ];
});

/**
 * Factory definition for model App\Permission.
 */
$factory->define(App\Permission::class, function ($faker) {
    return [
        // Fields here
    ];
});