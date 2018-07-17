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
Auth::routes();

Route::get('', 'Top@index')->name('top');

Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

Route::get('contact', 'Page@getContact')->name('contact');
Route::get('company', 'Page@getCompany')->name('company');

Route::get('lesson', 'Lesson\Lesson@getLesson')->name('lesson');
Route::get('lesson/{lesson_id}/detail', 'Lesson\Lesson@getDetail')->name('lesson.detail');
Route::get('lesson/{lesson_id}/detail/{lesson_detail_id}', 'Lesson\LessonDetail\LessonDetail@getDetail')->name('lesson_detail.detail');

Route::get('media/download/{media_id}', 'Media@getDownload')->name('media.download');

Route::get('privacy', 'Page@getPrivacy')->name('privacy');
Route::get('terms', 'Page@getTerms')->name('terms');

Route::group(['middleware' => ['user']], function () {
    Route::get('lesson/{lesson_id}/enroll', 'Lesson\Lesson@getEnroll')->name('lesson.enroll');
    Route::get('lesson/{lesson_id}/close', 'Lesson\Lesson@getClose')->name('lesson.close');

    Route::get('lesson/{lesson_id}/detail/{lesson_detail_id}/learn', 'Lesson\LessonDetail\LessonDetail@getLearn')->name('lesson_detail.learn');
    Route::get('lesson/{lesson_id}/detail/{lesson_detail_id}/close', 'Lesson\LessonDetail\LessonDetail@getClose')->name('lesson_detail.close');

    Route::get('user/password', 'User@getChangePassword')->name('user.change_password');
    Route::post('user/password', 'User@postChangePassword');
});

Route::get('logout', 'Auth\LoginController@getLogout')->name('logout');

//////////////////////////////////////////////////
Route::get('affiliate', 'Page@getAffiliate')->name('affiliate');
Route::get('home', 'Home@getMyPage')->name('home');
Route::get('stripe', 'Page@getStripe')->name('stripe');
