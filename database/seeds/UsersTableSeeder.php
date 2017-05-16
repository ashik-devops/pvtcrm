<?php

use Illuminate\Database\Seeder;
use App\User;
use App\User_profile;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= new User();
        $user->name = "Mohaimimus Sakib";
        $user->email='rode@scraperite.com';
        $user->password=bcrypt('Rodela');
        $user->status=1;
        $user->save();

        $user_profile=new User_profile();
        $user_profile->user_id=$user->id;
        $user_profile->initial = 'Rode';
        $user_profile->primary_phone_no = '+8801711722828';
        $user_profile->address_line_1='House 15, Road 21';
        $user_profile->address_line_2=" Nikunja-2, Khilkhet";
        $user_profile->city="Dhaka";
        $user_profile->state="Dhaka";
        $user_profile->country="Bangladesh";
        $user_profile->zip = "1229";
        $user_profile->save();
    }
}
