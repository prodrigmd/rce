<?php

namespace App\Http\Controllers\Hospital;

use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitales = DB::table('hospitals')
            ->get();

        return view('hospitales.index', compact('hospitales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hospitales.create');
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
            'name' => 'required|min:3',
            'shortName' => 'required|min:3',
            'is_main' => 'required',
            'is_public' => 'required',
            'description' => 'nullable',
        ]);

        $editable = new Hospital();
        $editable->name = $validatedData['name'];
        $editable->shortName = $validatedData['shortName'];
        $editable->is_main = $validatedData['is_main'];
        $editable->is_public = $validatedData['is_public'];
        $editable->description = $validatedData['description'];
        $editable->save();

        return redirect()->route('hospital.edit', $editable)->with(['info'=> 'Hospital creado exitosamente!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        $editable = DB::table('hospitals')
            ->where('hospitals.id', '=', $hospital->id)
            ->get();

        return view('hospitales.edit', compact('editable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hospital $hospital)
    {
        $validatedData = $request -> validate([
            'name' => 'required|min:3',
            'shortName' => 'required|min:3',
            'is_main' => 'required',
            'is_public' => 'required',
            'description' => 'nullable',
        ]);
        $editable = $hospital;

        $editable->name = $validatedData['name'];
        $editable->shortName = $validatedData['shortName'];
        $editable->is_main = $validatedData['is_main'];
        $editable->is_public = $validatedData['is_public'];
        $editable->description = $validatedData['description'];
        $editable->save();

        return redirect()->route('hospital.edit', $editable)->with(['info'=> 'Hospital actualizado con éxito!', 'editable'=>$editable]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        $editable = Hospital::where('id','=',$hospital->id);
        try {
            $editable->delete();
        } catch (QueryException $exception) {
            return back()->withError('Error of Query')->withInput();
        }

        return redirect()->route('hospital.index')->with('info', 'Hospital eliminado con éxito. Sos un mostro!');
    }
}
