<?php

use App\Policy;
use Illuminate\Database\Seeder;

class PoliciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $policies = [
            '*'=>['create','view','list','edit','delete', '*'],
            'user'=>[
                'create','view','list','edit','delete', '*'
            ],
            'customer'=>[
               'create','view','list','edit','delete', '*'
            ],
            'team'=>[
                'create','view','list','edit','delete','*'
            ],
            'task'=>[
                'create','view','list','edit','delete','*'
            ],
            'appointment'=>[
                'create','view','list','edit','delete','*'
            ],
            'account'=>[
                'create','view','list','edit','delete','*'
            ]

        ];

        foreach ($policies as $scope=>$actions){
            foreach ($actions as $action) {
                $policy = new Policy();
                $policy->scope = $scope;
                $policy->action = $action;
                $policy->save();
            }
        }
    }
}
