<?php

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
    return redirect('/login');
});
Route::get('/home', 'HomeController@index');

Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
//トップページ
Route::get('/top','PostsController@index')->middleware('auth');
//投稿処理
Route::post('/post/create','PostsController@postCreate')->middleware('auth');
//投稿編集処理
Route::post('/post/update','PostsController@update')->middleware('auth');
//投稿削除
Route::get('/post/{id}/delete', 'PostsController@delete')->middleware('auth');

//プロフィールページ
Route::get('/profile/{id}','UsersController@userProfile')->middleware('auth');
//プロフィールページ　フォローボタンを押下したときの動作
Route::get('/{id}/following', 'UsersController@following')->middleware('auth');
//プロフィールページ　フォロー解除ボタンを押下したときの動作
Route::get('/{id}/unfollow', 'UsersController@unfollow')->middleware('auth');

//プロフィール編集ページ
Route::get('/{id}/updateProfile','UsersController@update')->middleware('auth');
//プロフィール編集機能
Route::post('/profile/update','UsersController@updateProfile')->middleware('auth');


//ユーザー検索ページ
Route::get('/search','UsersController@search')->middleware('auth');
//フォローボタンを押下したときの動作
Route::get('/{id}/following', 'FollowsController@following')->middleware('auth');
//フォロー解除ボタンを押下したときの動作
Route::get('/{id}/unfollow', 'FollowsController@unfollow')->middleware('auth');
//フォローリストページ
Route::get('/follow-list','FollowsController@followList')->middleware('auth');
//フォロワーリストページ
Route::get('/follower-list','FollowsController@followerList')->middleware('auth');

//ログアウト
Route::get('/logout','Auth\LoginController@logout');
