<?php

use App\Models\User;

if (!function_exists('getInfoLogin')) {
	function getInfoLogin()
    {
        $user = User::where('id', session('user')['id'])->first();
        return $user;
	}
}