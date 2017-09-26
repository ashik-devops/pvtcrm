<?php

use Illuminate\Database\Seeder;

class CustomerCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['New Leads', 'Hardware/DIY', 'Automotive', 'Misc'];
        foreach ($categories as $category){
            $c =  new \App\Customer_category();
            $c->name=$category;
            $c->save();
        }


    }
}
