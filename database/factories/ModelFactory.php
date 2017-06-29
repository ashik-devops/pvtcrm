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
        'user_id'=>rand(2,4),
        'customer_company_id'=>rand(1,50)
    ];
});

$factory->define(App\Address::class, function (Faker\Generator $faker) {
    return [
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

$factory->define(App\Task::class, function(Faker\Generator $faker) {
    $statuses=['Due', 'Done', 'Cancelled'];
    $priority=['Critical', 'High', 'Medium', 'Low'];
    return [
        'customer_id'=>rand(1,100),
        'title'=>$faker->text(20),
        'description'=>$faker->text(200),
        'due_date'=>\Carbon\Carbon::create()->addDays(rand(0,30)),
        'status'=>$statuses[rand(0,2)],
        'priority'=>$priority[rand(0,3)]
    ];
});
$factory->define(App\Appointment::class, function(Faker\Generator $faker) {
    $statuses=['Due', 'Done', 'Cancelled'];
    $today=new \Carbon\Carbon();
    $start=$today->addDays(rand(0,30));
    $end=$start->addDays(2);
    return [
        'customer_id'=>rand(1,100),
        'title'=>$faker->text(20),
        'description'=>$faker->text(200),
        'status'=>$statuses[rand(0,2)],
        'start_time'=>$start,
        'end_time'=>$end,
    ];
});