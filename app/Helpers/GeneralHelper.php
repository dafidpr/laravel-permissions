<?php

use App\Models\User;
use App\Models\Setting;
use Spatie\Permission\Models\Role;

if (!function_exists('getInfoLogin')) {
	function getInfoLogin()
    {
        $user = User::with('roles')->where('id', session('user')['id'])->first();
        return $user;
	}
}

if (!function_exists('getSetting')) {
    function getSetting($options)
    {
		$result = Setting::where('options', $options)->first();
		if ($result) {
			return $result->value;
		} else {
			return '';
		}
	}
}