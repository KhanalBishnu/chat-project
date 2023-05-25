<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\GroupChatEvent;

class GroupChatController extends Controller
{
    public function index(){
        $user=User::find(Auth::id());
        $count = DB::table('notifications')->where('notifiable_id', Auth::id())->where('read_at', Null)->count();

        $groups=Group::where('creator_id',Auth::id())->get();
        $join_groups=DB::table('group_members')->where('user_id',Auth::id())->pluck('group_id')->toArray();
        // dd($join_groups);
        $other_groups=Group::whereIn('id',$join_groups)->get();
        // dd($other_groups);
        return view('frontend.group.groupChat',compact('groups','other_groups','user','count'));
    }

    public function chatStore(Request $request){
        $data=$request->all();
        $sender_id=Auth::id();
        $groupMessage=GroupChat::create([
           'group_id'=>$data['group_id'],
           'message'=>$data['message'],
           'sender_id'=>$sender_id,
        ]);
        event(new GroupChatEvent($groupMessage));

        return response()->json([
             'status'=>true,
             'data'=>$groupMessage,
        ]);
    }
}
