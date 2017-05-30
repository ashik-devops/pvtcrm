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
       });

       foreach (\App\Customer_company::all() as $company){
           $company->default_customer = is_null($company->employees->first())?NULL:$company->employees->first()->id;
           $company->save();
       }

    }
}
