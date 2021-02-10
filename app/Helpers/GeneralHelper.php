<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

if (!function_exists('getInfoLogin')) {
	function getInfoLogin()
    {
        $user = User::with('roles')->where('id', session('user')['id'])->first();
        return $user;
	}
}