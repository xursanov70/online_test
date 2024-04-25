<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    public function can(string $action, string $module){
        $can = UserRole::join('roles', 'roles.id', '=', 'user_roles.role_id')
        ->join('actions', 'roles.action_id', '=', 'actions.id')
        ->join('modules', 'roles.module_id', '=', 'modules.id')
        ->where('user_roles.user_id', Auth::user()->id)
        ->where('actions.action_name', 'add')
        ->where('modules.module_name', '=', 'organization')
        ->first();

        if (!$can){
            return 'denied';
        }else{
        return 'can';
        }
    }
}
