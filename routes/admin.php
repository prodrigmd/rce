<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

Route::get('', [HomeController::class, 'index'])
    ->name('admin.home');

//Route::resource('roles', RoleController::class)
//    ->middleware('can:edit admin');
//
//Route::resource('permissions', PermissionController::class)
//    ->middleware('can:edit admin');
//
//Route::resource('patologiaCategory', PermissionController::class)
//    ->middleware('can:edit admin');
//
//Route::resource('rolesUsers', RoleUserController::class);
//
//Route::resource('patologiaCategory', PatologiaCategoryController::class)
//    ->middleware('can:edit categories');
//
//Route::resource('patologiaSubCategory', PatologiaSubCategoryController::class)
//    ->middleware('can:edit categories');
//
//Route::resource('patologia', PatologiaController::class)
//    ->middleware('can:edit categories');
//
//Route::resource('regionCategory', RegionCategoryController::class)
//    ->middleware('can:edit categories');
//
//Route::resource('region', RegionController::class)
//    ->middleware('can:edit categories');
//
//Route::resource('techniqueCategory', TechniqueCategoryController::class)
//    ->middleware('can:edit categories');
//
//Route::resource('technique', TechniqueController::class)
//    ->middleware('can:edit categories');
//
//Route::resource('etiquetaCategory', EtiquetaCategoryController::class)
//    ->middleware('can:edit categories');
//
//Route::resource('etiqueta', EtiquetaController::class)
//    ->middleware('can:edit categories');
//
//Route::resource('area', AreaController::class)
//    ->middleware('can:edit categories');
//
//Route::put('/admin/caseAdmin/{caseAdmin}', [CaseAdminController::class, 'storeList'])
//    ->name('caseAdmin.storeList')
//    ->middleware('can:edit categories');
//
//Route::delete('/admin/caseAdmin/{caseAdmin}', [CaseAdminController::class, 'destroyList'])
//    ->name('caseAdmin.destroyList')
//    ->middleware('can:edit categories');
//
//Route::resource('caseAdmin', CaseAdminController::class)
//    ->middleware('can:edit categories');
//
//Route::put('/file/{case_id}', [FileController::class, 'orderList'])
//    ->name('file.orderList')
//    ->middleware('can:edit categories');
//
//Route::delete('/file/{case_id}', [FileController::class, 'destroyList'])
//    ->name('file.destroyList')
//    ->middleware('can:edit categories');
//
//Route::post('file.store_dicom', [FileController::class, 'store_dicom'])
//    ->name('file.store_dicom')
//    ->middleware('can:edit categories');
//
//Route::get('file.download/{file}', [FileController::class, 'download'])
//    ->name('file.download')
//    ->middleware('can:edit categories');
//
//Route::delete('file.delete_dicom/{file}/{case_id}', [FileController::class, 'destroyDicom'])
//    ->name('file.delete_dicom')
//    ->middleware('can:edit categories');
//
//Route::resource('file', FileController::class)
//    ->middleware('can:edit categories');

