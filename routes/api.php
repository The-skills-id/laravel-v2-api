<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
Route::prefix('v2')->group(function () {
	Route::middleware(['auth:sanctum'])->group(function () {
		Route::get('/webinar/mywebinar/{userid}','WebinarController@mywebinar');
		Route::post('/logout','LogoutController@logout');  
	});
	
	Route::post('/reset-password', 'ResetUserPasswordController@resetPassword');
	Route::post('/reset-password/{token}', 'ResetPasswordActionController@callResetPasswordAction');
    Route::post('/login','AuthController@login');
    Route::post('/register','AuthController@register');
	

    Route::post('/course/title/create','CourseController@createTitles');
	Route::post('/course/main/create','CourseController@createCourse');
	Route::get('/course/{title}','CourseController@getCourseByTitle');
	Route::post('/subcourse/create','SubcourseController@createSubcourse');
	Route::get('/subcourse/{course}','SubcourseController@getSubcourseByCourse');
	Route::post('/minicourse','MinicourseController@store');
	Route::get('/minicourse/{courseid}','MinicourseController@showByCourse');
	Route::get('/minicourse/id/{id}','MinicourseController@showById');
	Route::get('/webinar','WebinarController@getAll');
	Route::get('/webinar/{id}','WebinarController@getById');
	Route::post('/webinar','WebinarController@store');
	Route::post('/webinar/register','WebinarController@registerWebinar');
	Route::post('/membership','MembershipController@store');
	Route::get('/membership','MembershipController@index');
	Route::get('/membership/{courseid}','MembershipController@getMembership');
	Route::post('/usermembership','UserMembershipController@store');
	Route::get('/storage/{filename}','StorageController@index');


});
