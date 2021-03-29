<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Settings',
            'mod'   => 'mod_setting',
            'general' => Setting::where('groups', 'General')->get()
        ];
        return view('admin.setting.index', $data);
    }

    public function create(Request $request)
    {
    }

    public function edit($id)
    {
        $ids = Hashids::decode($id);
        $data = [
            'title' => 'Edit Settings',
            'mod'   => 'mod_setting',
            'settings' => Setting::find($ids[0]),
            'action' => '/administrator/settings/' . $id . '/update'
        ];
        return view('admin.setting.form', $data);
    }

    public function update(Request $request, $id)
    {
        $ids = Hashids::decode($id);
        if (\Request::ajax()) {
            $validator = Validator::make($request->all(), [
                'group' => 'required',
                'option' => 'required',
                'value' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'messages' => $validator->messages()
                ], 400);
            } else {

                try {
                    $settingUpdate = Setting::where('id', $ids[0])->update([
                        'groups' => $request->group,
                        'options' => $request->option,
                        'value' => $request->value,
                        'updated_by' => \getInfoLogin()->id,
                        'updated_at' => Carbon::now()
                    ]);

                    return response()->json([
                        'messages'  => 'Setting successfuly updated',
                        'redirect'  => '/administrator/settings'
                    ], 200);
                } catch (Exeption $e) {
                    return response()->json([
                        'messages' => 'Opps! Something wrong.'
                    ], 409);
                }
            }
        } else {
            abort(403);
        }
    }
}
