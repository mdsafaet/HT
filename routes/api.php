<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Models\Project as ModelsProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
   

});


Route::group((['prefix' => 'auth']), function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

  
});

     Route::get('show',[ProjectController::class,'index']);

    Route::post('create', [ProjectController::class, 'create']);
    Route::put('update/{id}', [ProjectController::class,'update']);
    Route::delete('delete/{id}', [ProjectController::class,'destroy']);



    //Task

Route::get('/show', [TaskController::class, 'index']); 
Route::post('/create', [TaskController::class, 'create']); 
Route::put('/update/{id}', [TaskController::class, 'update']); 
Route::delete('/delete/{id}', [TaskController::class, 'destroy']); 

