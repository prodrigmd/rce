<?php

namespace App\Http\Controllers\Document;

use App\Models\Document;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DocumentController extends Controller
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
        $documents = DB::table('documents')
            ->orderBy('documents.date')
            ->get();

        $document_types = DB::table('documents_type')
            ->orderBy('documents_type.name')
            ->get();

        $document_type_subtypes = DB::table('documents_type_subtype')
            ->orderBy('documents_type_subtype.name')
            ->get();

        return view('documents.index', compact('documents', 'document_types', 'document_type_subtypes'));
    }

    public function index_types()
    {
        $document_types = DB::table('documents_type')
            ->orderBy('documents_type.name')
            ->get();

        return view('documents.index_types', compact('document_types'));
    }

    public function index_type_subtypes()
    {
        $document_type_subtypes = DB::table('documents_type_subtype')
            ->orderBy('documents_type_subtype.name')
            ->get();

        $document_types = DB::table('documents_type')
            ->orderBy('documents_type.name')
            ->get();

        return view('documents.index_type_subtypes', compact('document_type_subtypes', 'document_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validatedData = $request -> validate([
//            'documents_type_id' => 'required',
            'documents_type_subtype_id' => 'required',
        ]);

//        $myType = $validatedData['documents_type_id'];
        $mySubtype = $validatedData['documents_type_subtype_id'];

        $subtype = DB::table('documents_type_subtype')
//            ->orderBy('documents_type_subtype.name')
                ->where('documents_type_subtype.id', '=', $mySubtype)
            ->get();

//        dd($subtype[0] -> shortName);

        $type = DB::table('documents_type')
//            ->orderBy('documents_type.name')
            ->where('documents_type.id', '=', $subtype[0] -> documents_type_id)
            ->get();

//        dd($type[0]->name);

        return view('documents.create', compact('type', 'subtype'));
    }

    public function create_types()
    {
        return view('documents.create_types');
    }

    public function create_type_subtypes()
    {
        $types = DB::table('documents_type')
            ->orderBy('documents_type.name')
            ->get();

        return view('documents.create_type_subtypes', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pathway = $request->input('pathway');

        if ($pathway == 'receta'){
            $validatedData = $request -> validate([
                'patientName' => 'required|min:3',
                'patientAge' => 'required',
                'patientRUT' => 'required',
                'patientAddress' => 'nullable',
                'patientCity' => 'nullable',
                'date' => 'required',
                'description' => 'nullable',
                'documents_type_id' => 'required',
                'documents_type_subtype_id' => 'required',
            ]);

            $date_modified =
                $validatedData['date'] == null ? $validatedData['date'] :
                    Carbon::parse($validatedData['date'])->format('Y-m-d H:i:s');

            $values = array(
                'patientName' => $validatedData['patientName'],
                'patientAge' => $validatedData['patientAge'],
                'patientRUT' => $validatedData['patientRUT'],
                'patientAddress' => $validatedData['patientAddress'],
                'patientCity' => $validatedData['patientCity'],
                'date' => $date_modified,
                'description' => $validatedData['description'],
                'documents_type_id' => $validatedData['documents_type_id'],
                'documents_type_subtype_id' => $validatedData['documents_type_subtype_id'],
            );
        }
        else {
            dd('Poing');
        }

        DB::table('documents')
            ->insert($values);

        $dataId = DB::getPdo()->lastInsertId();

        return redirect()->route('document.edit', $dataId)->with(['info'=> 'Documento agregado exitosamente!']);
    }

    public function store_types(Request $request)
    {
        $validatedData = $request -> validate([
            'name' => 'required|min:3',
            'shortName' => 'required|min:2',
        ]);

        $values = array(
            'name' => $validatedData['name'],
            'shortName' => $validatedData['shortName'],
        );

        DB::table('documents_type')
            ->insert($values);

        $dataId = DB::getPdo()->lastInsertId();

        return redirect()->route('document_types.edit', $dataId)->with(['info'=> 'Tipo de documento agregado exitosamente!']);
    }

    public function store_type_subtypes(Request $request)
    {
        $validatedData = $request -> validate([
            'name' => 'required|min:3',
            'shortName' => 'required|min:2',
            'documents_type_id' => 'required',
        ]);

        $values = array(
            'name' => $validatedData['name'],
            'shortName' => $validatedData['shortName'],
            'documents_type_id' => $validatedData['documents_type_id'],
        );

        DB::table('documents_type_subtype')
            ->insert($values);

        $dataId = DB::getPdo()->lastInsertId();

        return redirect()->route('document_type_subtypes.edit', $dataId)->with(['info'=> 'Subipo de documento agregado exitosamente!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $editable = DB::table('documents')
            ->where('documents.id', '=', $document->id)
            ->get();

        $types = DB::table('documents_type')
            ->orderBy('documents_type.name')
            ->get();

        $myType = DB::table('documents_type')
            ->where('documents_type.id', '=', $editable[0]->documents_type_id)
            ->get();

        $subtypes = DB::table('documents_type_subtype')
            ->where('documents_type_subtype.documents_type_id', '=', $myType[0]->id)
            ->orderBy('documents_type_subtype.name')
            ->get();

        $mySubtype = DB::table('documents_type_subtype')
            ->where('documents_type_subtype.id', '=', $editable[0]->documents_type_subtype_id)
            ->get();

        return view('documents.edit', compact('editable', 'types', 'subtypes', 'myType', 'mySubtype'));
    }

    public function edit_types(Document $document, $type)
    {
        $editable = DB::table('documents_type')
            ->where('documents_type.id', '=', $type)
            ->get();

        return view('documents.edit_types', compact('editable', 'type'));
    }

    public function edit_type_subtypes(Document $document, $subtype)
    {
        $editable = DB::table('documents_type_subtype')
            ->where('documents_type_subtype.id', '=', $subtype)
            ->get();

        $types = DB::table('documents_type')
            ->orderBy('documents_type.name')
            ->get();

        return view('documents.edit_type_subtypes', compact('editable', 'types'));
    }

    public function edit_image(Document $document, $subtype)
    {
        $editable = DB::table('documents_type_subtype')
            ->where('documents_type_subtype.id', '=', $subtype)
            ->get();

        $myType = DB::table('documents_type')
//            ->orderBy('documents_type.name')
                ->where('documents_type.id', '=', $editable[0]->documents_type_id)
            ->get();

        return view('documents.edit_images', compact('editable', 'myType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $validatedData = $request -> validate([
            'patientName' => 'required|min:3',
            'patientAge' => 'required',
            'patientRUT' => 'required',
            'patientAddress' => 'nullable',
            'patientCity' => 'nullable',
            'surgeonName' => 'nullable',
            'surgeonRUT' => 'nullable',
            'surgeonSpecialty' => 'nullable',
            'date' => 'required',
            'dateSurgery' => 'nullable',
            'anesthesiaName' => 'nullable',
            'anesthesiaRUT' => 'nullable',
            'arsenaleraName' => 'nullable',
            'arsenaleraRUT' => 'nullable',
            'surgeryTime' => 'nullable',
            'email' => 'nullable',
            'description' => 'nullable',
            'documents_type_subtype_id' => 'nullable',
        ]);

//        dd($validatedData['patientName']);

        $date_modified =
            $validatedData['date'] == null ? $validatedData['date'] :
                Carbon::parse($validatedData['date'])->format('Y-m-d H:i:s');

        if (isset($validatedData['dateSurgery'])) {
            $dateSurgery_modified = Carbon::parse($validatedData['dateSurgery'])->format('Y-m-d H:i:s');
        }

        $values = array(
            'patientName' => $validatedData['patientName'],
            'patientAge' => $validatedData['patientAge'],
            'patientRUT' => $validatedData['patientRUT'],
            'patientAddress' => $validatedData['patientAddress'] ?? null,
            'patientCity' => $validatedData['patientCity'] ?? null,
            'surgeonName' => $validatedData['surgeonName'] ?? null,
            'surgeonRUT' => $validatedData['surgeonRUT'] ?? null,
            'surgeonSpecialty' => $validatedData['surgeonSpecialty'] ?? null,
            'date' => $date_modified ?? null,
            'dateSurgery' => $dateSurgery_modified ?? null,
            'anesthesiaName' => $validatedData['anesthesiaName'] ?? null,
            'anesthesiaRUT' => $validatedData['anesthesiaRUT'] ?? null,
            'arsenaleraName' => $validatedData['arsenaleraName'] ?? null,
            'arsenaleraRUT' => $validatedData['arsenaleraRUT'] ?? null,
            'surgeryTime' => $validatedData['surgeryTime'] ?? null,
            'email' => $validatedData['email'] ?? null,
            'description' => $validatedData['description'] ?? null,
            'documents_type_subtype_id' => $validatedData['documents_type_subtype_id'] ?? null,
            'updated_at' => Carbon::now()->toDateTimeString() ?? null
        );

        DB::table('documents')
            ->where('documents.id', '=', $document->id)
            ->update($values);

        return redirect()->route('document.edit', $document)->with(['info'=> 'Documento actualizado exitosamente!']);
    }

    public function update_types(Request $request, Document $document, $type)
    {
        $validatedData = $request -> validate([
            'name' => 'required|min:3',
            'shortName' => 'required|min:2',
        ]);

        $values = array(
            'name' => $validatedData['name'],
            'shortName' => $validatedData['shortName'],
            'updated_at' => Carbon::now()->toDateTimeString()
        );

        DB::table('documents_type')
            ->where('documents_type.id', '=', $type)
            ->update($values);

        return redirect()->route('document_types.edit', $type)->with(['info'=> 'Tipo de documento actualizado exitosamente!']);
    }

    public function update_type_subtypes(Request $request, Document $document, $subtype)
    {
        $validatedData = $request -> validate([
            'name' => 'required|min:3',
            'shortName' => 'required|min:2',
            'documents_type_id' => 'required',
        ]);

        $values = array(
            'name' => $validatedData['name'],
            'shortName' => $validatedData['shortName'],
            'documents_type_id' => $validatedData['documents_type_id'],
            'updated_at' => Carbon::now()->toDateTimeString()
        );

        DB::table('documents_type_subtype')
            ->where('documents_type_subtype.id', '=', $subtype)
            ->update($values);

        return redirect()->route('document_type_subtypes.edit', $subtype)->with(['info'=> 'Subtipo de documento actualizado exitosamente!']);
    }

    public function update_subtypes_xy(Request $request, Document $document, $subtype)
    {
        $validatedData = $request -> validate([
//            'imagexy_description' => 'required',
            'imagexy' => 'required',
        ]);

        $values = array(
//            'imagexy_description' => $validatedData['imagexy_description'],
            'imagexy' => $validatedData['imagexy'],
            'updated_at' => Carbon::now()->toDateTimeString()
        );

        DB::table('documents_type_subtype')
            ->where('documents_type_subtype.id', '=', $subtype)
            ->update($values);

        return redirect()->route('document_image.edit', $subtype)->with(['info'=> 'Coordenadas actualizadas exitosamente!']);
    }

    public function store_document(Request $request, $subtype)
    {
        $validatedData = $request -> validate([
            'file' => 'nullable',
        ]);

        $file = $validatedData['file'];

        $file_size = $request->file('file')->getSize();

        //Limit is 1GB (1073741824)
        if ($file_size > 1073741824) {
            return redirect()->route('document_type_subtypes.edit', $subtype)->with(['error' => 'Atention ! File > 1GB']);
        } else {
            $file = $request->file('file');

            $name = $file->hashName();
            $date = \Carbon\Carbon::now()->format('Ymd_His');
            $id = $subtype;

            $file_name = $id . '_' . $date . '_' . $name;
            $archive = $request->file('file')->storeAs('documents', $file_name);

            $url = Storage::url($archive);

            $values = array(
                'image' => $file_name,
                'updated_at' => Carbon::now()->toDateTimeString()
            );

            DB::table('documents_type_subtype')
                ->where('documents_type_subtype.id', '=', $subtype)
                ->update($values);

            return redirect()->route('document_type_subtypes.edit', $subtype)->with(['info'=> 'Imagen subida exitosamente!']);
        }
    }

//    public function store_document_image(Document $document)
//    {
//        $editable = DB::table('documents')
//            ->where('documents.id', '=', $document->id)
//            ->get();
//
//        $subtype = DB::table('documents_type_subtype')
//            ->where('documents_type_subtype.id', '=', $editable[0]->documents_type_subtype_id)
//            ->get();
//
//        $file_path = 'storage/documents/'.$subtype[0]->image;
//        $path_main = asset('storage/documents')."/";
//        $path_to = storage_path()."/app/documents/";
//
//        // create Image from file
//
////        dd($path_main.$subtype[0]->image);
//        $img = Image::make($path_main.$subtype[0]->image)
//            ->save($path_to.'test.jpg');
//
//        // write text
//                $img->text('The quick brown fox jumps over the lazy dog.');
//
//        // write text at position
//                $img->text('The quick brown fox jumps over the lazy dog.', 12, 10);
//
////        // use callback to define details
//                $img->text('(c) Neurorad', 800, 800, function($font) {
//                    $path_fonts = storage_path()."/app/fonts/";
//                    $font->file($path_fonts.'Wisteria.ttf');
//                    $font->size(240);
//                    $font->color('#f93d15');
//                    $font->align('center');
//                    $font->valign('top');
//                    $font->angle(45);
//                });
//
//                $img->save($path_to.'test2.jpg');
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
//        dd($document->id);
        $editable = DB::table('documents')
            ->where('documents.id', '=', $document->id);
        try {
            $editable->delete();
        } catch (QueryException $e) {
            return back()->withError('Error of Query')->withInput();
        }

        return redirect()->route('document.index')->with('info', 'Documento eliminado con éxito!');
    }

    public function destroy_types(Document $document, $type)
    {
        $editable = DB::table('documents_type')
            ->where('documents_type.id', '=', $type);
        try {
            $editable->delete();
        } catch (QueryException $e) {
            return back()->withError('Error of Query')->withInput();
        }

        return redirect()->route('document_types.index')->with('info', 'Tipo de documento eliminado con éxito!');
    }

    public function destroy_type_subtypes(Document $document, $subtype)
    {
        $editable = DB::table('documents_type_subtype')
            ->where('documents_type_subtype.id', '=', $subtype);
        try {
            $editable->delete();
        } catch (QueryException $e) {
            return back()->withError('Error of Query')->withInput();
        }

        return redirect()->route('document_type_subtypes.index')->with('info', 'Subtipo de documento eliminado con éxito!');
    }

//    public function destroy_document(Document $document, $subtype)
//    {
//        $editable = DB::table('documents_type_subtype')
//            ->where('documents_type_subtype.id', '=', $subtype)
//            ->get();
//
//        $file_path = 'documents/'.$editable[0]->image;
//
//        Storage::delete($file_path);
//
//        $values = array(
//            'image' => null,
//            'updated_at' => Carbon::now()->toDateTimeString()
//        );
//
//        $editable = DB::table('documents_type_subtype')
//            ->where('documents_type_subtype.id', '=', $subtype)
//            ->update($values);
//
//        return redirect()->route('document_type_subtypes.edit', $subtype)->with(['info'=> 'Imagen eliminada exitosamente!']);
//    }
}
