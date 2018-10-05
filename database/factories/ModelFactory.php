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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => app('hash')->make('password')
    ];
});

/**
 * Factory definition for model App\Proposal.
 */
$factory->define(App\Models\Proposal::class, function ($faker) {
    return [
        'user_id' => function () {
            return factory('App\Models\User')->create()->id;
        },
        'type' => $faker->sentence(2),
        'approval_from' => $faker->name,
        'client_source' => $faker->sentence(2),
        'client_name' => $faker->name,
        'value' => $faker->sentence(),
        'code' => $faker->word,
        'due' => $faker->dateTime(),
    ];
});
