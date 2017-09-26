<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Account::class, 50)->create()->each(function ($c){
            $c->addresses()->save(factory(\App\Address::class)->make());
            $c->addresses()->save(factory(\App\Address::class)->make());
        });

    }
}
