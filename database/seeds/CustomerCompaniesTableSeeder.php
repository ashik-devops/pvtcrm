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
        factory(App\Customer_company::class, 50)->create();

    }
}
