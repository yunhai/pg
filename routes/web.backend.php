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

/*Route::get('/', 'Home@dashboard');
Route::get('login', 'Home@login');
Route::get('changePassword', 'Home@changePassword');
Route::get('main', 'Home@main');
Route::get('list', 'Home@list');
Route::get('detail', 'Home@detail');*/

Route::get('login','Auth\LoginController@getLogin')->name('login');
Route::post('login','Auth\LoginController@postLogin');
Route::get('logout','Auth\LoginController@getLogout');

Route::group(['middleware' => ['admin']], function () {
    Route::get('ms_category', 'MsCategory@index')->name('ms_category.index');
    Route::get('ms_category/create', 'MsCategory@getCreate')->name('ms_category.create');
    Route::post('ms_category/create', 'MsCategory@postCreate');
    Route::get('ms_category/{ms_category_id}/edit', 'MsCategory@getEdit')->name('ms_category.edit');
    Route::post('ms_category/{ms_category_id}/edit', 'MsCategory@postEdit');
    Route::get('ms_category/{ms_category_id}/delete', 'MsCategory@getDelete');
    Route::get('user', 'User@index')->name('user.index');
    Route::get('lesson', 'Lesson@index')->name('lesson.index');
    Route::get('lesson/create', 'Lesson@getCreate')->name('lesson.create');
    Route::post('lesson/create', 'Lesson@postCreate');
    Route::get('lesson/{lesson_id}/edit', 'Lesson@getEdit')->name('lesson.edit');
    Route::post('lesson/{lesson_id}/edit', 'Lesson@postEdit');
    Route::get('lesson/{lesson_id}/delete', 'Lesson@getDelete');
    Route::get('lesson/{lesson_id}/detail', 'Lesson@getDetail')->name('lesson.detail');
    Route::get('lesson/{lesson_id}/detail/create', 'LessonMedia@getCreate')->name('lesson_media.input');
    Route::post('lesson/{lesson_id}/detail/create', 'LessonMedia@postCreate');
    Route::get('lesson/{lesson_id}/detail/{lesson_media_id}/edit', 'LessonMedia@getEdit')->name('lesson_media.edit');
    Route::post('lesson/{lesson_id}/detail/{lesson_media_id}/edit', 'LessonMedia@postEdit');
    Route::get('lesson/{lesson_id}/detail/{lesson_media_id}/delete', 'LessonMedia@getDelete');
    
    Route::post('media/chunk', 'Media@postChunk');
});
