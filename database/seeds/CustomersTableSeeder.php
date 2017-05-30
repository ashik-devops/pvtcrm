<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(\App\Customer::class, 50)->create()->each(function ($c){
           $c->addresses()->save(factory(\App\Address::class)->make());
           $c->addresses()->save(factory(\App\Address::class)->make());
           $c->company = (rand(1,50));
       });

    }
}
