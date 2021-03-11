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
// Route::group(['as'=>'', 'namespace'=>'App\Http\Controllers\Frontend'], function(){
	// Auth::routes();
// });
 Route::group(['as' => 'admin.','namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin'], function()
{	
	// Route::resource('member', 'MemberController');
	Route::get('',['uses' => 'IndexController@index','as'=>'index']);
	/*Member */
	Route::get('/member',['uses' => 'MemberController@index','as' => 'member.index']);
	Route::get('/member/add',['uses' => 'MemberController@create','as' => 'member.add']);
	Route::post('/member/store',['uses' => 'MemberController@store','as' => 'member.store']);
	Route::get('/member/edit/{id}',['uses' => 'MemberController@edit','as' => 'member.edit']);
	Route::put('/member/{id}', ['uses' => 'MemberController@update','as' => 'member.update']);
	Route::delete('/member/delele/{id}',['uses' => 'MemberController@delete','as' => 'member.delete']);

	/*Job */
	Route::get('/job',['uses' => 'JobController@index','as'=>'job.index']);
	Route::get('/job/add',['uses' => 'JobController@create','as'=>'job.add']);
	Route::get('/job/store',['uses' => 'JobController@store','as'=>'job.store']);
	Route::get('/job/edit/{id}',['uses' => 'JobController@edit','as'=>'job.edit']);
	Route::get('/job/delele/{id}',['uses' => 'JobController@delete','as'=>'job.delete']);

	/*Project */
	Route::get('/project',['uses' => 'ProjectController@index','as'=>'project.index']);
	Route::get('/project/add',['uses' => 'ProjectController@create','as'=>'project.add']);
	Route::get('/project/store',['uses' => 'ProjectController@store','as'=>'project.store']);
	Route::get('/project/edit/{id}',['uses' => 'ProjectController@edit','as'=>'project.edit']);
	Route::get('/project/delele/{id}',['uses' => 'ProjectController@delete','as'=>'project.delete']);
});



Route::group(['as'=>'frontend.', 'namespace'=>'App\Http\Controllers\Frontend'], function(){
		// Member
	route::get('/member', [App\Http\Controllers\Frontend\MemberController::class, 'index'])->name('member.index');
	route::get('/', [App\Http\Controllers\Frontend\MemberController::class, 'getLogin'])->name('show.login');
	route::get('/login', [App\Http\Controllers\Frontend\MemberController::class, 'getLogin'])->name('show.login');
	route::post('/login', [App\Http\Controllers\Frontend\MemberController::class, 'postLogin'])->name('post.login');

	route::get('/register', [App\Http\Controllers\Frontend\MemberController::class, 'getRegister'])->name('show.register');
	route::post('/register', [App\Http\Controllers\Frontend\MemberController::class, 'postRegister'])->name('post.register');

	route::get('/job', [App\Http\Controllers\Frontend\MemberController::class, 'getJob'])->name('show.job');
	route::put('/member/{id}', [App\Http\Controllers\Frontend\MemberController::class, 'updateMember'])->name('put.member');
		// End Member
});


