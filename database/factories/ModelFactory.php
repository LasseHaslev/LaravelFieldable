<?php

use LasseHaslev\LaravelFieldable\FieldType;

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

$factory->define(FieldType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'view' => $faker->word,
    ];
});
