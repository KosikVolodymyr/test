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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {

    return [
        'user_id' => 1,
        'name' => $faker->sentence,
        'description' => $faker->sentence
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {

    return [
        'category_id' => 1,
        'user_id' => 1,
        'name' => $faker->sentence,
        'description' => $faker->sentence,
        'content' => $faker->sentence
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {

    return [
        'user_id' => 1,
        'post_id' => 1,
        'author' => $faker->name,
        'content' => $faker->sentence
    ];
});

$factory->define(App\CommentCategory::class, function (Faker\Generator $faker) {

    return [
        'user_id' => 1,
        'category_id' => 1,
        'author' => $faker->name,
        'content' => $faker->sentence
    ];
});
