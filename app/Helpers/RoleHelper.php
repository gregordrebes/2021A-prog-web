<?php

namespace App\Helpers;

use App\Role;

class RoleHelper
{
    public const MODERATOR = 1;
    public const EDITOR = 2;
    
    
    public static function getRoleName($role_id)
    {
        $name = Role::where("id", $role_id)->first()->name;
        return $name;
    }

}