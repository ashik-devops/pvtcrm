<?php

use Illuminate\Database\Seeder;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = [
            '*'=>'All',
            'create'=>'Create',
            'edit'=>'Update',
            'view'=>'View',
            'delete'=>'Delete',
            'list'=>'Index',
        ];
        foreach ($actions as $name=>$label){
            \App\Action::create([
                'name'=>$name,
                'label'=>$label
            ]);
        }
    }
}
