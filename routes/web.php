<?php

use App\Http\Controllers\Document\PublicView;
use App\Http\Controllers\Document\RecetaController;
use App\Http\Controllers\Document\SendEmailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Paciente\PacienteController;
use App\Http\Controllers\Hospital\HospitalController;
use App\Http\Controllers\Surgery\SurgeryController;
use App\Http\Controllers\Protocol\ProtocolController;
use App\Http\Controllers\Template\TemplateController;
use App\Http\Controllers\Document\DocumentController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('', [HomeController::class, 'index'])
//    ->name('admin.home')
//    ->middleware('can:admin');

Route::resource('paciente', PacienteController::class)
    ->middleware('can:admin');

Route::GET('paciente_hosp', [PacienteController::class, 'index_hosp'])
    ->name('paciente_hosp.index')
    ->middleware('can:admin');

Route::GET('paciente_amb', [PacienteController::class, 'index_amb'])
    ->name('paciente_amb.index')
    ->middleware('can:admin');

Route::GET('paciente_alta', [PacienteController::class, 'index_alta'])
    ->name('paciente_alta.index')
    ->middleware('can:admin');

Route::GET('paciente/{paciente}/{origen}/edit', [PacienteController::class, 'edit'])
    ->name('paciente.edit')
    ->middleware('can:admin');

Route::GET('paciente/create_action/{paciente}', [PacienteController::class, 'create_action'])
    ->name('paciente_action.create')
    ->middleware('can:admin');

Route::post('paciente_action', [PacienteController::class, 'store_action'])
    ->name('paciente_action.store')
    ->middleware('can:admin');

Route::GET('paciente/{paciente}/{action}/edit_action', [PacienteController::class, 'edit_action'])
    ->name('paciente_action.edit')
    ->middleware('can:admin');

Route::put('paciente/update_action/{action}', [PacienteController::class, 'update_action'])
    ->name('paciente_action.update')
    ->middleware('can:admin');

Route::put('paciente/{paciente}/{origen}', [PacienteController::class, 'update'])
    ->name('paciente.update')
    ->middleware('can:admin');

Route::delete('paciente/{paciente}/{action}/destroy_action', [PacienteController::class, 'destroy_action'])
    ->name('paciente_action.destroy')
    ->middleware('can:admin');

Route::resource('users', \App\Http\Controllers\Admin\UserController::class)
    ->middleware('can:admin');

Route::resource('rolesUsers', RoleUserController::class)
    ->middleware('can:admin');

Route::resource('roles', RoleController::class)
    ->middleware('can:admin');

Route::resource('permissions', PermissionController::class)
    ->middleware('can:admin');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])
    ->name('profile');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])
    ->name('profile.edit');
Route::put('/profile/update/{user}', [App\Http\Controllers\ProfileController::class, 'update'])
    ->name('profile.update');

Route::resource('hospital', HospitalController::class)
    ->middleware('can:admin');

Route::resource('surgery', SurgeryController::class)
    ->middleware('can:admin');

Route::resource('protocol', ProtocolController::class)
    ->middleware('can:admin');

Route::resource('template', TemplateController::class)
    ->middleware('can:admin');

Route::get('template/{surgery}/create/', [TemplateController::class, 'create'])
    ->name('template.create');

Route::resource('document', DocumentController::class)
    ->middleware('can:admin');

Route::get('document_types/create', [DocumentController::class, 'create_types'])
    ->name('document_types.create')
    ->middleware('can:admin');

Route::post('document_types', [DocumentController::class, 'store_types'])
    ->name('document_types.store')
    ->middleware('can:admin');

Route::GET('document_types', [DocumentController::class, 'index_types'])
    ->name('document_types.index')
    ->middleware('can:admin');

Route::GET('document_types/{type}/edit', [DocumentController::class, 'edit_types'])
    ->name('document_types.edit')
    ->middleware('can:admin');

Route::put('document_types/{type}', [DocumentController::class, 'update_types'])
    ->name('document_types.update')
    ->middleware('can:admin');

Route::delete('document_types/{type}', [DocumentController::class, 'destroy_types'])
    ->name('document_types.destroy')
    ->middleware('can:admin');

Route::get('document_type_subtypes/create', [DocumentController::class, 'create_type_subtypes'])
    ->name('document_type_subtypes.create');

Route::post('document_type_subtypes', [DocumentController::class, 'store_type_subtypes'])
    ->name('document_type_subtypes.store')
    ->middleware('can:admin');

Route::GET('document_type_subtypes', [DocumentController::class, 'index_type_subtypes'])
    ->name('document_type_subtypes.index')
    ->middleware('can:admin');

Route::GET('document_type_subtypes/{subtype}/edit', [DocumentController::class, 'edit_type_subtypes'])
    ->name('document_type_subtypes.edit')
    ->middleware('can:admin');

Route::GET('document_image/{subtype}/edit', [DocumentController::class, 'edit_image'])
    ->name('document_image.edit')
    ->middleware('can:admin');

Route::delete('document_type_subtypes/{subtype}', [DocumentController::class, 'destroy_type_subtypes'])
    ->name('document_type_subtypes.destroy')
    ->middleware('can:admin');

Route::delete('document_type_subtypes/document/{subtype}', [DocumentController::class, 'destroy_document'])
    ->name('document_type_subtypes.destroy_document')
    ->middleware('can:admin');

//Route::put('document_type_subtypes/file/{subtype}', [DocumentController::class, 'storeFile'])
//    ->name('document_type_subtypes.storeFile')
//    ->middleware('can:admin');

Route::put('document_type_subtypes/{subtype}', [DocumentController::class, 'update_type_subtypes'])
    ->name('document_type_subtypes.update')
    ->middleware('can:admin');

Route::put('document_subtypes_xy/{subtype}', [DocumentController::class, 'update_subtypes_xy'])
    ->name('document_subtypes_xy.update')
    ->middleware('can:admin');

Route::post('document_type_subtypes/document/{subtype}', [DocumentController::class, 'store_document'])
    ->name('document_type_subtypes.store_document')
    ->middleware('can:admin');

Route::get('document/store_image/{document}', [DocumentController::class, 'store_document_image'])
    ->name('document.store_image')
    ->middleware('can:admin');

Route::resource('receta', RecetaController::class)
//    ->except(['store'])
    ->middleware('can:admin');

Route::GET('receta_template/{subtype}/edit', [RecetaController::class, 'edit_receta_template'])
    ->name('receta_template.edit')
    ->middleware('can:admin');

Route::GET('receta_pdf/{document}', [RecetaController::class, 'receta_pdf'])
    ->name('receta_pdf.edit')
    ->middleware('can:admin');

//Route::post('receta/{subtype}', [RecetaController::class, 'store'])
//    ->name('receta.store')
//    ->middleware('can:admin');

Route::get('generate', function (){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
})->middleware('can:admin');

Route::get('send-email', [SendEmailController::class, 'index'])
    ->middleware('can:admin');

Route::get('receta_send_email/{document}', [RecetaController::class, 'send_email'])
    ->name('receta_send_email.edit')
    ->middleware('can:admin');

Route::get('qr-code-g', function () {
    QrCode::size(500)
        ->format('png')
        ->generate('ItSolutionStuff.com', storage_path('app/documents/qrcode.jpg'));
    return view('documents/qrCode');
    })
    ->middleware('can:admin');

Route::get('checkQrCode/{file}', [PublicView::class, 'checkQrCode'])
    ->name('checkQrCode.index');
