<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

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
            'title' => 'User Lists',
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
            'roles' => Role::all()
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
        if(\Request::ajax()){
            $validator = Validator::make($request->all(), [
                'name'      => 'required',
                'username'  => 'required',
                'email'     => 'required|email',
                'password'  => 'required',
                'block'     => 'required',
                'picture'   => 'image|mimes:jpg,jpeg,png,gif',
                'phone'     => 'required'
            ]);

            if($validator->fails()){
                return response()->json([
                    'messages' => $validator->messages()
                ], 400);
            } else {

                try {
                    $path = 'admin/uploads/img/profile/';
                    $fileName = 'user_pic.png';
                    if($request->file('picture') != null){

                        $fileName = Str::random(35).'.'.$request->file('picture')->extension();
                        $request->file('picture')->move(public_path($path), $fileName);
                    }
                    $user = User::create([
                        'name'      => $request->name,
                        'username'  => $request->username,
                        'email'     => $request->email,
                        'password'  => Hash::make($request->password),
                        'block'     => $request->block,
                        'picture'   => $fileName,
                        'phone'     => $request->phone,
                        'created_by'=> \getInfoLogin()->id,
                        'updated_by'=> \getInfoLogin()->id
                    ]);
                    $user->assignRole($request->role);

                    return response()->json([
                        'messages'  => 'New user successfuly created',
                        'redirect'  => '/administrator/users'
                    ], 200);

                } catch (Exeption $e){
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        if(\Request::ajax()){
            $validator = Validator::make($request->all(), [
                'current_password' => ['required', function($attribute, $value, $fail) use ($user){
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
                'confirm_password.required'=> 'Confirm password cannot be empty'
            ]);

            if($validator->fails()){
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

                } catch (Exeption $e){
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
