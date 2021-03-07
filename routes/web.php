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
Route::group(['as'=>'frontend.', 'namespace'=>'App\Http\Controllers\Frontend'], function(){
		// Member
	route::get('/member', [App\Http\Controllers\Frontend\MemberController::class, 'index'])->name('member.index');
	route::get('/login', [App\Http\Controllers\Frontend\MemberController::class, 'getLogin'])->name('show.login');
	route::post('/login', [App\Http\Controllers\Frontend\MemberController::class, 'postLogin'])->name('post.login');

	route::get('/register', [App\Http\Controllers\Frontend\MemberController::class, 'getRegister'])->name('show.register');
	route::post('/register', [App\Http\Controllers\Frontend\MemberController::class, 'postRegister'])->name('post.register');

	route::get('/job', [App\Http\Controllers\Frontend\MemberController::class, 'getJob'])->name('show.job');
	route::put('/member/{id}', [App\Http\Controllers\Frontend\MemberController::class, 'updateMember'])->name('put.member');
		// End Member
});


