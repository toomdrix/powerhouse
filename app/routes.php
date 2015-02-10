<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::action('Powerhouse\\Core\\DoorstepController@getIndex');
});

Route::group(array('before'=>array('auth','permission'),'namespace' => 'Powerhouse\Core'), function() {
	Route::resource('dashboard', 'DashboardController');
	Route::resource('user', 'UserController');
	Route::resource('usergroup', 'UsergroupController');
	Route::resource('company', 'CompanyController');
	Route::resource('project', 'ProjectController');
	Route::resource('result', 'ResultController');
});

Route::controller('doorstep', 'Powerhouse\\Core\\DoorstepController');

View::composer('block.sidebar.project.list', 'Powerhouse\\Core\\SidebarProjectListComposer');
View::composer('user.form', 'Powerhouse\\Core\\UserCreateFormComposer');
View::composer('project.form', 'Powerhouse\\Core\\ProjectCreateFormComposer');
View::composer('result.form', 'Powerhouse\\Core\\ResultCreateFormComposer');