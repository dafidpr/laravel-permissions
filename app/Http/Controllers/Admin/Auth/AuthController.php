<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class AuthController extends Controller
{
    public function index(){

        $data = [
            'title' => 'Sign In',
        ];
        return view('admin.auth.index', $data);
    }

    public function postLogin(Request $request)
    {

        if(\Request::ajax()){
            $validator = Validator::make($request->All(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'messages' => $validator->messages()
                ], 400);
            } else {

                try {

                    $user = User::where('email', $request->post('email'))->first();
                    if (Auth::guard('web')->attempt($request->only(['email', 'password']))) {
                        if($user->block == 'Y'){
                            return response()->json([
                                'messages' => 'Your account is blocked'
                            ], 403);
                        } else {
                            $request->session()->put('user', [
                                'id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'picture' => $user->picture,
                            ]);
                            $user->last_login = Carbon::now();
                            $user->save();
    
                            return response()->json([
                                'redirect' => '/administrator/dashboard'
                            ], 200);
                        }
                    } else {
                        return response()->json([
                            'messages' => 'Wrong email or password'
                        ], 404);
                    }
    
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

    public function logout(Request $request)
    {
        $request->session()->remove('user');
        return redirect(config('redirects.redirectIfUnAuth'));
    }

}
