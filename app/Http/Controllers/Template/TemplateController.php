<?php

namespace App\Http\Controllers\Template;

use App\Models\Surgery;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TemplateController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Surgery $surgery)
    {
        $areas = DB::table('areas')
            ->orderBy('areas.name')
            ->get();

        return view('templates.create', compact('surgery', 'areas'));
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
            'surgeries_id' => 'required',
            'description' => 'required|min:20',
        ]);

        $editable = new Template();
        $editable->name = $validatedData['name'];
        $editable->shortName = $validatedData['shortName'];
        $editable->surgeries_id = $validatedData['surgeries_id'];
        $editable->description = $validatedData['description'];
        $editable->save();

        return redirect()->route('template.edit', $editable)->with(['info'=> 'Template creado exitosamente!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        $editable = DB::table('templates')
            ->where('templates.id', '=', $template->id)
            ->get();

//        dd($editable[0]->name);

        $surgery = DB::table('surgeries')
            ->where('surgeries.id', '=', $editable[0]->surgeries_id)
            ->get();

        return view('templates.edit', compact('editable', 'surgery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        $validatedData = $request -> validate([
            'name' => 'required|min:3',
            'shortName' => 'required|min:3',
            'description' => 'required|min:20',
        ]);

        $editable = DB::table('templates')
            ->where('templates.id', '=', $template->id)
            ->get();

//        dd($validatedData['name']);

        $editable = $template;

        $editable->name = $validatedData['name'];
        $editable->shortName = $validatedData['shortName'];
        $editable->description = $validatedData['description'];
        $editable->save();

        return redirect()->route('template.edit', $editable)->with(['info'=> 'Template actualizado con éxito!', 'editable'=>$editable]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        $editable = Template::where('id','=',$template->id);
        try {
            $editable->delete();
        } catch (QueryException $exception) {
            return back()->withError('Error of Query')->withInput();
        }

        return redirect()->route('surgery.edit', $template->surgeries_id)->with('info', 'Template eliminado con éxito!');
//        return redirect()->route('paciente.show', compact('paciente', 'editable', 'age', 'hospital_actual', 'status_actual', 'actions', 'action_names', 'action_types', 'authors'))
//            ->with('info', 'Atención eliminada con éxito!');
    }
}
