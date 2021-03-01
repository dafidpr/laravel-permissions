<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(\getInfoLogin()->can('read-dashboard'));
        $data = [
            'title' => 'Role Lists',
            'mod'   => 'mod_role',
            'collection' => Role::all()
        ];
        return view('admin.role.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $validator = Validator::make($request->All(), [
                'role'      => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'messages' => $validator->messages()
                ], 400);
            } else {

                try {
                    Role::create([
                        'name'      => $request->role,
                    ]);

                    return response()->json([
                        'messages'  => 'New role successfuly created',
                        'redirect'  => '/administrator/roles'
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
        $ids = Hashids::decode($id);
        if(\Request::ajax()){
            try {
                return response()->json([
                    'response'  => Role::find($ids[0]),
                ], 200);

            } catch (Exeption $e){
                return response()->json([
                    'messages' => 'Opps! Something wrong.'
                ], 409);
            }

        } else {
            abort(403);
        }
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

        $remappedPermission = [];
        $permissions = Permission::all()->pluck('name');

        foreach ($permissions as $permission) {
            $remappedPermission[implode('-',array_slice(explode('-', $permission), 1))][] = $permission;
        }

        $data = [
            'title'         => 'Change Permission',
            'mod'           => 'mod_role',
            'role'          => Role::findOrFail($ids[0]),
            'permissions'   => $remappedPermission,
        ];

        return view('admin.role.change', $data);
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
        if(\Request::ajax()){

            try {
                $role = Role::findOrFail($id);

                if ($request->has('permission')) {
                    $role->syncPermissions($request->permission);
                }

                return response()->json([
                    'messages'  => 'Permission successfuly changed',
                    'redirect'  => '/administrator/roles'
                ], 200);

            } catch (Exeption $e){
                return response()->json([
                    'messages' => 'Opps! Something wrong.'
                ], 409);
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
}
