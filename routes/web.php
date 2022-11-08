<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'LoginController@showLogin')->name('auth.show.login');
Route::post('/login', 'LoginController@login')->name('auth.post.login');
Route::get('/logout', 'LoginController@logout')->name('auth.logout');

Route::group(['middleware' => 'check.user.login'], function() {
    // User
    Route::group(['prefix'=>'user'],function(){
        Route::get('list','UserController@index')->name('user.list');

        Route::get('edit/{id}','UserController@edit')->name('user.edit.form');

        Route::post('edit/{id}','UserController@update')->name('user.edit');

        Route::get('add','UserController@create')->name('user.add.form');

        Route::post('add','UserController@store')->name('user.add');

        Route::get('delete/{id}','UserController@destroy')->name('user.delete');

        Route::get('show/{id}','UserController@show')->name('user.show');

        Route::post('add-message/{id}','UserController@addMsg')->name('user.add.message');

        Route::get('delete-message/{id}','UserController@deleteMsg')->name('user.delete.message');

        Route::get('edit-profile/{id}','UserController@editProfile')->name('user.edit.profile');

        Route::post('update-profile/{id}','UserController@updateProfile')->name('user.update.profile');

        Route::get('profile/{id}','UserController@showProfile')->name('user.profile');
    });

    // Homework
    Route::group(['prefix'=>'homework'],function(){
        Route::get('list','HomeworkController@index')->name('homework.list');

        Route::get('edit/{id}','HomeworkController@edit')->name('homework.edit.form');

        Route::post('edit/{id}','HomeworkController@update')->name('homework.edit');

        Route::get('add','HomeworkController@create')->name('homework.add.form');

        Route::post('add','HomeworkController@store')->name('homework.add');

        Route::get('show/{id}','HomeworkController@show')->name('homework.show');

        Route::get('delete/{id}','HomeworkController@destroy')->name('homework.delete');

        Route::get('submit/{id}','HomeworkController@showSubmitForm')->name('homework.submit.form');

        Route::post('submit/{id}','HomeworkController@submit')->name('homework.submit');

        Route::post('update-solution/{id}','HomeworkController@updateSolution')->name('homework.solution.update');

        Route::get('mark/{id}','HomeworkController@showMarkForm')->name('homework.show.mark.form');

        Route::post('mark/{id}','HomeworkController@mark')->name('homework.mark');
    });

    // Essay
    Route::group(['prefix'=>'essay'],function(){
        Route::get('list','EssayController@index')->name('essay.list');

        Route::get('edit/{id}','EssayController@edit')->name('essay.edit.form');

        Route::post('edit/{id}','EssayController@update')->name('essay.edit');

        Route::get('add','EssayController@create')->name('essay.add.form');

        Route::post('add','EssayController@store')->name('essay.add');

        Route::get('delete/{id}','EssayController@destroy')->name('essay.delete');

        Route::get('submit/{id}','EssayController@showSubmitForm')->name('essay.submit.form');

        Route::post('submit/{id}','EssayController@submit')->name('essay.submit');
    });
});
