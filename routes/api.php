<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\TimetableController;

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

    Route::apiResource('subjects', SubjectController::class)->only(['index']);
    
    Route::apiResource('grades', GradeController::class);
    Route::apiResource('timetables', TimetableController::class);
    Route::get('timetables/group/{id}', [TimetableController::class , 'GroupTimetable']);
    Route::apiResource('groups', GroupController::class)->only(['show', 'index']);


});

// only for directors
Route::middleware(['auth:sanctum', 'abilities:director'])->group(function () {
    Route::apiResource('subjects', SubjectController::class)->except(['show', 'index']);
    Route::apiResource('groups', GroupController::class)->except(['show', 'index']);
    Route::apiResource('students', StudentController::class);

});


// only for teachers
Route::middleware(['auth:sanctum', 'abilities:teacher'])->group(function () {
    Route::get('groups/{group}/{subject}', [GroupController::class , 'groupSubjectGrades']);
});


// only for students
Route::middleware(['auth:sanctum', 'abilities:student'])->group(function () {

    Route::get('studentgrades/{id}', [StudentController::class, 'studentGrades']);
    Route::get('studentsubjectgrades/{id}', [SubjectController::class, 'studentSubjectGrades']);


});