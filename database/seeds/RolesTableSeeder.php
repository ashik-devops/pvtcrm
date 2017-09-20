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
        $role->name="Super Administrator";
        $role->save();
        $role->policies()->attach(\App\Policy::where('scope', '*')->where('action', '*')->first()->id);

        $role = new Role();
        $role->id=2;
        $role->name="Administrator";
        $role->save();
        $role->policies()->attach(\App\Policy::where('scope', '*')->where('action', '*')->first()->id);

        $role = new Role();
        $role->id=3;
        $role->name="Sales Manager";
        $role->save();
        $role->policies()->attach(\App\Policy::where('scope', 'team')->where('action', '*')->first()->id);
        $role->policies()->attach(\App\Policy::where('scope', 'task')->where('action', '*')->first()->id);
        $role->policies()->attach(\App\Policy::where('scope', 'customer')->where('action', 'view')->first()->id);
        $role->policies()->attach(\App\Policy::where('scope', 'appointment')->where('action', '*')->first()->id);

        $role = new Role();
        $role->id=4;
        $role->name="Sales Representative";
        $role->save();

        $role->policies()->attach(\App\Policy::where('scope', 'task')->where('action', '*')->first()->id);
        $role->policies()->attach(\App\Policy::where('scope', 'customer')->where('action', '*')->first()->id);
        $role->policies()->attach(\App\Policy::where('scope', 'appointment')->where('action', '*')->first()->id);
    }
}
