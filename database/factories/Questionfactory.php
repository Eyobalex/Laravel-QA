<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Question::class, function (Faker $faker) {
    return [
        'title' => $faker->unique(false, 100000)->title(rand(5,10)),
        'body' => $faker->paragraphs(rand(3, 7),true),
        'views' => rand(0,10),
        'answers' => rand(0,10),
        'votes' => rand(-10,10),
    ];
});
