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
        $user->first_name = "Mohaimimus";
        $user->last_name = "Sakib";
        $user->email='rode@scraperite.com';
        $user->password=bcrypt('Rodela');
        $user->status=1;
        $user->role_id=1;
        $user->save();

        $user_profile=new User_profile();
        $user_profile->user_id=$user->id;
        $user_profile->initial = 'Rode';
        $user_profile->primary_phone_no = '+8801711722828';

        $user_profile->save();

        $user= new User();
        $user->first_name = "Alex";
        $user->last_name = "Alex";
        $user->email='alex@scraperite.com';
        $user->password=bcrypt('Alex123');
        $user->status=1;
        $user->role_id=2;
        $user->save();

        $user_profile=new User_profile();
        $user_profile->user_id=$user->id;
        $user_profile->initial = 'Alex';
        $user_profile->primary_phone_no = '+0123456789';
        $address=new \App\Address();
        $address->street_address_1='Ocean Shore Blvd  ';
        $address->street_address_2="Holly Hill";
        $address->city="Miami";
        $address->state="FL";
        $address->country="USA";
        $address->zip = "104125";
        $address->type='CONTACT';
        $user_profile->save();
        $user_profile->address()->save($address);
        $user= new User();
        $user->first_name = "Dean";
        $user->last_name = "Shill";
        $user->email='dean@scraperite.com';
        $user->password=bcrypt('Dean123');
        $user->status=1;
        $user->role_id=3;
        $user->save();

        $user_profile=new User_profile();
        $user_profile->user_id=$user->id;
        $user_profile->initial = 'Dean';
        $user_profile->primary_phone_no = '+0223456789';

        $user_profile->save();

        $user= new User();
        $user->first_name = "Paul Kasabian";
        $user->last_name = "Paul";
        $user->email='paul.kasabian@scraperite.com';
        $user->password=bcrypt('Paul123');
        $user->status=1;
        $user->role_id=4;
        $user->save();

        $user_profile=new User_profile();
        $user_profile->user_id=$user->id;
        $user_profile->initial = 'PK';
        $user_profile->primary_phone_no = '+0323456789';

        $user_profile->save();

    }
}
