<?php

use App\Http\Controllers\Proejctb;
use App\Http\Controllers\ProjectbController;
use App\Http\Controllers\TagbController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Models\Project as ModelsProject;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SafaetController;
use App\Http\Controllers\TaskbController;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;



Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});





Route::group(['middleware' => 'auth:api', 'prefix' => 'auth'], function () {
      Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    //Route::get('me', [AuthController::class, 'me']);
    
});

  
// });

// Route::apiResource('/safaet', SafaetController::class);
// Route::apiResource('/', Project::class);


Route::apiResource('task', TaskbController::class);
Route::apiResource('tag', TagbController::class);

Route::group(['middleware' => 'auth:api'], function () {

    
Route::middleware('role:user,admin')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);

        Route::apiResource('project', ProjectbController::class);
   
    });

});






// Route::group(['middleware' => ['auth:api', 'Safaet']], function () {
//     Route::get('show',[ProjectController::class,'index']);
//     Route::post('create', [ProjectController::class, 'create']);
//     Route::put('update/{id}', [ProjectController::class,'update']);
//     Route::delete('delete/{id}', [ProjectController::class,'destroy']);
// });


    //Task


// Route::group(['middleware' => ['auth:api', 'auth.token']], function () {

// Route::get('show', [TaskController::class, 'index']); 
// Route::post('create', [TaskController::class, 'create']); 
// Route::put('update/{id}', [TaskController::class, 'update']); 
// Route::delete('delete/{id}', [TaskController::class, 'destroy']); 
// });




// // //tag


// Route::group(['middleware' => ['auth:api', 'admin']], function () {

// Route::post('create', [TagController::class, 'store']);  
// Route::delete('delete/{id}', [TagController::class, 'destroy']);

// });




