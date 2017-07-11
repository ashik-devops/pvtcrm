<?php

use Illuminate\Database\Seeder;

class SalesTeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Sales_team::class, 5)->create();
    }
}
