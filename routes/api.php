<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\GroupController;

use App\Models\Role;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/studentregister', [AuthController::class, 'studentRegister']);
Route::get('/roles' , function (){return Role::all();});





// for all auth users
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user' , function (Request $request) {return $request->user();});




});

// only directors
Route::middleware(['auth:sanctum', 'abilities:director'])->group(function () {
    Route::apiResource('subjects', SubjectsController::class);
    Route::apiResource('groups', GroupController::class);
    Route::apiResource('students', StudentController::class);

});


// only teachers
Route::middleware(['auth:sanctum', 'abilities:teacher'])->group(function () {



});


// only students
Route::middleware(['auth:students', 'abilities:student'])->group(function () {
    Route::apiResource('students', StudentController::class);


});