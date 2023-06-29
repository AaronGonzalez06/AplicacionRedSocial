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

//use App\Image;

Route::get('/', function () {
    /*
        $images = Image::all();
        
        foreach($images as $image){
            
          echo  $image->image_path ."<br/>" ; 
          echo $image->user->name . ' '.$image->user->surname;
          
          if(count($image->comments)>=1){
          foreach($image->comments as $comment){
              echo "<h4>comentarios.</h4>";
              echo $comment->content.'<br/>';
              echo "<hr/>";
          }
          echo "<hr/>";
        }
        
          }
    
    die();*/
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/image', 'ImageController@create')->name('image.create');
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');
Route::post('/image/save','ImageController@save')->name('image.save');
Route::get('/user/update','UserController@password')->name('user.password');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');

Route::get('/image/file/{filename}','ImageController@getImage')->name('image.file');

Route::get('/imagen/{id}','ImageController@detail')->name('image.detail');


Route::get('/mylikes','LikeController@index')->name('like.index');


Route::post('/user/password','UserController@update_password')->name('user.password_update');

Route::post('/comment','CommentController@store')->name('comment.store');

Route::get('/comment/delete/{id}','CommentController@delete')->name('comment.delete');

Route::get('/like/{image_id}','LikeController@like')->name('like.save');

Route::get('/dislike/{image_id}','LikeController@dislike')->name('like.delete');  

Route::get('/perfil/{id}','UserController@profile')->name('profile');

Route::get('/image/delete/{id}','ImageController@delete')->name('image.delete');  

Route::get('/image/editar/{id}','ImageController@edit')->name('image.edit');  

Route::post('/image/update','ImageController@update')->name('image.update');

Route::get('/gente/{search?}','UserController@index')->name('user.index');  
