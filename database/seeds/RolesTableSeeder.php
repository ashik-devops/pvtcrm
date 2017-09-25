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
        $role->policies()->attach(\App\Policy::whereHas('action', function($query){$query->where(['name'=>'*']);})->whereHas('scope',function($query){$query->where(['name'=>'*']);})->first());

        $role = new Role();
        $role->id=2;
        $role->name="Administrator";
        $role->save();
        $role->policies()->attach(\App\Policy::whereHas('action', function($query){$query->where(['name'=>'*']);})->whereHas('scope',function($query){$query->where(['name'=>'*']);})->first());

        $role = new Role();
        $role->id=3;
        $role->name="Sales Manager";
        $role->save();
        foreach (['task', 'appointment', 'customer', 'team'] as $scope){
            $role->policies()->attach(\App\Policy::whereHas('action', function($query){$query->where(['name'=>'*']);})->whereHas('scope',function($query)  use ($scope) {$query->where(['name'=>$scope]);})->first());
        }

        $role = new Role();
        $role->id=4;
        $role->name="Sales Representative";
        $role->save();
        foreach (['task', 'appointment', 'customer'] as $scope){
            $role->policies()->attach(\App\Policy::whereHas('action', function($query){$query->where(['name'=>'*']);})->whereHas('scope',function($query)  use ($scope) {$query->where(['name'=>$scope]);})->first());
        }

    }
}
