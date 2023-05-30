<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GroupChatController;
use App\Http\Controllers\FriendShipController;

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


// Route::get('/javascript', function () {
//     return view('userView');
// });
Route::get('/', function () {
    return view('front.index');
});

Route::get('/user', [App\Http\Controllers\HomeController::class, 'userHome']);



Auth::routes();

Route::get('/view', [App\Http\Controllers\HomeController::class, 'index'])->name('ajaxView');
Route::get('/view/userImage/{id}', [App\Http\Controllers\HomeController::class, 'userImage'])->name('ajaxViewImage');
Route::get('/view/user', [App\Http\Controllers\HomeController::class, 'userView'])->name('ajaxViewUser');
Route::get('/view/user-edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit_ajaxUser');
Route::post('/view/user-update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update_ajaxUser');
// Route::post('/view/user-update/photo/{id}', [App\Http\Controllers\UserController::class, 'ProfileChange'])->name('ProfileChange');
Route::middleware('auth')->controller(UserController::class)->group(function () {

    Route::get('/user','userhome')->name('userhome');
    Route::get('/home/chat','index')->name('chat');
    Route::get('/home/post','post')->name('post');
    Route::get('/home','home')->name('home');
    Route::post('/home/chat','saveChat')->name('saveChat');
    Route::post('/load-chat','loadChat')->name('loadChat');
    Route::post('/delete-chat','messageDelete')->name('messageDelete');
    Route::get('/userProfile','userProfile')->name('userProfile')->middleware('auth');
    Route::post('/ProfileChange/photo/{id}','ProfileChange')->name('ProfileChange');
    Route::PUT('/ProfileChange/{id}','user_password')->name('user_password');

    // notification

    Route::post('/notification/{id}','motification_read')->name('motification_read');
    Route::post('/notification','motification_readAll')->name('motification_readAll');



Route::middleware('auth')->prefix('admin')->group(function(){
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category','index')->name('category');
        Route::get('/category/create','create')->name('category.create');
        Route::post('/category','store')->name('category.store');
        Route::get('/category/edit/{id}','edit')->name('category.edit');
        Route::put('/category/{id}','update')->name('category.update');
        Route::get('/category/delete/{id}','delete')->name('category.destroy');
    });
    Route::controller(FriendShipController::class)->group(function(){
        Route::get('/friends','index')->name('friends');
        Route::get('/yourfriends','Yourfriends')->name('Yourfriends');
        Route::post('/friends/request-send','FriendRequestSend')->name('friend_request.send');
        Route::get('/friends/Sendrequest-cancle/{id}','FriendRequestCancle')->name('send_request.cancleBySender');
        Route::post('/friends/request-accept/{id}','FriendRequestAccept')->name('friend_request.accept');
        Route::get('/friends/request-cancle/{id}','FriendRequestCancleByUser')->name('friend_request.ByUsercancle');
        Route::get('/friends/request-profile/{id}','FriendRequestProfile')->name('friend_list.profile');
        Route::get('/friends/profile-delete/{id}','FriendDelete')->name('friend_list.delete');

    });

    Route::controller(PostController::class)->group(function(){
        Route::get('/post','index')->name('post_admin');
        Route::get('/post/create','create')->name('post.create');
        Route::post('/post','store')->name('post.store');
        Route::get('/post/edit/{id}','edit')->name('post.edit');
        Route::put('/post/{id}','update')->name('post.update');
        Route::get('/post/delete/{id}','delete')->name('deletepost');
    });

    Route::controller(LikeController::class)->group(function(){
        Route::post('/home/like/{id}','likeStore')->name('likeStore');
        Route::get('/home/unlike/{id}','likeDelete')->name('likeDelete');

    });
    Route::controller(CommentController::class)->group(function(){
        Route::post('/home/comment/{id}','commentPost')->name('post.comment');
        Route::get('/home/comment/edit/{id}','commentEdit')->name('comment.edit');
        Route::put('/home/comment/update/{id}','comment_update')->name('comment_update');
        // Route::delete('/home/unlike/{id}','likeDelete')->name('likeDelete');
        Route::get('/home/comment/{id}','commentShow')->name('comment.show');
        Route::get('/home/comment/delete/{id}','comment_delete')->name('comment_delete');


    });
    // group
    Route::controller(GroupController::class)->group(function(){
        Route::get('/group','index')->name('group');
        Route::post('/groups','store')->name('groupCreate');
        Route::get('/groups/members','getMember')->name('getmember');
        Route::post('/groups/members','AddMember')->name('groupMember');
        Route::get('/groups/members/{id}','groupDelete')->name('groupDelete');
        Route::post('/groups/members/edit/{id}','groupEdit')->name('groupEdit');
        Route::get('share-group/{id}','GroupShare')->name('GroupShare');
        Route::post('group/joinGroup','joinGroup')->name('joinGroup');
    });
    
     
   });
        Route::controller(GroupChatController::class)->group(function(){
            Route::get('/groupchat','index')->name('groupChat');
            Route::post('/groupchat/message','chatStore')->name('GroupchatStore');
            Route::get('/groups/chat','loadGroupChatMessage')->name('loadGroupChat');
            Route::get('/groups/message/delete/{id}','deleteMessage')->name('deleteGroupMessage');
            Route::post('/groups/message/update','updateMessage')->name('updateGroupMessage');
            Route::post('/groups/message/image','GroupImageSend')->name('GroupImageSend');
        });
});
