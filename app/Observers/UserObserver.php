<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/11/27
 * Time: 18:42
 */

namespace App\Observers;


use App\User;

class UserObserver
{
    public function creating(User $user){
        $user->email_token=str_random(10);
        $user->email_active=false;
    }
}