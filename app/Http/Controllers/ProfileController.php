<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
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
    public function edit(User $user)
    {
        $self_user = Auth::user();

        if ($self_user->id == $user->id) {
            return view('profile.edit', compact('user'));
        } else {
            return redirect()->route('profile');
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
            'old_password' => 'nullable',
            'password' => 'nullable|confirmed|min:3|different:old_password',
        ]);
//
//        dd($validatedData);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if ($validatedData['password'] != null) {
            if(Hash::check($validatedData['old_password'], $user->password)) {
                $user->password = Hash::make($validatedData['password']);
            } else {
                return redirect()->route('profile.edit', $user)
                    ->with('badOld', 'Password actual no es correcto');
            }

        } elseif ($validatedData['old_password'] != null) {
            if(Hash::check($validatedData['old_password'], $user->password)) {

            } else {
                return redirect()->route('profile.edit', $user)
                    ->with('badOld', 'Password actual no es correcto');
            }
        }
        $user->save();

        return redirect()->route('profile.edit', $user)->with('info', 'Perfil actualizado con éxito!');
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
