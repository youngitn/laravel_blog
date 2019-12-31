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

use Illuminate\Support\Facades\Request;

Route::get('/', function () {
    return view('welcome');
});

//使用controller前
// Route::get('/posts/', function () {
//     $response = "All Posts: ";
//     $posts = App\Post::all();
//     foreach ($posts as $post) {
//         $response .= $post;
//     }
//     echo 'res:::::'.$response;
//     return $response;
// });

// Route::get('/posts/insert', function(Request $request) {
//     $post = new App\Post;
//     //取得req中叫做post_text的值
//     $text =  Request::input('post_text');
//     //值給物件屬性
//     $post->post_text =$text;
//     $post->save();
// });


//使用controller後
Route::get('/posts/', 'PostController@allPost');


Route::get('/posts/insert', 'PostController@insertPost');
Route::post('/post', 'PostController@insertPost');

Route::post('/post/form', function () {
    return view('post_form');
});

//r要進該路徑需要auth
Route::get('/post/form', function () {
    return view('post_form');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//--------------------------------------------------
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/employees', 'EmployeeController@index')->name('employees.index');
Route::get('/employees/{id}/edit','EmployeeController@edit')->name('employees.edit');
Route::get('/employees/{id}/delete','EmployeeController@destroy')->name('employees.destroy');
Route::get('/create','EmployeeController@create')->name('employees.create');
Route::post('/create','EmployeeController@store')->name('employees.store');
Route::post('/employee/update','EmployeeController@update')->name('employees.update');
