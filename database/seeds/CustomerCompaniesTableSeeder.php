<?php

use Illuminate\Database\Seeder;

class CustomerCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Customer_company::class, 50)->create()->each(function ($c){
            $c->addresses()->save(factory(\App\Address::class)->make());
            $c->addresses()->save(factory(\App\Address::class)->make());
        });

    }
}
