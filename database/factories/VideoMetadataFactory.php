<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\VideoMetadata;
use Faker\Generator as Faker;

$factory->define(VideoMetadata::class, function (Faker $faker) {
    return [
        'size' => $faker->numberBetween(1, 1000),
        'viewers' => $faker->numberBetween(1, 1000),
    ];
});
