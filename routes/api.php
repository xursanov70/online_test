<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('send/code', [UserController::class, 'sendCode']);
Route::post('confirm/code', [UserController::class, 'confirmCode']);

// Route::group(['prefix' => 'auth'], function () {
    Route::post('user/login', [UserController::class, 'userLogin']);
    Route::post('user/register', [UserController::class, 'userRegister']);
    // });
    
    Route::group(['middleware' => ['auth:sanctum']], function () {
        
        Route::post('update/user', [UserController::class, 'updateUser']);
        Route::get('my/profile', [UserController::class, 'myProfile']);

        Route::post('attach/teacher', [TeacherController::class, 'attachTeacher']);
        Route::post('update/attach/teacher/{teacher_id}', [TeacherController::class, 'updateAttachTeacher']);
        Route::get('get/teacher', [TeacherController::class, 'getTeacher']);

        Route::post('attach/student', [StudentController::class, 'attachStudent']);
        Route::post('update/attach/student/{student_id}', [StudentController::class, 'updateAttachStudent']);
        Route::get('get/student', [StudentController::class, 'getStudent']);

        Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
        });
        
        
        Route::post('create/group', [GroupController::class, 'createGroup']);
        Route::post('update/group/{group_id}', [GroupController::class, 'updateGroup']);
        Route::get('get/group', [GroupController::class, 'getGroup']);

});
