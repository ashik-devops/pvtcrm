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
            '*'=>['*'],
            'user'=>[
                'view','list','edit','delete', '*'
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
