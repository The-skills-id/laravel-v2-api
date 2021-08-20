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
		Route::get('aku', function (Request $request) {
			return $request->user();
		})->middleware('verified');
		Route::get('/course/mycourse', 'CourseController@getCourseByUser');
		/* Route::get('/email/verify', function () {
			return "must verified";
		})->name('verification.notice');

		Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
			$request->fulfill();
		
			return $request;
		})->middleware(['signed'])->name('verification.verify');

		Route::post('/email/verification-notification', function (Request $request) {
			$request->user()->sendEmailVerificationNotification();
		
			return response()->json([
				'status' => 'success',
				'message'=> 'Link verifikasi email sudah dikirim!'
			]);
		})->middleware(['throttle:6,1'])->name('verification.send'); */
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
	Route::get('/subcourse/schedule/{id}', 'ScheduleController@getBySubcourseId');
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
	Route::get('/articles', 'ArticleController@index');
	Route::get('/article/{id}', 'ArticleController@getArticleById');

});
