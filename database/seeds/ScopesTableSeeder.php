<?php

use Illuminate\Database\Seeder;

class ScopesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scopes = [
            '*'=>'All',
            'customer'=>'Contact',
            'task'=>'Task',
            'appointment'=>'Appointment',
            'journal'=>'Journal Entry',
            'account'=>'Account',
            'user'=>'User',
            'team'=>'Team'
        ];
        foreach ($scopes as $name=>$label){
            \App\Scope::create([
                'name'=>$name,
                'label'=>$label
            ]);
        }

    }
}
