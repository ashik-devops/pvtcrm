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
$factory->define(App\Customer::class, function (Faker\Generator $faker) {

    static $titles = ['CEO', 'GM', 'COO', 'MRO', 'HR'];
    return [
        'first_name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'title'=>$titles[rand(0, 4)],
        'email'=>$faker->unique()->email,
        'phone_no'=>$faker->unique()->phoneNumber,
        'user_id'=>rand(2,4)
    ];
});

$factory->define(App\Address::class, function (Faker\Generator $faker) {
    return [
        'customer_id'=>rand(1,50),
        'street_address_1'=>$faker->streetAddress,
        'street_address_2'=>$faker->streetName,
        'city'=>$faker->city,
        'state'=>$faker->state,
        'country'=>$faker->country,
        'zip'=>$faker->postcode,
        'email'=>$faker->unique()->email,
        'phone_no'=>$faker->unique()->phoneNumber,
    ];
});

$factory->define(App\Customer_company::class, function(Faker\Generator $faker) {
    return [
        'name'=>$faker->name,
        'website'=>$faker->unique()->url,
        'phone_no'=>$faker->unique()->phoneNumber,
        'email'=>$faker->unique()->email
    ];
});
