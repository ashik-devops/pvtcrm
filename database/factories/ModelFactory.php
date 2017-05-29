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
        'email'=>$faker->email,
        'phone_no'=>$faker->phoneNumber,
        'user_id'=>rand(2,4)
    ];
});

$factory->define(App\Address::class, function (Faker\Generator $faker) {
    $address_types=['BILLING', 'SHIPPING', 'CONTACT'];
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
        'type'=>$address_types[rand(0,2)]
    ];
});
