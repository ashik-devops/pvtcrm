<?php
namespace App\Traits;
/**
 * Created by PhpStorm.
 * User: rodelarode
 * Date: 7/3/17
 * Time: 10:35 PM
 */
use App\User;

trait FilterScope
{
    public function filter($Obj ,User $user){
        if($user->isAdmin() || $user->isSuperAdmin()){
            return $Obj;
        }
       return $Obj->whereIn('user_id', array_merge([$user->id], $user->getSubordinates()));

    }
}