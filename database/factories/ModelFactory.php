<?php

use LasseHaslev\LaravelFieldable\FieldType;
use LasseHaslev\LaravelFieldable\FieldRepresenter;
use LasseHaslev\LaravelFieldable\FieldValue;

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
$factory->define(FieldRepresenter::class, function (Faker\Generator $faker) {

    $fieldType = factory( FieldType::class )->create();

    return [
        'name' => $faker->name,
        'identifier' => str_random(30),
        'field_type_id' => $fieldType->id,
        'description' => $faker->paragraph,
        'is_repeatable' => $faker->boolean( 30 ),
    ];
});
$factory->define(FieldValue::class, function (Faker\Generator $faker) {

    $representer = factory( FieldRepresenter::class )->create();

    return [
        'value'=> $faker->numberBetween( 1, 1000 ),
        'field_representer_id' => $representer->id,
    ];
});
