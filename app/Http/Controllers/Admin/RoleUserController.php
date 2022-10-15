<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.rolesUsers.index', compact('users', 'roles'));
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
        //
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
    public function edit(User $rolesUser)
    {
        if($rolesUser->hasRole(['SuperAdmin','Admin'])) {
            if (Auth::user()->can('edit admin') OR Auth::user()->id == $rolesUser->id) {
                $roles = Role::all();
                return view('admin.rolesUsers.edit', compact('rolesUser', 'roles'));
            } else {
                return redirect()->route('rolesUsers.index');
            }
        } else {
            $roles = Role::all();
            return view('admin.rolesUsers.edit', compact('rolesUser', 'roles'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $rolesUser)
    {
//        $validatedData = $request -> validate([
//            'name' => 'required',
//        ]);

//        $role->update($request->all());

//        $user->roles()->sync($request->roles);
        $rolesUser->syncRoles($request->roles);
        return redirect()->route('rolesUsers.edit', $rolesUser)->with('info', 'Roles de usuario actualizados con éxito!');
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
