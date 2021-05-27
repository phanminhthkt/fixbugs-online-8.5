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
 Route::group(['as' => 'admin.','namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin'], function(){	

 	Route::get('user/login',['uses' => 'UserController@getLogin','as'=>'user.login']);
 	Route::post('user/login',['uses' => 'UserController@postLogin']);

	Route::group(['middleware' => 'auth'], function(){	
	Route::put('/ajax/status/{id}', ['uses' => 'AjaxController@updateStatus']);
	Route::put('/ajax/priority/{id}', ['uses' => 'AjaxController@updatePriority']);
	// Route::resource('member', 'MemberController');
	Route::get('',['uses' => 'IndexController@index','as'=>'index']);
	
	
	/*User */
	
	// Route::post('user/login',['uses' => '/UserController@postLogin','as'=>'user.login']);
	Route::get('/user',['uses' => 'UserController@index','as' => 'user.index']);
	Route::get('/user/add',['uses' => 'UserController@create','as' => 'user.add']);
	Route::post('/user/store',['uses' => 'UserController@store','as' => 'user.store']);
	Route::get('/user/edit/{id}',['uses' => 'UserController@edit','as' => 'user.edit']);
	Route::put('/user/update/{id}', ['uses' => 'UserController@update','as' => 'user.update']);
	Route::delete('/user/delete/{id}',['uses' => 'UserController@delete','as' => 'user.delete']);
	Route::delete('/user/delete-multiple/{id}',['uses' => 'UserController@deleteMultiple']);

	/*Member */
	Route::get('/member',['uses' => 'MemberController@index','as' => 'member.index']);
	Route::get('/member/add',['uses' => 'MemberController@create','as' => 'member.add']);
	Route::post('/member/store',['uses' => 'MemberController@store','as' => 'member.store']);
	Route::get('/member/edit/{id}',['uses' => 'MemberController@edit','as' => 'member.edit']);
	Route::put('/member/update/{id}', ['uses' => 'MemberController@update','as' => 'member.update']);
	Route::delete('/member/delete/{id}',['uses' => 'MemberController@delete','as' => 'member.delete']);
	Route::delete('/member/delete-multiple/{id}',['uses' => 'MemberController@deleteMultiple']);

	/*Nhóm thành viên */
	Route::get('/group_member',['uses' => 'GroupMemberController@index','as' => 'group_member.index']);
	Route::get('/group_member/add',['uses' => 'GroupMemberController@create','as' => 'group_member.add']);
	Route::post('/group_member/store',['uses' => 'GroupMemberController@store','as' => 'group_member.store']);
	Route::get('/group_member/edit/{id}',['uses' => 'GroupMemberController@edit','as' => 'group_member.edit']);
	Route::put('/group_member/update/{id}', ['uses' => 'GroupMemberController@update','as' => 'group_member.update']);
	Route::delete('/group_member/delete/{id}',['uses' => 'GroupMemberController@delete','as' => 'group_member.delete']);
	Route::delete('/group_member/delete-multiple/{id}',['uses' => 'GroupMemberController@deleteMultiple']);

	/*Nhóm thành viên */
	Route::get('/group_status',['uses' => 'GroupStatusController@index','as' => 'group_status.index']);
	Route::get('/group_status/add',['uses' => 'GroupStatusController@create','as' => 'group_status.add']);
	Route::post('/group_status/store',['uses' => 'GroupStatusController@store','as' => 'group_status.store']);
	Route::get('/group_status/edit/{id}',['uses' => 'GroupStatusController@edit','as' => 'group_status.edit']);
	Route::put('/group_status/update/{id}', ['uses' => 'GroupStatusController@update','as' => 'group_status.update']);
	Route::delete('/group_status/delete/{id}',['uses' => 'GroupStatusController@delete','as' => 'group_status.delete']);
	Route::delete('/group_status/delete-multiple/{id}',['uses' => 'GroupStatusController@deleteMultiple']);

	/*Job */
	Route::get('/status',['uses' => 'StatusController@index','as' => 'status.index']);
	Route::get('/status/add',['uses' => 'StatusController@create','as' => 'status.add']);
	Route::post('/status/store',['uses' => 'StatusController@store','as' => 'status.store']);
	Route::get('/status/edit/{id}',['uses' => 'StatusController@edit','as' => 'status.edit']);
	Route::put('/status/update/{id}', ['uses' => 'StatusController@update','as' => 'status.update']);
	Route::delete('/status/delete/{id}',['uses' => 'StatusController@delete','as' => 'status.delete']);
	Route::delete('/status/delete-multiple/{id}',['uses' => 'StatusController@deleteMultiple']);

	/*Project */
	Route::get('/project',['uses' => 'ProjectController@index','as' => 'project.index']);
	Route::get('/project/add',['uses' => 'ProjectController@create','as' => 'project.add']);
	Route::post('/project/store',['uses' => 'ProjectController@store','as' => 'project.store']);
	Route::get('/project/edit/{id}',['uses' => 'ProjectController@edit','as' => 'project.edit']);
	Route::put('/project/update/{id}', ['uses' => 'ProjectController@update','as' => 'project.update']);
	Route::delete('/project/delete/{id}',['uses' => 'ProjectController@delete','as' => 'project.delete']);
	Route::delete('/project/delete-multiple/{id}',['uses' => 'ProjectController@deleteMultiple']);
	});
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


