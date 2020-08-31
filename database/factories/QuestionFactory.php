<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Question::class, function  (Faker $faker) {
  return [
    'title' => $title = rtrim($faker->sentence(rand(5, 10)), '.'),
    //'slug' => Str::slug($title),
    'body' => $faker->paragraphs(rand(3, 7), true),
    'views' => rand(0, 10),
    //'answers_count' => rand(0, 10),
    'votes' => rand(-3, 10),
    //'user_id' => \App\User::all()->random()->id
  ];
});