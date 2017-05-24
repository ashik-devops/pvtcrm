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
        $user->role_id=1;
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

        $user->policies()->attach(\App\Policy::where('scope', '*')->where('action', '*')->first()->id);

        $user= new User();
        $user->name = "Alex Branden";
        $user->email='alex@scraperite.com';
        $user->password=bcrypt('Alex123');
        $user->status=1;
        $user->role_id=2;
        $user->save();

        $user_profile=new User_profile();
        $user_profile->user_id=$user->id;
        $user_profile->initial = 'Alex';
        $user_profile->primary_phone_no = '+0123456789';
        $user_profile->address_line_1='Ocean Shore Blvd  ';
        $user_profile->address_line_2="Holly Hill";
        $user_profile->city="Miami";
        $user_profile->state="FL";
        $user_profile->country="USA";
        $user_profile->zip = "104125";
        $user_profile->save();
        $user->policies()->attach(\App\Policy::where('scope', 'user')->where('action', '*')->first()->id);

        $user= new User();
        $user->name = "Dean";
        $user->email='dean@scraperite.com';
        $user->password=bcrypt('Dean123');
        $user->status=1;
        $user->role_id=3;
        $user->save();

        $user_profile=new User_profile();
        $user_profile->user_id=$user->id;
        $user_profile->initial = 'Dean';
        $user_profile->primary_phone_no = '+0223456789';
        $user_profile->address_line_1='Ocean Shore Blvd  ';
        $user_profile->address_line_2="Holly Hill";
        $user_profile->city="Miami";
        $user_profile->state="FL";
        $user_profile->country="USA";
        $user_profile->zip = "104125";
        $user_profile->save();
        $user->policies()->attach(\App\Policy::where('scope', 'user')->where('action', 'view')->first()->id);
        $user->policies()->attach(\App\Policy::where('scope', 'user')->where('action', 'edit')->first()->id);

        $user= new User();
        $user->name = "Paul Kasabian";
        $user->email='paul.kasabian@scraperite.com';
        $user->password=bcrypt('Paul123');
        $user->status=1;
        $user->role_id=4;
        $user->save();

        $user_profile=new User_profile();
        $user_profile->user_id=$user->id;
        $user_profile->initial = 'PK';
        $user_profile->primary_phone_no = '+0323456789';
        $user_profile->address_line_1='Ocean Shore Blvd  ';
        $user_profile->address_line_2="Holly Hill";
        $user_profile->city="Miami";
        $user_profile->state="FL";
        $user_profile->country="USA";
        $user_profile->zip = "104125";
        $user_profile->save();

    }
}
