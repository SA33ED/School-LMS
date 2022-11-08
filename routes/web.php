<?php

use App\Http\Controllers\GradeController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth' ]
    ], function(){





        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

	Route::get('/', function(){return view('dashboard');})->name('dashboard');


    Route::get('grades' ,[GradeController::class,'index'])->name('gradesList');
    Route::post('grades/update',[GradeController::class,'update'])->name('gradesEdit');
    Route::post('grades/store',[GradeController::class,'store'])->name('gradesStore');




});
require __DIR__.'/auth.php';
