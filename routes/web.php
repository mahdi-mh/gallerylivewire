<?php

use App\Models\Post;
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
    return view('indexGalleryPosts',['posts' => Post::all()->sortDesc()->take(6)]);
})->name('home');

Route::namespace('App\Http\Controllers\Auth')->group(function () {
    Route::get('/login','LoginController@loginView')->name('login');
    Route::post('/login','LoginController@ProcessLogin')->name('login');
    Route::get('/logout','LoginController@logout')->name('logout');
    Route::get('/register','LoginController@registerView')->name('register');
    Route::post('/register','LoginController@registerProcess')->name('register');
});

Route::prefix('posts')
    ->namespace('App\Http\Controllers')
    ->group(function (){
        Route::get('/{post}', 'PostsController@ShowSingle');
    });

Route::prefix('admin')
    ->middleware(['auth','admin.auth'])
    ->namespace('App\Http\Controllers\Admin')
    ->group(function () {
        Route::get('/posts','AdminPostsController@IndexView')->name('adminPosts');
        Route::get('/categories','AdminCategoryController@IndexView')->name('adminCategories');
        Route::get('/comments','AdminCommentsController@IndexView')->name('adminComments');
        Route::get('/tags','AdminTagsController@IndexView')->name('adminTags');
    });
