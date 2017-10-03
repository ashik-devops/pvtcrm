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
    public function checkAdmin(User $user): bool
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    public function checkAccess(User $user, array $scopes, array $actions): bool
    {
        return !is_null($user->role->policies()
            ->whereHas('action',function($query) use ($actions){
                $query->whereIn('name', $actions);
            })
            ->whereHas('scope',function($query) use ($scopes){
                $query->whereIn('name', $scopes);
            })->first());
    }
}