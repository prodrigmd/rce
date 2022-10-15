<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request -> validate([
           'name' => 'required',
        ]);

        $role = Role::create($validatedData);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.edit', $role)->with('info', 'Rol creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if($role->name == 'SuperAdmin' OR $role->name == 'Admin') {
            if (Auth::user()->can('edit admin')) {
                $permissions = Permission::all();
                return view('admin.roles.edit', compact('role', 'permissions'));
            } else {
                return redirect()->route('roles.index');
            }
        } else {

            $permissions = Permission::all();

            return view('admin.roles.edit', compact('role', 'permissions'));

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validatedData = $request -> validate([
            'name' => 'required',
        ]);

        $role->update($request->all());

        $role->permissions()->sync($request->permissions);
        return redirect()->route('roles.edit', $role)->with('info', 'Rol actualizado con éxito!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('info', 'Rol eliminado con éxito!');
    }
}
