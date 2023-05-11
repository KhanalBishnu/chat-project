<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Chat;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Events\MessageEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\MessageDeletedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\messageSendNotify;
use Illuminate\Support\Facades\Notification;
use App\Models\FriendShip;

class UserController extends Controller
{

    public function index(){
        if(Auth::id()){
            $count=DB::table('notifications')->where('notifiable_id',Auth::id())->where('read_at',Null)->count();
            $users=User::whereNotIn('id',[auth()->user()->id])->get();
            // $users=FriendShip::with('user')->where('user_id',Auth::id())->where('status','accepted')->get();
            return view('home',compact('users','count'));
        }else{
            return "login";
        }
    }

    public function saveChat(Request $request){
        try {
            $chat=Chat::create([
                'sender_id'=>$request->sender_id,
                'receiver_id'=>$request->receiver_id,
                'message'=>$request->message
            ]);
            $user=User::find($request->sender_id);
            $data['message']=$request->message;
            $data['sender_id']=$user->name;
         

            event(new MessageEvent($chat));
            Notification::send(User::where('id',$request->receiver_id)->first(),new messageSendNotify($data));

            return response()->json(['success'=>true,'data'=>$chat]);
        } catch (\Throwable $th) {
            return response()->json(['success'=>false,'msg'=>$th->getMessage()]);
        }
    }

    public function loadChat(Request $request){
        try {
            $chats=Chat::where(function($q) use($request){
                $q->where('sender_id','=',$request->sender_id)
                ->orWhere('sender_id','=',$request->receiver_id);
            })->where(function($q) use($request){
                $q->where('receiver_id','=',$request->sender_id)
                ->orWhere('receiver_id','=',$request->receiver_id);
            })->get();

            $user=User::find($request->receiver_id);
            return response()->json(['success'=>true,'data'=>$chats ,'user'=>$user]);
        } catch (\Throwable $th) {
            return response()->json(['success'=>false,'msg'=>$th->getMessage()]);

        }
    }

    public function userProfile(){
        
        $id=Auth::id();
        if($id){
            $user=User::find($id);
            $count=DB::table('notifications')->where('notifiable_id',Auth::id())->where('read_at',Null)->count();
            

            return view('user.userProfile',compact('user','count'));
        }
        
    }

    public function ProfileChange(Request $request,$id){
        // dd($request->img);
       
        $user=User::find($id);
        if($user){
            
            if($user->hasMedia('user_image')){
                $user->clearMediaCollection('user_image');
            }
             $user->addMedia($request->img)->toMediaCollection('user_image');
        }
      
        return response()->json(['src'=>$user->hasMedia('user_image')?$user->getMedia('user_image')[0]->getFullUrl():'']);
        
    }

    public function user_password(Request $request,$id){
        $user=User::find($id);
        $request->validate([
            'current_password'=>'string|required',
            'new_password'=>'required|string',
            'confirm_password'=>['same:new_password'],
        ]);

        $currentPassword=Hash::checK($request->current_password,auth()->user()->password);
        if($currentPassword){
           $user->update([
                'password'=>Hash::make($request->new_password)
            ]);
             Alert::success('success', 'updated Password');
             return back();
         
        }else{
            Alert::error('Error', 'Something Went Wrong!');
            return back();
        }
    }

    public function post(){
        // get friend post 
        $friendPost=FriendShip::where('user_id',Auth::id())->where('status','accepted')->get('friend_id');
        $friendpoSt=Post::whereIn('user_id',$friendPost)->get();
        // dd($friendpoSt);
      
        $categories=Category::all();
        $user=User::find(Auth::id());
        $post=Post::with('comments')->latest()->get();
        $count=DB::table('notifications')->where('notifiable_id',Auth::id())->where('read_at',Null)->count();
       

        return view('frontend.post.post',compact('categories','post','user','count' ,'friendpoSt'));
    }
    public function home(){
        $user=User::find(Auth::id());
        $count=DB::table('notifications')->where('notifiable_id',Auth::id())->where('read_at',Null)->count();
        return view('frontend.post.main',compact('user','count'));
    }

    // delete chat 
    public function messageDelete(Request $request){
        try {
                Chat::where('id',$request->id)->delete();
                event(new MessageDeletedEvent($request->id));
            
            return response()->json(['success'=>true,'msg'=>'Message deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success'=>true,'msg'=>$th]);
            
        }
    }
    //notification read
    public function motification_read($id){
       
            $notification =DB::table('notifications')->where('id',$id)->update(['read_at'=>now()]);
             $count=DB::table('notifications')->where('notifiable_id',Auth::id())->where('read_at',Null)->count();
            return response()->json([
                'status'=>true,
                // 'view'=>view('frontend.post.component.notification',compact('count'))->render()
                'count'=>$count,
                
            ]);
      
    }
    public function motification_readAll(){
            $user=Auth::user();
            if($user){
                $user->unreadNotifications()->update(['read_at' => now()]);
            }
             $count=DB::table('notifications')->where('notifiable_id',Auth::id())->where('read_at',Null)->count();
            return response()->json([
                'status'=>true,
                'count'=>$count,

            ]);
      
    }
}
