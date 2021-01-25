<?php

use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Models\User;


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

/*
------------------------------------------------------------------
    HOME
------------------------------------------------------------------
*/


Route::get('/', function () {

    return view('welcome');

});





/*
------------------------------------------------------------------
    BASIC INSERT WITH ELOQUENT
------------------------------------------------------------------
*/

Route::get('/basicinsert', function(){

    $post = new Post;

    $post->title = 'new ORM titls insert';
    $post->content = 'wow i did it';

    $post->save();

});


/*
------------------------------------------------------------------
    SAFE? INSERT WITH ELOQUENT
------------------------------------------------------------------
*/

Route::get('/basicinsert2', function(){

    $post = Post::find(2);

    $post->title = 'changedit fam';
    $post->content = 'gg';

    $post->save();

});





Route::get('/create', function(){


    Post::create(['title'=> 'the create method', 'content'=>'im learning such amazing stuff and i love it']);


});


/*
------------------------------------------------------------------
    UPDATE WITH ELOQUENT
------------------------------------------------------------------
*/


Route::get('/update', function(){

    Post::where('id', 3)->where('is_admin', 0)->update(['title'=>'nee title', 'content'=>'updating it fams']);


});



/*
------------------------------------------------------------------
    DELETE WITH ELOQUENT 1 (WORKS BUT TOO MUCH)
------------------------------------------------------------------
*/

Route::get('/delete', function(){

$post = Post::find(16);

$post->delete();

});



/*
------------------------------------------------------------------
    DELETE WITH ELOQUENT 2 (BETTER)
------------------------------------------------------------------
*/


Route::get('/delete2', function(){
    Post::destroy(14);

});


/*
------------------------------------------------------------------
    MASS DELETE WITH ELOQUENT
------------------------------------------------------------------
*/


Route::get('/massdelete', function(){
    Post::destroy([2,4,5,6]);


    //another test

    Post::where('is_admin', 0)->delete();

});

/*
------------------------------------------------------------------
    SOFT DELETE WITH ELOQUENT
------------------------------------------------------------------
*/


Route::get('/softdelete', function(){

    Post::find(8)->delete();

});



/*
------------------------------------------------------------------
   READ SOFT DELETE WITH ELOQUENT
------------------------------------------------------------------
*/


Route::get('/readsoftdelete', function(){

    // $post = Post::find(5);
    // return $post;

//    $post = Post::withTrashed()->where('id', 5)->get();
//    return $post;

    $post = Post::onlyTrashed()->where('id', 4)->get();
   return $post;

});



/*
------------------------------------------------------------------
   RESTORE SOFT DELETE WITH ELOQUENT
------------------------------------------------------------------
*/


Route::get('/restore', function(){


    Post::withTrashed()->where('is_admin', 0)->restore();

});



/*
------------------------------------------------------------------
   FORCE DELETE WITH ELOQUENT
------------------------------------------------------------------
*/

Route::get('/forcedelete', function(){

Post::onlyTrashed()->where('is_admin', 0)->forceDelete();

});


/*
------------------------------------------------------------------
   ELOQEUNT RELATIONSHIPS
------------------------------------------------------------------
*/


Route::get('/user/{id}/post', function($id){

    return User::find($id)->post;

});


/*
------------------------------------------------------------------
   ELOQEUNT RELATIONSHIPS
------------------------------------------------------------------
*/


Route::get('/post/{id}/user', function($id){

    return Post::find($id)->user->name;
});



Route::get('/posts', function(){

    $user = User::find(1);

    foreach($user->posts as $post){

       echo $post->title . "<br>";


    }

});

/*
------------------------------------------------------------------
   ELOQEUNT RELATIONSHIPS ONE TO ONE
------------------------------------------------------------------
*/







/*
------------------------------------------------------------------
    BASIC RAW SQL
------------------------------------------------------------------
*/


// Route::get('/post/{name}','\App\Http\Controllers\PostsController@index');

// Route::get('/insert', function(){

//     DB::insert('insert into posts(title, content) values(?,?)', ['a test insert', 'testing an insert with laravel']);

// });


// Route::get('/read', function() {

//    $results =  DB::select('select * from posts where id = ?', [3]);

//     foreach($results as $post) {
//     return ($post->title);
//     }
// });



//UPDATE

// Route::get('/update', function() {

//     $updated = DB::update('update posts set title = "updated title" where id =?', [2]);

//     return $updated;
// });

// Route::get('/delete', function(){

//     $deleted = DB::delete('delete from posts where id = ?', [4]);

//     return $deleted;


// });




/*
------------------------------------------------------------------
    ELOQUENT
------------------------------------------------------------------
*/


// Route::get('/read', function(){


// $posts = Post::all();

// foreach($posts as $post) {
// return $post->title;
// }

// });

// Route::get('/find', function(){

// $post = Post::find(8);
// return $post->title;

// });


// Route::get('/findwhere', function(){

//     $posts = Post::where('id', 158)->orderBy('id', 'asc')->take(1)->get();

//     return  $posts;


// });


// Route::resource('posts', '\App\Http\Controllers\Postscontroller');

Route::get('/contact','\App\Http\Controllers\PostsController@contact');

Route::get('post', '\App\Http\Controllers\PostsController@post');
