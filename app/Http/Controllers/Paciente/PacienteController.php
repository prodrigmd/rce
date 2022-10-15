<?php

namespace App\Http\Controllers\Paciente;

use App\Models\Hospital;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PacienteController extends Controller
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

        $pacientes = DB::table('pacientes')
//        ->where('pacientes.status', '<>', '3')
//            ->orderByRaw('pacientes.scheduled DESC, ISNULL(pacientes.action_next_date), pacientes.action_next_date ASC')
            ->orderByRaw('FIELD(pacientes.scheduled, "1", "2", "0") ASC, ISNULL(pacientes.action_next_date), pacientes.action_next_date ASC, pacientes.hospital')
        ->get();

        $hospitals = Hospital::orderBy('shortName')
            ->get();

        $action_names = DB::table('action_names')
            ->orderBy('action_names.shortName')
            ->get();

        return view('pacientes.index', compact('pacientes', 'hospitals', 'action_names'));
    }

    public function index_hosp()
    {

        $pacientes = DB::table('pacientes')
            ->where('pacientes.status', '=', '1')
//            ->orderByRaw('pacientes.scheduled DESC, ISNULL(pacientes.action_next_date), pacientes.action_next_date ASC')
            ->orderByRaw('FIELD(pacientes.scheduled, "1", "2", "0") ASC, ISNULL(pacientes.action_next_date), pacientes.action_next_date ASC')
            ->get();

        $hospitals = Hospital::orderBy('shortName')
            ->get();

        $action_names = DB::table('action_names')
            ->orderBy('action_names.shortName')
            ->get();

        return view('pacientes.index_hosp', compact('pacientes', 'hospitals', 'action_names'));
    }

    public function index_amb()
    {

        $pacientes = DB::table('pacientes')
            ->where('pacientes.status', '=', '2')
//            ->orderByRaw('pacientes.scheduled DESC, ISNULL(pacientes.action_next_date), pacientes.action_next_date ASC')
            ->orderByRaw('FIELD(pacientes.scheduled, "1", "2", "0") ASC, ISNULL(pacientes.action_next_date), pacientes.action_next_date ASC')
            ->get();

        $hospitals = Hospital::orderBy('shortName')
            ->get();

        $action_names = DB::table('action_names')
            ->orderBy('action_names.shortName')
            ->get();

        return view('pacientes.index_amb', compact('pacientes', 'hospitals', 'action_names'));
    }

    public function index_alta()
    {

        $pacientes = DB::table('pacientes')
            ->where('pacientes.status', '=', '3')
            ->orderByRaw('ISNULL(pacientes.action_last_date), pacientes.action_last_date DESC')
            ->get();

        $hospitals = Hospital::orderBy('shortName')
            ->get();

        $action_names = DB::table('action_names')
            ->orderBy('action_names.shortName')
            ->get();

        return view('pacientes.index_alta', compact('pacientes', 'hospitals', 'action_names'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hospitals = Hospital::orderBy('shortName')
            ->get();

        return view('pacientes.create', compact('hospitals'));
    }

    public function create_action(Paciente $paciente)
    {
        $editable = DB::table('pacientes')
            ->where('pacientes.id', '=', $paciente->id)
            ->get();

        $age = Carbon::parse($paciente->dob)->diff(Carbon::now())->y;

        $action_names = DB::table('action_names')
            ->orderBy('action_names.name')
            ->get();

        $action_types = DB::table('action_types')
            ->orderBy('action_types.id')
            ->get();

        $hospital_actual = DB::table('hospitals')
            ->where('hospitals.id', '=', $paciente->hospital)
            ->get();

        $status_actual = DB::table('status')
            ->where('status.id', '=', $paciente->status)
            ->get();

        return view('pacientes.action_create_edit', compact('editable', 'age', 'action_names', 'action_types', 'hospital_actual', 'status_actual'));
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
            'lastName1' => 'required|min:3',
            'lastName2' => 'nullable',
            'sex' => 'required',
            'rut' => 'nullable',
            'dob' => 'nullable',
            'email' => 'nullable|email:rfc,dns',
            'phone' => 'nullable',
            'address' => 'nullable',
            'insurance' => 'nullable',
            'hospital' => 'nullable',
            'diagnosis' => 'nullable',
            'status' => 'required|integer|in:1,2,3',
            'description' => 'nullable',
        ]);

        $editable = new Paciente();
        $editable->name = $validatedData['name'];
        $editable->lastName1 = $validatedData['lastName1'];
        $editable->lastName2 = $validatedData['lastName2'];
        $editable->sex = $validatedData['sex'];
        $editable->rut = $validatedData['rut'];
        $editable->dob = $validatedData['dob'];
        $editable->email = $validatedData['email'];
        $editable->phone = $validatedData['phone'];
        $editable->address = $validatedData['address'];
        $editable->insurance = $validatedData['insurance'];
        $editable->hospital = $validatedData['hospital'];
        $editable->diagnosis = $validatedData['diagnosis'];
        $editable->status = $validatedData['status'];
        $editable->description = $validatedData['description'];
        $editable->save();

        return redirect()->route('paciente.edit', [$editable, 'origen'=>'index'])->with(['info'=> 'Paciente creado exitosamente!']);
    }

    public function store_action(Request $request)
    {
        $validatedData = $request -> validate([
            'action_name' => 'required',
            'action_type' => 'required',
            'date' => 'required',
//            'users_id' => 'required',
            'pacientes_id' => 'required',
            'description' => 'required|min:20',
        ]);

        $date_in_database = Carbon::parse($validatedData['date'])->format('Y-m-d H:i:s');
//        dd($date_in_database);

        $values = array(
            'action_name' => $validatedData['action_name'],
            'action_type' => $validatedData['action_type'],
            'date' => $date_in_database,
            'users_id' => auth()->id(),
            'pacientes_id' => $validatedData['pacientes_id'],
            'description' => $validatedData['description']
        );

        DB::table('actions')
            ->insert($values);

        $dataId = DB::getPdo()->lastInsertId();

//        return redirect()->route('paciente.show', $validatedData['pacientes_id'])->with(['info'=> 'Atención creada exitosamente!']);
        return redirect()->route('paciente_action.edit', [$validatedData['pacientes_id'], $dataId])->with(['info'=> 'Atención editada exitosamente!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        $editable = DB::table('pacientes')
            ->where('pacientes.id', '=', $paciente->id)
            ->get();

        $age = Carbon::parse($paciente->dob)->diff(Carbon::now())->y;

        //$date = Carbon::now()->format('Ymd_His');
//        $date = new Carbon($editable->date)

        $hospital_actual = DB::table('hospitals')
            ->where('hospitals.id', '=', $paciente->hospital)
            ->get();

        $status_actual = DB::table('status')
            ->where('status.id', '=', $paciente->status)
            ->get();

        $actions = DB::table('actions')
            ->where('actions.pacientes_id', '=', $paciente->id)
            ->orderBy('actions.date')
            ->get();

        $action_names = DB::table('action_names')
            ->orderBy('action_names.name')
            ->get();

        $action_types = DB::table('action_types')
            ->orderBy('action_types.name')
            ->get();

        $authors = DB::table('users')
            ->get();

        return view('pacientes.show', compact('editable', 'age', 'hospital_actual', 'status_actual', 'actions', 'action_names', 'action_types', 'authors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente, $origen)
    {
//        dd($origen);
        $editable = DB::table('pacientes')
            ->where('pacientes.id', '=', $paciente->id)
//            ->join('areas', 'patologia_categories.areas_id', '=', 'areas.id')
//            ->select('patologia_categories.*', 'areas.name as area_name')
            ->get();

        $age = Carbon::parse($paciente->dob)->diff(Carbon::now())->y;

        $hospitals = Hospital::orderBy('shortName')
            ->get();

        $action_names = DB::table('action_names')
            ->orderBy('action_names.shortName')
            ->get();

//        return view('pacientes.edit', compact('editable', 'areas'));
        return view('pacientes.edit', compact('editable', 'age', 'hospitals', 'origen','action_names'));
    }

    public function edit_action(Paciente $paciente, $action)
    {
        $editable = DB::table('pacientes')
            ->where('pacientes.id', '=', $paciente->id)
            ->get();

        $age = Carbon::parse($paciente->dob)->diff(Carbon::now())->y;

        $action_actual = DB::table('actions')
            ->where('actions.id', '=', $action)
            ->get();

//        dd($action_actual[0]->description);
//
        $action_names = DB::table('action_names')
            ->orderBy('action_names.name')
            ->get();

        $action_types = DB::table('action_types')
            ->orderBy('action_types.id')
            ->get();

        $hospital_actual = DB::table('hospitals')
            ->where('hospitals.id', '=', $paciente->hospital)
            ->get();

        $status_actual = DB::table('status')
            ->where('status.id', '=', $paciente->status)
            ->get();

        return view('pacientes.action_create_edit', compact('editable', 'age', 'action_names', 'action_types', 'hospital_actual', 'status_actual', 'action_actual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente, $origen)
    {
        $validatedData = $request -> validate([
            'name' => 'required|min:3',
            'lastName1' => 'required|min:3',
            'lastName2' => 'nullable',
            'sex' => 'required',
            'rut' => 'nullable',
            'dob' => 'nullable',
            'email' => 'nullable|email:rfc,dns',
            'phone' => 'nullable',
            'address' => 'nullable',
            'insurance' => 'nullable',
            'hospital' => 'nullable',
            'diagnosis' => 'nullable',
            'status' => 'required|integer|in:1,2,3',
            'action_last' => 'nullable',
            'action_last_date' => 'nullable',
            'action_next' => 'nullable',
            'action_next_date' => 'nullable',
            'scheduled' => 'nullable',
            'description' => 'nullable',
        ]);
//        $action_last_date_modified = Carbon::parse($validatedData['action_last_date'])->format('Y-m-d H:i:s');
        $action_last_date_modified =
            $validatedData['action_last_date'] == null ? $validatedData['action_last_date'] :
            Carbon::parse($validatedData['action_last_date'])->format('Y-m-d H:i:s');
//        $action_next_date_modified = Carbon::parse($validatedData['action_next_date'])->format('Y-m-d H:i:s');
        $action_next_date_modified =
            $validatedData['action_next_date'] == null ? $validatedData['action_next_date'] :
            Carbon::parse($validatedData['action_next_date'])->format('Y-m-d H:i:s');
//        dd($patologiaCategory);
//        $editable = PatologiaCategory::find($patologiaCategory->id);
        $editable = $paciente;

//        $editable->id = $validatedData['id'];
        $editable->name = $validatedData['name'];
        $editable->lastName1 = $validatedData['lastName1'];
        $editable->lastName2 = $validatedData['lastName2'];
        $editable->sex = $validatedData['sex'];
        $editable->rut = $validatedData['rut'];
        $editable->dob = $validatedData['dob'];
        $editable->email = $validatedData['email'];
        $editable->phone = $validatedData['phone'];
        $editable->address = $validatedData['address'];
        $editable->insurance = $validatedData['insurance'];
        $editable->hospital = $validatedData['hospital'];
        $editable->diagnosis = $validatedData['diagnosis'];
        $editable->status = $validatedData['status'];
        $editable->action_last = $validatedData['action_last'];
//        $editable->action_last_date = $validatedData['action_last_date'];
        $editable->action_last_date = $action_last_date_modified;
        $editable->action_next = $validatedData['action_next'];
//        $editable->action_next_date = $validatedData['action_next_date'];
        $editable->action_next_date = $action_next_date_modified;
        $editable->scheduled = $validatedData['scheduled'];
        $editable->description = $validatedData['description'];
        $editable->save();

//        $areas = Area::orderBy('order')
//            ->get();

        $origen = $origen;

//        return redirect()->route('paciente.edit', $editable)->with(['info'=> 'Paciente actualizado con éxito!', 'editable'=>$editable]);
        return redirect()->route('paciente.edit', [$editable, 'origen'=>$origen])->with(['info'=> 'Paciente actualizado con éxito!', 'editable'=>$editable]);
    }

    public function update_action(Request $request, $action)
    {
        $validatedData = $request -> validate([
            'action_name' => 'required',
            'action_type' => 'required',
            'date' => 'required',
            'pacientes_id' => 'required',
            'description' => 'required|min:20',
        ]);

        $date_in_database = Carbon::parse($validatedData['date'])->format('Y-m-d H:i:s');

        $values = array(
            'action_name' => $validatedData['action_name'],
            'action_type' => $validatedData['action_type'],
            'date' => $date_in_database,
            'users_id' => auth()->id(),
            'pacientes_id' => $validatedData['pacientes_id'],
            'description' => $validatedData['description']
        );

        DB::table('actions')
            ->where('actions.id', '=', $action)
            ->update($values);

        return redirect()->route('paciente_action.edit', [$validatedData['pacientes_id'], $action])->with(['info'=> 'Atención guardada exitosamente!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        $actionsToDelete = DB::table('actions')
            ->where('actions.pacientes_id', '=', $paciente->id);
        try {
            $actionsToDelete->delete();
        } catch (QueryException $exception) {
            return back()->withError('Error of Query')->withInput();
        }

        $editable = Paciente::where('id','=',$paciente->id);
        try {
            $editable->delete();
        } catch (QueryException $exception) {
            return back()->withError('Error of Query')->withInput();
        }

        return redirect()->route('paciente.index')->with('info', 'Paciente eliminado con éxito!');
    }

    public function destroy_action(Paciente $paciente, $action)
    {
//        $editable = Paciente::where('id','=',$paciente->id);
        $action_actual = DB::table('actions')
            ->where('actions.id', '=', $action);
        try {
            $action_actual->delete();
        } catch (QueryException $exception) {
            return back()->withError('Error of Query')->withInput();
        }

        $editable = DB::table('pacientes')
            ->where('pacientes.id', '=', $paciente->id)
            ->get();

        $age = Carbon::parse($paciente->dob)->diff(Carbon::now())->y;

        //$date = Carbon::now()->format('Ymd_His');
//        $date = new Carbon($editable->date)

        $hospital_actual = DB::table('hospitals')
            ->where('hospitals.id', '=', $paciente->hospital)
            ->get();

        $status_actual = DB::table('status')
            ->where('status.id', '=', $paciente->status)
            ->get();

        $actions = DB::table('actions')
            ->where('actions.users_id', '=', $paciente->id)
            ->orderBy('actions.date')
            ->get();

        $action_names = DB::table('action_names')
            ->orderBy('action_names.name')
            ->get();

        $action_types = DB::table('action_types')
            ->orderBy('action_types.name')
            ->get();

        $authors = DB::table('users')
            ->get();

        $paciente = $paciente->id;

//        return view('pacientes.show', compact('editable', 'age', 'hospital_actual', 'status_actual', 'actions', 'action_names', 'action_types', 'authors'))->with('info', 'Atención eliminada con éxito!');
//        return view('pacientes.show', compact('editable', 'age', 'hospital_actual', 'status_actual', 'actions', 'action_names', 'action_types', 'authors'));

        return redirect()->route('paciente.show', compact('paciente', 'editable', 'age', 'hospital_actual', 'status_actual', 'actions', 'action_names', 'action_types', 'authors'))
            ->with('info', 'Atención eliminada con éxito!');


    }
}
