<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    $name = $this->faker->name;
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'email' => $this->faker->email,
        'logo' => 'companies/default.png',
        'website' => $this->faker->url,
    ];
});
