<?php

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


Route::group(['namespace'=>'Admin','middleware' => 'isAdmin'], function () {
    
    Route::get('students', 'StudentController@index')->name('students');
    Route::get('students/data', 'StudentController@data')->name('students.data');
    Route::delete('student/{id}', 'StudentController@destroy')->name('student.delete');
    Route::patch('student/{id}/disable', 'StudentController@disable')->name('student.disable');
    Route::patch('student/{id}/enable', 'StudentController@enable')->name('student.enable');
    
    Route::get('age/group', 'AgeGroupController@index')->name('age.group');
    Route::get('age/group/data', 'AgeGroupController@data')->name('age.data');
    Route::get('group/create', 'AgeGroupController@create')->name('group.create');
    Route::post('group/create', 'AgeGroupController@store');
    Route::delete('group/delete/{id}', 'AgeGroupController@destroy')->name('age.delete');
    Route::get('group/{id}', 'AgeGroupController@edit')->name('age.edit');
    Route::patch('group/{id}', 'AgeGroupController@update');
    
//    Route::get()->name();

});

Route::get('/', function () {
    return view('auth/login');
});




Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
