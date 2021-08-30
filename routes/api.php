<?php

use Illuminate\Http\Request;

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

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});


Route::group(['middleware' => 'auth:api'], function(){
    // Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
    Route::get('roles',['uses'=>'RolesController@index','as'=>'roles.index']);
    Route::post('roles/store',['uses'=>'RolesController@store','as'=>'roles.store']);
    Route::get('roles/{id}/edit',['uses'=>'RolesController@edit','as'=>'roles.edit']);
    Route::put('roles/{id}/update',['uses'=>'RolesController@update','as'=>'roles.update']);
    Route::get('departments',['uses'=>'DepartmentsController@index','as'=>'departments.index']);
    Route::post('departments/store',['uses'=>'DepartmentsController@store','as'=>'departments.store']);
    Route::get('departments/{id}/edit',['uses'=>'DepartmentsController@edit','as'=>'departments.edit']);
    Route::put('departments/{id}/update',['uses'=>'DepartmentsController@update','as'=>'departments.update']);
    Route::get('classrooms',['uses'=>'ClassroomsController@index','as'=>'classrooms.index']);
    Route::post('classrooms/store',['uses'=>'ClassroomsController@store','as'=>'classrooms.store']);
    Route::get('classrooms/{id}/edit',['uses'=>'ClassroomsController@edit','as'=>'classrooms.edit']);
    Route::put('classrooms/{id}/update',['uses'=>'ClassroomsController@update','as'=>'classrooms.update']);
    Route::get('getTeachers',['uses'=>'UserController@getTeachers','as'=>'getTeachers']);
    Route::get('batches',['uses'=>'BatchesController@index','as'=>'batches.index']);
    Route::post('batches/store',['uses'=>'BatchesController@store','as'=>'batches.store']);
    Route::get('batches/{id}/edit',['uses'=>'BatchesController@edit','as'=>'batches.edit']);
    Route::put('batches/{id}/update',['uses'=>'BatchesController@update','as'=>'batches.update']);
    Route::get('subjects',['uses'=>'SubjectsController@index','as'=>'subjects.index']);
    Route::post('subjects/store',['uses'=>'SubjectsController@store','as'=>'subjects.store']);
    Route::get('subjects/{id}/edit',['uses'=>'SubjectsController@edit','as'=>'subjects.edit']);
    Route::put('subjects/{id}/update',['uses'=>'SubjectsController@update','as'=>'subjects.update']);
});
