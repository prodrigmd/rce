<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pacientes_hospitalizados = DB::table('pacientes')
            ->where('pacientes.status', '=', '1')
            ->orderBy('pacientes.hospital')
            ->get();

        $hospCount = $pacientes_hospitalizados->count();

        $pacientes_agenda = DB::table('pacientes')
            ->where('pacientes.scheduled', '=', '1')
            ->orderBy('pacientes.action_next_date')
            ->get();

        $agendaCount = $pacientes_agenda->count();

        $pacientes_porprogramar = DB::table('pacientes')
            ->where('pacientes.scheduled', '=', '2')
//            ->orderBy('pacientes.action_next_date')
            ->orderByRaw('ISNULL(pacientes.action_next_date), pacientes.action_next_date ASC')
            ->get();

        $porProgCount = $pacientes_porprogramar->count();

        $hospitals = Hospital::orderBy('shortName')
            ->get();

        $action_names = DB::table('action_names')
            ->orderBy('action_names.shortName')
            ->get();

        return view('home', compact('pacientes_hospitalizados', 'pacientes_agenda', 'pacientes_porprogramar', 'hospitals', 'action_names',
        'hospCount', 'agendaCount', 'porProgCount'));
    }
}
