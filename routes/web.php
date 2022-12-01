<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\ClassroomController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth' ]
    ], function(){





        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

	Route::get('/', function(){return view('dashboard');})->name('dashboard');

        /** GRADES ROUTES **/
    Route::get('grades' ,[GradeController::class,'index'])->name('gradesList');
    Route::post('grades/update',[GradeController::class,'update'])->name('gradesEdit');
    Route::post('grades/store',[GradeController::class,'store'])->name('gradesStore');
    Route::delete('grades/{id}',[GradeController::class,'destroy'])->name('greadsDestroy');


        /** CLASSROOMS ROUTES **/
    Route::get('classrooms' ,[ClassroomController::class,'index'])->name('classroomsList');
    Route::post('classrooms/store' ,[ClassroomController::class,'store'])->name('classroomsStore');
    Route::post('classrooms/update' ,[ClassroomController::class,'update'])->name('classroomsEdit');
    Route::delete('classrooms/{id}',[ClassroomController::class,'destroy'])->name('classroomsDestroy');
    Route::post('classrooms/deleteall',[ClassroomController::class,'deleteall'])->name('classroomsDeleteAll');
    Route::post('classrooms/filter',[ClassroomController::class,'filter'])->name('classroomsFilter');


});
require __DIR__.'/auth.php';
