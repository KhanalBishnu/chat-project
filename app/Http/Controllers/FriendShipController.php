<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendShip;
use function Sodium\compare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Alert;

class FriendShipController extends Controller
{
    public function index(){
        $users=User::latest()->whereNotIn('id',[Auth::id()])->get();
        // jaslai send gareko ho tesko ma feri send request dekhinu vayan jasle pathako ho 
        $friend_send=FriendShip::where('friend_id',Auth::id())->get();
        // dd($friend_send);
        $user_id_arr=[];
        foreach ($friend_send as $key => $value) {
           array_push($user_id_arr,$value['user_id']);
           
        }
        $friends=FriendShip::with('users')->where('friend_id',Auth::id())->where('status','pending')->get();
        $count=DB::table('notifications')->where('notifiable_id',Auth::id())->where('read_at',Null)->count();

        // if uaer accept your friend request and you need remove from list 
        $acceptedByUser=FriendShip::where('user_id',Auth::id())->where('status','accepted')->get();
        $ifacceptedByUser_arr=[];
        foreach ($acceptedByUser as $key => $value) {
            array_push($ifacceptedByUser_arr,$value['friend_id']);
        }

        return view('frontend.friend.index',compact('count','users','friends','user_id_arr','ifacceptedByUser_arr'));
    }

    public function FriendRequestSend(Request $request){
        $data=$request->all();
        try {
           
            DB::transaction(function() use ($data) {
                FriendShip::create([
                    'friend_id'=>$data['friend_id'],
                    'user_id'=>Auth::id(),
                    'status'=>'pending'
                ]);
            });
            Alert::success('Success ', 'Friend Request Send');
            return back();
            

        } catch (\Throwable $th) {
            Alert::error('error', 'Something went Wrong');
            return back();

        }
    }

    public function FriendRequestCancle($id){
        $cancle_request=FriendShip::where('user_id',Auth::id())->where('friend_id',$id)->where('status','pending')->first();
        // dd($cancle_request);
        if($cancle_request){
            $cancle_request->delete();
            Alert::success('Success ', 'Friend Request Cancle ');
            return back();
        }else{
            Alert::error('error', 'Something went Wrong');
            return back();
        }
    }

    public function FriendRequestCancleByUser($id){
        $cancle_request=FriendShip::where('friend_id',Auth::id())->where('user_id',$id)->where('status','pending')->first();
      
        if($cancle_request){
            $cancle_request->delete();
            Alert::success('Success ', 'Friend Request Rejected ');
            return back();
        }else{
            Alert::error('error', 'Something went Wrong');
            return back();
        }
    }

    public function FriendRequestAccept($id){
        // dd($id);

        $accept_request=FriendShip::where('friend_id',Auth::id())->where('user_id',$id)->first();
        if($accept_request){
            $accept_request->update([
                'status'=>'accepted'
            ]);
            Alert::success('Success ', 'Friend Request accepted ');
            return back();
        }
    }
  

    public function Yourfriends(){
        // for main blade 
        $user=User::find(Auth::id());
        $yourFriends=FriendShip::with('user')->where('user_id',Auth::id())->orWhere('friend_id',Auth::id())->where('status','accepted')->get();
        // dd($yourFriends);

        $count=DB::table('notifications')->where('notifiable_id',Auth::id())->where('read_at',Null)->count();

        return view('frontend.friend.yourFriend',compact('yourFriends','count','user'));
    }

    public function FriendRequestProfile($id){
        $count=DB::table('notifications')->where('notifiable_id',Auth::id())->where('read_at',Null)->count();

        $user=User::find($id);
        return view('frontend.friend.friendsProfile',compact('user','count'));
    }
}
