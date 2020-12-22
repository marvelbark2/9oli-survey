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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::view('vimeo', 'vimeo');
Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/google/callback', 'Auth\LoginController@callback');
Route::get('contact', function () {
    return view('search');
});
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
    Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
    Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
    Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
    Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
    Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
    Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::get('/multi', 'SurveyController@multi')->name('survey.multi');
    Route::group(['prefix' => 'survey'], function () {
        // Route::get('/', ['as' => 'survey.index', 'uses' => 'SurveyController@index']);
        // Route::get('/{survey}', 'SurveyController@show')->name('survey.show');
        //  Route::get('/admin/{survey}', 'SurveyController@showAdmin')->name('survey.show-admin');
        //  Route::post('/{survey}', 'SurveyController@answers')->name('survey.answers');
        Route::get('/', ['as' => 'pages.survey', 'uses' => 'PageController@survey']);
        Route::post('/create', 'SurveyController@store')->name('survey.create');
        Route::get('/result/{id}', 'SurveyController@result')->name('survey.result');
    });
});
