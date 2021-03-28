<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Settings',
            'mod'   => 'mod_setting',
        ];
        return view('admin.setting.index', $data);
    }
}
