<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class RecetaController extends Controller
{
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request -> validate([
            'file' => 'nullable',
            'subtype' => 'nullable',
        ]);

//        $file = $validatedData['file'];
        $subtype = $validatedData['subtype'];

        $file_size = $request->file('file')->getSize();

//        dd($file_size);

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
    public function edit($id)
    {
        $document = DB::table('documents')
            ->where('documents.id', '=', $id)
            ->get();

        $subtype = DB::table('documents_type_subtype')
            ->where('documents_type_subtype.id', '=', $document[0]->documents_type_subtype_id)
            ->get();

        $type = DB::table('documents_type')
            ->where('documents_type.id', '=', $document[0]->documents_type_id)
            ->get();

        function comma_separated_to_array($string_value, $separator)
        {
            //Explode on comma
            $vals     =   explode($separator, $string_value);
            $count    =   count($vals);
            $val      =   array();
            //Trim whitespace
            for($i=0;$i<=$count-1;$i++) {
                $val[]   .=   $vals[$i];
            }
            return $val;
        }

        $myTempArray = (comma_separated_to_array($subtype[0]->imagexy, ';'));

        $myArray = array_fill(0,count($myTempArray),'');
        $myKeys = array_fill(0,count($myTempArray),'');

        for ($x=0; $x<count($myTempArray); $x++){
            $myTempArray2 = explode(',', trim($myTempArray[$x]));
            $myArray[$x] = $myTempArray2;
            $myTempArray2[0] = trim($myTempArray2[0], '[]');
            $myArray[$myTempArray2[0]] = $myArray[$x];
            $myKeys[$x] = $myTempArray2[0];
            unset($myArray[$x]);
            array_shift($myArray[$myTempArray2[0]]);
        }

        $myArrayFiltered = [];
        foreach ($document[0] as $key=>$value){
            if (isset($myArray[$key][0])){
                array_push($myArrayFiltered, $key);
            }
        }

        foreach ($myArrayFiltered as $key=>$value) {
            if (strpos($myArray[$value][0], '/XY:')) {
                $array = (comma_separated_to_array($myArray[$value][0], '/XY:'));
                $arrayXY = (comma_separated_to_array(end($array), '|'));
                $tab = intval($arrayXY[0]);
                $lineHeight = intval($arrayXY[1]);
                $myArray[$value][0] = $document[0]->$value.'/XY:'.$tab.'|'.$lineHeight;
            }
            else {
                $myArray[$value][0] = $document[0]->$value;
            }
        }

        if (isset($myArray['date-d'])){
                $myArray['date-d'][0] = Carbon::parse($document[0]->date)->format('d');
            }
        if (isset($myArray['date-m'])){
                $myArray['date-m'][0] = Carbon::parse($document[0]->date)->format('m');
            }
        if (isset($myArray['date-Y'])){
                $myArray['date-Y'][0] = Carbon::parse($document[0]->date)->format('Y');
            }
        if (isset($myArray['date-d-m-Y'])){
                $myArray['date-d-m-Y'][0] = Carbon::parse($document[0]->date)->format('d-m-Y');
            }
        if (isset($myArray['date-H:i'])){
                $myArray['date-H:i'][0] = Carbon::parse($document[0]->date)->format('H:i');
            }
        if (isset($myArray['dateSurgery-d-m-Y'])){
                $myArray['dateSurgery-d-m-Y'][0] = Carbon::parse($document[0]->dateSurgery)->format('d-m-Y');
            }
        if (isset($myArray['dateSurgery-H:i'])){
                $myArray['dateSurgery-H:i'][0] = Carbon::parse($document[0]->dateSurgery)->format('H:i');
            }

        if (isset($myArray['surgeonName'])) {
            $arraySurgeonsTemp = comma_separated_to_array($myArray['surgeonName'][0], '/XY:');
            array_pop($arraySurgeonsTemp);
            $arraySurgeons = comma_separated_to_array($arraySurgeonsTemp[0], '/t/');
            for ($i = 0; $i < count($arraySurgeons); $i++) {
                if (isset($myArray['surgeonName-' . ($i + 1)])) {
                    $myArray['surgeonName-1' . ($i + 1)][0] = $arraySurgeons[$i];
                }
            }
        }

        if (isset($myArray['anesthesiaName'])){
            $myArray['anesthesiaName'][0] = $document[0]->anesthesiaName;
            $myArray['anesthesiaRUT'][0] = $document[0]->anesthesiaRUT;
        }

        if (isset($myArray['anesthesist-YN'])) {
            $arrayAnesthesistTemp = comma_separated_to_array($myArray['anesthesist-YN'][0], '/XY:');
            $arrayMarkTemp = comma_separated_to_array($arrayAnesthesistTemp[0], '/t/');
            $arrayCoordTemp = comma_separated_to_array($arrayAnesthesistTemp[1], '|');
            if (isset($myArray['anesthesiaName'][0]) OR isset($myArray['anesthesiaRUT'][0])) {
                $myArray['anesthesist-YN'][0] = $arrayMarkTemp[0];
            }
            else {
                $myArray['anesthesist-YN'][0] = $arrayMarkTemp[1];
                $myArray['anesthesist-YN'][1] = $myArray['anesthesist-YN'][1] + $arrayCoordTemp[0] ;
                $myArray['anesthesist-YN'][2] = $myArray['anesthesist-YN'][2] + $arrayCoordTemp[1];
            }
        }

        if (isset($myArray['arsenaleraName'])){
            $myArray['arsenaleraName'][0] = $document[0]->arsenaleraName;
            $myArray['arsenaleraRUT'][0] = $document[0]->arsenaleraRUT;
        }

        if (isset($myArray['arsenalera-YN'])) {
            $arrayArsenaleraTemp = comma_separated_to_array($myArray['arsenalera-YN'][0], '/XY:');
            $arrayMarkTemp = comma_separated_to_array($arrayArsenaleraTemp[0], '/t/');
            $arrayCoordTemp = comma_separated_to_array($arrayArsenaleraTemp[1], '|');
            if (isset($myArray['arsenaleraName'][0]) OR isset($myArray['arsenaleraRUT'][0])) {
                $myArray['arsenalera-YN'][0] = $arrayMarkTemp[0];
            }
            else {
                $myArray['arsenalera-YN'][0] = $arrayMarkTemp[1];
                $myArray['arsenalera-YN'][1] = $myArray['arsenalera-YN'][1] + $arrayCoordTemp[0] ;
                $myArray['arsenalera-YN'][2] = $myArray['arsenalera-YN'][2] + $arrayCoordTemp[1];
            }
        }

        $size = $myArray['sizeAngleColor'][0];
        $angle = $myArray['sizeAngleColor'][1];
        $color = $myArray['sizeAngleColor'][2];

        $path_main = asset('storage/documents')."/";
        $path_to = storage_path()."/app/documents/";

        $img = Image::make($path_main.$subtype[0]->image);

        function insertTexToImg($img, $text, $x, $y, $size, $angle, $color) {
            $img->text($text, intval($x), intval($y), function($font) use ($size, $angle, $color) {
                $path_fonts = storage_path()."/app/fonts/";
                $font->file($path_fonts.'arial.ttf');
                $font->size($size);
                $font->color($color);
                $font->align('left');
                $font->valign('top');
                $font->angle($angle);
            });
        }

        foreach ($myArray as $key=>$value){
            if (str_contains($value[0],'/XY:')) {
                $array = (comma_separated_to_array($value[0], '/XY:'));
                $arrayXY = (comma_separated_to_array(end($array), '|'));
                $tab = intval($arrayXY[0]);
                $lineHeight = intval($arrayXY[1]);
                $myRxArray = comma_separated_to_array($array[0], '/t/');
                for ($y = 0; $y < count($myRxArray); $y++){
                    insertTexToImg($img, $myRxArray[$y], $value[1]+($tab*$y), $value[2]+($lineHeight*$y), $size, $angle, $color);
                }
            }
            else {
                if ($key != 'sizeAngleColor' and 'sizeAngleColor') {
                    insertTexToImg($img, $value[0], $value[1], $value[2], $size, $angle, $color);
                }
            }
        }

        $name = Str::random(30);
        $date = \Carbon\Carbon::now()->format('Ymd_His');
        $id = $document[0]->id;

        $file_name = $id.'_'.$date.'_'.$name.'.jpg';

        if (file_exists($path_to.'qrcode_'.$document[0]->document_file)){
            unlink($path_to.'qrcode_'.$document[0]->document_file);
        }
        $qr_file = 'rce.neurorad.cl/checkQrCode/'.$file_name;
        QrCode::size(500)->format('png')->generate($qr_file, $path_to.'qrcode_'.$file_name);
        $img->insert($path_to.'qrcode_'.$file_name, 'top-left', $myArray['qrcode'][1], $myArray['qrcode'][2]);

        if (file_exists($path_to.$type[0]->shortName.'_'.$document[0]->document_file)){
            unlink($path_to.$type[0]->shortName.'_'.$document[0]->document_file);
        }
        $img->save($path_to.$type[0]->shortName.'_'.$file_name);

        $values = array(
            'document_file' => $file_name,
            'updated_at' => Carbon::now()->toDateTimeString()
        );

        DB::table('documents')
            ->where('documents.id', '=', $document[0]->id)
            ->update($values);

        return redirect()->route('document.edit', $document[0]->id)->with(['info'=> 'Documento generado exitosamente!']);
    }

    public function receta_pdf($document)
    {
        $document = DB::table('documents')
            ->where('documents.id', '=', $document)
            ->get();

        $document_type = DB::table('documents_type')
            ->where('documents_type.id', '=', $document[0]->documents_type_id)
            ->get();

        $path_to = storage_path()."/app/documents/";
        $image = $path_to.$document_type[0]->shortName.'_'.$document[0]->document_file;
//        dd($image);

        $data = [
            'image' => $image
        ];

        $pdf1 = PDF::loadView('documents/myPDF', $data);
        $pdf2 = PDF::loadView('documents/myPDF2', $data);

        $name = Str::random(30);
        $date = \Carbon\Carbon::now()->format('Ymd_His');
        $id = $document[0]->id;

        $file_name = $id.'_'.$date.'_'.$name.'.pdf';

        if (file_exists($path_to.'PARA_IMPRIMIR_'.$document_type[0]->shortName.'_'.$document[0]->pdf_file)){
            unlink($path_to.'PARA_IMPRIMIR_'.$document_type[0]->shortName.'_'.$document[0]->pdf_file);
            unlink($path_to.'FORMATO_DIGITAL_'.$document_type[0]->shortName.'_'.$document[0]->pdf_file);
        }

        $values = array(
            'pdf_file' => $file_name,
            'updated_at' => Carbon::now()->toDateTimeString()
        );

        DB::table('documents')
            ->where('documents.id', '=', $document[0]->id)
            ->update($values);

        $pdf1->setPaper('letter', 'portrait')->save($path_to.'PARA_IMPRIMIR_'.$document_type[0]->shortName.'_'.$file_name);
        $pdf2->setPaper([0.0, 0.0, 382.00, 608.00], 'portrait')->save($path_to.'FORMATO_DIGITAL_'.$document_type[0]->shortName.'_'.$file_name);

//        return $pdf->download('receta_'.$document[0]->patientName.'_'.Carbon::now()->toDateTimeString().'.pdf');
        return $pdf1->download('PARA_IMPRIMIR_'.$document_type[0]->shortName.'_'.$file_name);
    }

    public function send_email($document)
    {
        $document = DB::table('documents')
            ->where('documents.id', '=', $document)
            ->get();

        $document_type = DB::table('documents_type')
            ->where('documents_type.id', '=', $document[0]->documents_type_id)
            ->get();

        $data["email"] = $document[0]->email;
        $data["subject"] = $document_type[0]->name." para ".$document[0]->patientName;
        $data["title"] = "Neurorad Team";
        $data["body"] = "Se envían lo(s) documentos(s) solicitados como archivo(s) adjunto(s)";

        $files = [
            public_path('/storage/documents/PARA_IMPRIMIR_'.$document_type[0]->shortName.'_'.$document[0]->pdf_file),
            public_path('/storage/documents/FORMATO_DIGITAL_'.$document_type[0]->shortName.'_'.$document[0]->pdf_file),

        ];

        Mail::send('documents.demoMail2', $data, function($message)use($data, $files) {
            $message->to($data["email"], $data["email"])
                ->subject($data["subject"]);

            foreach ($files as $file){
                $message->attach($file);
            }
        });

        dd('Mail sent successfully');
    }

    public function edit_receta_template($subtype)
    {
        $subtype = DB::table('documents_type_subtype')
            ->where('documents_type_subtype.id', '=', $subtype)
            ->get();

        function comma_separated_to_array($string_value, $separator)
        {
            //Explode on comma
            $vals     =   explode($separator, $string_value);
            $count    =   count($vals);
            $val      =   array();
            //Trim whitespace
            for($i=0;$i<=$count-1;$i++) {
                $val[]   .=   $vals[$i];
            }
            return $val;
        }

        $myTempArray = (comma_separated_to_array($subtype[0]->imagexy, ';'));

        $myArray = array_fill(0,count($myTempArray),'');

        for ($x=0; $x<count($myTempArray); $x++){
            $myTempArray2 = explode(',', trim($myTempArray[$x]));
            $myArray[$x] = $myTempArray2;
            $myTempArray2[0] = trim($myTempArray2[0], '[]');
            $myArray[$myTempArray2[0]] = $myArray[$x];
            unset($myArray[$x]);
            array_shift($myArray[$myTempArray2[0]]);
        }

        $size = $myArray['sizeAngleColor'][0];
        $angle = $myArray['sizeAngleColor'][1];
        $color = $myArray['sizeAngleColor'][2];

        $path_main = asset('storage/documents')."/";
        $path_to = storage_path()."/app/documents/";

        $img = Image::make($path_main.$subtype[0]->image);

        function insertTexToImg($img, $text, $x, $y, $size, $angle, $color) {
            $img->text($text, intval($x), intval($y), function($font) use ($size, $angle, $color) {
                $path_fonts = storage_path()."/app/fonts/";
                $font->file($path_fonts.'arial.ttf');
                $font->size($size);
                $font->color($color);
                $font->align('left');
                $font->valign('top');
                $font->angle($angle);
            });
        }

        foreach ($myArray as $key=>$value){
            if (str_contains($value[0],'/XY:')) {
                $array = (comma_separated_to_array($value[0], '/XY:'));
                $arrayXY = (comma_separated_to_array(end($array), '|'));
                $tab = intval($arrayXY[0]);
                $lineHeight = intval($arrayXY[1]);
                $myRxArray = comma_separated_to_array($array[0], '/t/');
                for ($y = 0; $y < count($myRxArray); $y++){
                    insertTexToImg($img, $myRxArray[$y], $value[1]+($tab*$y), $value[2]+($lineHeight*$y), $size, $angle, $color);
                }
            }
            else {
                if ($key != 'sizeAngleColor' and 'sizeAngleColor') {
                    insertTexToImg($img, $value[0], $value[1], $value[2], $size, $angle, $color);
                }
            }
        }

        QrCode::size(500)->format('png')->generate('www.neurorad.cl', storage_path('app/documents/qrcode.jpg'));
        $img->insert(storage_path().'/app/documents/'.$myArray['qrcode'][0], 'top-left', $myArray['qrcode'][1], $myArray['qrcode'][2]);

        $name = Str::random(30);
        $date = \Carbon\Carbon::now()->format('Ymd_His');
        $id = $subtype[0]->id;

        $file_name = $id.'_'.$date.'_'.$name.'.jpg';

        if (file_exists($path_to.'test_receta_'.$subtype[0]->imagexy_file)){
            unlink($path_to.'test_receta_'.$subtype[0]->imagexy_file);
        }
        $img->save($path_to.'test_receta_'.$file_name);

        $values = array(
            'imagexy_file' => $file_name,
            'updated_at' => Carbon::now()->toDateTimeString()
        );

        DB::table('documents_type_subtype')
            ->where('documents_type_subtype.id', '=', $subtype[0]->id)
            ->update($values);

        return redirect()->route('document_image.edit', $subtype[0]->id)->with(['info'=> 'Template actualizado exitosamente!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($recetum)
    {
        $editable = DB::table('documents_type_subtype')
            ->where('documents_type_subtype.id', '=', $recetum)
            ->get();

        $file_path = 'documents/'.$editable[0]->image;

        Storage::delete($file_path);

        $values = array(
            'image' => null,
            'updated_at' => Carbon::now()->toDateTimeString()
        );

        $editable = DB::table('documents_type_subtype')
            ->where('documents_type_subtype.id', '=', $recetum)
            ->update($values);

        return redirect()->route('document_type_subtypes.edit', $recetum)->with(['info'=> 'Imagen eliminada exitosamente!']);
    }
}
