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
            $scope = \App\Scope::where('name','=' ,$scope)->first();
            foreach ($actions as $action) {
                $action=\App\Action::where('name', '=', $action)->first();
                $policy=new \App\Policy();
                $policy->action()->associate($action);
                $policy->scope()->associate($scope);
                $policy->save();
            }
        }
    }
}
