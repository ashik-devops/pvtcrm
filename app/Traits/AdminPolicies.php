<?php
namespace App\Traits;
/**
 * Created by PhpStorm.
 * User: rodelarode
 * Date: 7/3/17
 * Time: 10:35 PM
 */
use App\User;
trait AdminPolicies
{
    public function checkAdmin(User $user){
        if($user->isAdmin() || $user->isSuperAdmin()){
            return true;
        }
    }
}