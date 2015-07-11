<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
	return view('welcome');
});

Route::group(['namespace' => 'Api'], function () {
	Route::group(['namespace' => 'V1'], function () {
		Route::group(['prefix' => 'api/v1'], function () {
			Route::resources([
				'question' => 'QuestionController',
			]);
		});

	});
});

Route::group(['namespace' => 'Admin'], function () {
	//Route::group(['middleware' => 'auth'], function () {
	Route::group(['prefix' => 'admin'], function () {
		Route::get('gen/{f}->{n}', function ($f, $n) {
			$link = '<img src="http://fakeanh.com/uploads/fairy/vol39/432/';
			for ($i = $f; $i <= $n; $i++) {
				if ($i < 10) {
					echo e($link . '00' . $i . '.png">');
				} else if ($i < 100) {
					echo e($link . '0' . $i . '.png">');
				} else {
					echo e($link . $i . '.jpg">');
				}

			}
		})->where(['f' => '[0-9]+', 'n' => '[0-9]+']);

		Route::get('story/status', 'StoryController@status');
		Route::get('/', function () {
			return redirect('admin/dashboard');
		});

		Route::group(['prefix' => 'manager'], function () {
			Route::resource('user', 'UserController');
			Route::resource('role', 'RoleController');
			Route::resource('permission', 'PermissionsController');
		});

		Route::get('logout', function () {
			Auth::logout();
			return redirect('home');
		});
		Route::match(['get', 'post'], 'chapter/ads', 'ChapterController@ads');
		Route::get('chapter/add', 'ChapterController@add');
		Route::get('chapter/load', 'ChapterController@loadData');
		Route::resource('media', 'MediaController', ['only' => ['index']]);
		Route::resources([
			'author' => 'AuthorController',
			'category' => 'CategoryController',
			'chapter' => 'ChapterController',
			'cloud' => 'CloudController',
			'country' => 'CountryController',
			'dashboard' => 'DashboardController',
			'language' => 'LanguageController',
			'tag' => 'TagController',
			'story' => 'StoryController',
			'question' => 'QuestionController',
		]);

	});
	//});

});