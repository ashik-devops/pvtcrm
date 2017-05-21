<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->id=1;
        $role->name="Super Admin";
        $role->save();
        $role = new Role();
        $role->id=2;
        $role->name="Admin";
        $role->save();
        $role = new Role();
        $role->id=3;
        $role->name="Sales Manager";
        $role->save();
        $role->id=4;
        $role->name="Sales Representative";
        $role->save();

    }
}
