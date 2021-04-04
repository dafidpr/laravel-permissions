<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use App\Models\User;
use Vinkla\Hashids\Facades\Hashids;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Users',
            'mod'   => 'mod_user',
            'collection' => User::with('roles')->get()
        ];
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Create User',
            'mod'   => 'mod_user',
            'roles' => Role::all(),
            'action' => '/administrator/users/store'
        ];
        return view('admin.user.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Request::ajax()) {
            $validator = Validator::make($request->all(), [
                'name'      => 'required',
                'username'  => 'required',
                'email'     => 'required|email',
                'password'  => 'required',
                'block'     => 'required',
                'picture'   => 'image|mimes:jpg,jpeg,png,gif',
                'phone'     => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'messages' => $validator->messages()
                ], 400);
            } else {

                try {
                    $path = 'admin/uploads/img/profile/';
                    $fileName = 'user_pic.png';
                    if ($request->file('picture') != null) {

                        $fileName = $request->file('picture');
                        $request->file('picture')->move(public_path($path), $fileName);
                    }
                    $user = User::create([
                        'name'      => $request->name,
                        'username'  => $request->username,
                        'email'     => $request->email,
                        'password'  => Hash::make($request->password),
                        'block'     => $request->block,
                        'picture'   => $fileName,
                        'phone_number' => $request->phone,
                        'created_by' => \getInfoLogin()->id,
                        'updated_by' => \getInfoLogin()->id
                    ]);
                    $user->assignRole($request->role);

                    return response()->json([
                        'messages'  => 'New user successfuly created',
                        'redirect'  => '/administrator/users'
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ids = Hashids::decode($id);
        $data = [
            'title' => 'User Detail',
            'mod'   => 'mod_user',
            'user' => User::with('roles')->find($ids[0]),
        ];
        return view('admin.user.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ids = Hashids::decode($id);
        $data = [
            'title' => 'Edit User',
            'mod'   => 'mod_user',
            'roles' => Role::all(),
            'user' => User::with('roles')->find($ids[0]),
            'action' => '/administrator/users/' . $id . '/update'
        ];
        return view('admin.user.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ids = Hashids::decode($id);
        if (\Request::ajax()) {
            $validator = Validator::make($request->all(), [
                'name'      => 'required',
                'username'  => 'required',
                'email'     => 'required|email',
                'block'     => 'required',
                'picture'   => 'image|mimes:jpg,jpeg,png,gif',
                'phone'     => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'messages' => $validator->messages()
                ], 400);
            } else {

                try {
                    $path = 'admin/uploads/img/profile/';
                    $user = User::findOrFail($ids[0]);
                    $fileName = $user->picture;
                    if ($request->file('picture') != null) {
                        if ($fileName != 'user_pic.png') {
                            File::delete($path . $fileName);
                        }
                        $fileName = $request->file('picture')->getClientOriginalName();
                        $request->file('picture')->move(public_path($path), $fileName);
                    }
                    $userUpdate = User::where('id', $ids[0])->update([
                        'name'      => $request->name,
                        'username'  => $request->username,
                        'email'     => $request->email,
                        'block'     => $request->block,
                        'picture'   => $fileName,
                        'phone_number' => $request->phone,
                        'created_by' => \getInfoLogin()->id,
                        'updated_by' => \getInfoLogin()->id
                    ]);
                    $user->syncRoles($request->role);

                    return response()->json([
                        'messages'  => 'User successfuly updated',
                        'redirect'  => '/administrator/users'
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePassword()
    {

        $data = [
            'title' => 'Change Password',
            'mod'   => 'mod_user',
        ];
        return view('admin.user.password', $data);
    }

    public function updatePassword(Request $request)
    {
        $user = getInfoLogin();
        if (\Request::ajax()) {
            $validator = Validator::make(
                $request->all(),
                [
                    'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                        if (!\Hash::check($value, $user->password)) {
                            return $fail(__('The current password is incorrect.'));
                        }
                    }],
                    'new_password' => 'required|same:confirm_password',
                    'confirm_password' => 'required|same:new_password',
                ],
                [
                    'current_password.required' => 'Current password cannot be empty',
                    'new_password.same'    => 'Password is not the same as confirmation password.',
                    'new_password.required' => 'New password cannot be empty',
                    'confirm_password.same' => 'Confirm password is not the same as new password',
                    'confirm_password.required' => 'Confirm password cannot be empty'
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'messages' => $validator->messages()
                ], 400);
            } else {
                try {
                    User::where('id', $user->id)->update(['password' => Hash::make($request->new_password)]);
                    return response()->json([
                        'messages'  => 'Password successfuly updated',
                        'redirect'  => '/administrator/users/change_password'
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

    public function blockUser($id)
    {
        $ids = Hashids::decode($id);
        if (\Request::ajax()) {
            try {
                $user = User::findOrFail($ids[0]);
                $blockUser = User::where('id', $ids[0])->update(['block' => $user->block == 'Y' ? 'N' : 'Y']);
                return response()->json([
                    'messages'  => 'User successfuly blocked',
                    'redirect'  => '/administrator/users'
                ], 200);
            } catch (Exeption $e) {
                return response()->json([
                    'messages' => 'Opps! Something wrong.'
                ], 409);
            }
        } else {
            abort(403);
        }
    }
}
