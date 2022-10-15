<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'email' => 'required',
            'password' => 'required|confirmed|min:3',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);


        return redirect()->route('users.edit', $user)->with('info', 'Usuario creado exitosamente!');
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
    public function edit(User $user)
    {
        if($user->hasRole(['SuperAdmin','Admin'])) {
            if (Auth::user()->can('edit admin')) {
                return view('admin.users.edit', compact('user'));
            } else {
                return redirect()->route('users.index');
            }

        } else {
            return view('admin.users.edit', compact('user'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validatedData = $request -> validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|confirmed|min:3',
        ]);
//
//        dd($validatedData);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if ($validatedData['password'] != null) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();

        return redirect()->route('users.edit', $user)->with('info', 'Usuario actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
//        dd($user);
        return redirect()->route('users.index')->with('info', 'Usuario eliminado con éxito!');
    }
}
