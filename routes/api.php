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

Route::get('/courses', 'CourseController@index');
Route::get('/course/{id}', 'CourseController@show');
Route::get('/course/{id}/videos', 'CourseController@videos');

Route::get('/video/{id}', 'VideoController@show');

Route::group(['middleware' => ['auth:api']], function () {
    // 请求视频播放地址
    Route::get('/video/{id}/play_url', 'VideoController@playUrl');
});