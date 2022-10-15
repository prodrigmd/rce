<?php

namespace App\Http\Controllers\Surgery;

use App\Models\Surgery;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SurgeryController extends Controller
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
        $surgeries = DB::table('surgeries')
            ->orderBy('surgeries.name')
            ->get();

        $areas = DB::table('areas')
            ->orderBy('areas.name')
            ->get();

        $templates = DB::table('templates')
            ->orderBy('templates.name')
            ->get();

        return view('surgeries.index', compact('surgeries', 'areas', 'templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = DB::table('areas')
            ->orderBy('areas.name')
            ->get();

        return view('surgeries.create', compact('areas'));
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
            'codigoFonasa' => 'nullable',
            'areas_id' => 'required',
            'description' => 'nullable',
        ]);

        $editable = new Surgery();
        $editable->name = $validatedData['name'];
        $editable->codigoFonasa = $validatedData['codigoFonasa'];
        $editable->areas_id = $validatedData['areas_id'];
        $editable->description = $validatedData['description'];
        $editable->save();

        return redirect()->route('surgery.edit', $editable)->with(['info'=> 'Intervención creada exitosamente!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surgery  $surgery
     * @return \Illuminate\Http\Response
     */
    public function show(Surgery $surgery)
    {
        $editable = DB::table('surgeries')
            ->where('surgeries.id', '=', $surgery->id)
            ->get();

        $templates = DB::table('templates')
            ->where('templates.surgeries_id', '=', $editable[0]->id)
            ->get();

        $area = DB::table('areas')
//            ->orderBy('areas.name')
            ->where('areas.id', '=', $editable[0]->areas_id)
            ->get();

        return view('surgeries.show', compact('editable', 'templates', 'area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surgery  $surgery
     * @return \Illuminate\Http\Response
     */
    public function edit(Surgery $surgery)
    {
        $editable = DB::table('surgeries')
            ->where('surgeries.id', '=', $surgery->id)
            ->get();

        $areas = DB::table('areas')
            ->orderBy('areas.name')
            ->get();

        $templates = DB::table('templates')
            ->orderBy('templates.name')
            ->get();

        return view('surgeries.edit', compact('editable', 'areas', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surgery  $surgery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surgery $surgery)
    {
        $validatedData = $request -> validate([
            'name' => 'required|min:3',
            'codigoFonasa' => 'nullable',
            'areas_id' => 'required',
            'description' => 'nullable',
        ]);

        $editable = $surgery;

        $editable->name = $validatedData['name'];
        $editable->codigoFonasa = $validatedData['codigoFonasa'];
        $editable->areas_id = $validatedData['areas_id'];
        $editable->description = $validatedData['description'];
        $editable->save();

        return redirect()->route('surgery.edit', $editable)->with(['info'=> 'Intervención actualizada con éxito!', 'editable'=>$editable]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surgery  $surgery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surgery $surgery)
    {
        $templatesToErase = Template::where('surgeries_id','=',$surgery->id);
        try {
            $templatesToErase->delete();
        } catch (QueryException $exception) {
            return back()->withError('Error of Query')->withInput();
        }

        $editable = Surgery::where('id','=',$surgery->id);
        try {
            $editable->delete();
        } catch (QueryException $exception) {
            return back()->withError('Error of Query')->withInput();
        }

        return redirect()->route('surgery.index')->with('info', 'Intervención eliminada con éxito!');
    }
}
