<?php
namespace App\Traits;
/**
 * Created by PhpStorm.
 * User: rodelarode
 * Date: 7/3/17
 * Time: 10:35 PM
 */
use App\User;
trait PolicyHelpers
{
    public function checkAdmin(User $user): boolean{
        if($user->isAdmin() || $user->isSuperAdmin()){
            return true;
        }
        return false;
    }

    public function checkAccess(User $user, array $scopes, array $actions): boolean{
        return !is_null($user->role->policies()
            ->whereHas('action',function($query) use ($actions){
                $query->whereIn('name', $actions);
            })
            ->whereHas('scope',function($query) use ($scopes){
                $query->whereIn('name', $scopes);
            })->first());
    }
}