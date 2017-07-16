<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $this->call(PoliciesSeeder::class);
        $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);

        $this->call(AccountsTableSeeder::class);
         $this->call(CustomersTableSeeder::class);
         $this->call(TasksTableSeeder::class);

        $this->call(AppointmentsTableSeeder::class);
        $this->call(SalesTeamTableSeeder::class);
    }
}
