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

	Route::put('/ajax/status/{id}', ['uses' => 'AjaxController@updateStatus']);
	Route::put('/ajax/priority/{id}', ['uses' => 'AjaxController@updatePriority']);
	// Route::resource('member', 'MemberController');
	Route::get('',['uses' => 'IndexController@index','as'=>'index']);
	
	/*Member */
	Route::get('/member',['uses' => 'MemberController@index','as' => 'member.index']);
	Route::get('/member/add',['uses' => 'MemberController@create','as' => 'member.add']);
	Route::post('/member/store',['uses' => 'MemberController@store','as' => 'member.store']);
	Route::get('/member/edit/{id}',['uses' => 'MemberController@edit','as' => 'member.edit']);
	Route::put('/member/update/{id}', ['uses' => 'MemberController@update','as' => 'member.update']);
	Route::delete('/member/delete/{id}',['uses' => 'MemberController@delete','as' => 'member.delete']);
	Route::delete('/member/delete-multiple/{id}',['uses' => 'MemberController@deleteMultiple']);

	/*Job */
	Route::get('/job',['uses' => 'JobController@index','as' => 'job.index']);
	Route::get('/job/add',['uses' => 'JobController@create','as' => 'job.add']);
	Route::post('/job/store',['uses' => 'JobController@store','as' => 'job.store']);
	Route::get('/job/edit/{id}',['uses' => 'JobController@edit','as' => 'job.edit']);
	Route::put('/job/update/{id}', ['uses' => 'JobController@update','as' => 'job.update']);
	Route::delete('/job/delete/{id}',['uses' => 'JobController@delete','as' => 'job.delete']);
	Route::delete('/job/delete-multiple/{id}',['uses' => 'JobController@deleteMultiple']);

	/*Project */
	Route::get('/project',['uses' => 'ProjectController@index','as' => 'project.index']);
	Route::get('/project/add',['uses' => 'ProjectController@create','as' => 'project.add']);
	Route::post('/project/store',['uses' => 'ProjectController@store','as' => 'project.store']);
	Route::get('/project/edit/{id}',['uses' => 'ProjectController@edit','as' => 'project.edit']);
	Route::put('/project/update/{id}', ['uses' => 'ProjectController@update','as' => 'project.update']);
	Route::delete('/project/delete/{id}',['uses' => 'ProjectController@delete','as' => 'project.delete']);
	Route::delete('/project/delete-multiple/{id}',['uses' => 'ProjectController@deleteMultiple']);
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


