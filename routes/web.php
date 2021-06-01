<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

/* DEFAULT ROUTE */
// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::get("/", "HomeController@index")->name('home');
Route::get('/home', "HomeController@index")->name('home');
// Route::get('/home', [HomeController::class, "index"]);


// view post
Route::get("/posts/view/{slug}", "PostController@view")->name("posts.view");

// Rotas com autenticação
Route::middleware('auth')->group(function () {

    // Rotas que só o moderador pode acessar
    Route::middleware('role')->group(function () {
        // categories
        Route::get("/categories", "CategoryController@index")->name("categories");
        Route::get("/categories/add", "CategoryController@form")->name("categories.add");
        Route::get("/categories/edit/{id}", "CategoryController@form")->name("categories.edit");
        Route::post("/categories/save/{id?}", "CategoryController@save")->name("categories.save");
        Route::get("/categories/delete/{id}", "CategoryController@delete")->name("categories.delete");
        
        // users
        Route::post("/users/deactivate/{id}", "UserController@deactivate")->name("users.deactivate");
    });
    
    // Rotas para todos autenticados
    // users
    Route::get("/users", "UserController@index")->name("users");
    Route::get("/users/edit", "UserController@form")->name("users.edit");
    Route::post("/users/save", "UserController@save")->name("users.save");

    // posts
    Route::get("/posts", "PostController@index")->name("posts");
    Route::get("/posts/add", "PostController@form")->name("posts.add");
    Route::get("/posts/edit/{id}", "PostController@form")->name("posts.edit");
    Route::post("/posts/save/{id?}", "PostController@save")->name("posts.save");
    Route::get("/posts/delete/{id}", "PostController@delete")->name("posts.delete");
    Route::get("/posts/restore/{id}", "PostController@restore")->name("posts.restore");
});
