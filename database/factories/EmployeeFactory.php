<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Employee::class, function (Faker $faker) {
    $name = $this->faker->name;
    $lastname = $this->faker->lastName;
    return [
        'name' => $name,
        'lastname' => $lastname,
        'slug' => Str::slug($name.' '.$lastname),
        'company_id' => App\Company::all()->random()->id,
        'email' => $this->faker->email,
        'phone' => $this->faker->phoneNumber
    ];
});
