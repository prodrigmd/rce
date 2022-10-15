<?php

namespace App\Http\Controllers\Protocol;

use App\Models\Protocol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProtocolController extends Controller
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
        $protocols = DB::table('protocols')
            ->orderBy('protocols.name')
            ->get();

        return view('protocols.index', compact('protocols'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('protocols.create');
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
            'description' => 'nullable',
        ]);

        $editable = new Protocol();
        $editable->name = $validatedData['name'];
        $editable->description = $validatedData['description'];
        $editable->save();

        return redirect()->route('protocol.edit', $editable)->with(['info'=> 'Protocolo creado exitosamente!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Protocol  $protocol
     * @return \Illuminate\Http\Response
     */
    public function show(Protocol $protocol)
    {
        $editable = DB::table('protocols')
            ->where('protocols.id', '=', $protocol->id)
            ->get();

        return view('protocols.show', compact('editable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Protocol  $protocol
     * @return \Illuminate\Http\Response
     */
    public function edit(Protocol $protocol)
    {
        $editable = DB::table('protocols')
            ->where('protocols.id', '=', $protocol->id)
            ->get();

        return view('protocols.edit', compact('editable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Protocol  $protocol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Protocol $protocol)
    {
        $validatedData = $request -> validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
        ]);

        $editable = $protocol;

        $editable->name = $validatedData['name'];
        $editable->description = $validatedData['description'];
        $editable->save();

        return redirect()->route('protocol.edit', $editable)->with(['info'=> 'Protocolo actualizado con éxito!', 'editable'=>$editable]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Protocol  $protocol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Protocol $protocol)
    {
        $editable = Protocol::where('id','=',$protocol->id);
        try {
            $editable->delete();
        } catch (QueryException $exception) {
            return back()->withError('Error of Query')->withInput();
        }

        return redirect()->route('protocol.index')->with('info', 'Protocolo eliminado con éxito!');
    }
}
