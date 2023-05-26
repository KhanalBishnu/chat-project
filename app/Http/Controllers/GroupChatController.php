<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupChat;
use Illuminate\Http\Request;
use App\Events\GroupChatEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\GroupChatMessageDelete;

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
    public function loadGroupChatMessage(Request $request){
        $group=Group::find($request->group_id);
        $groupChats=GroupChat::where('group_id',$request->group_id)->get();
        // $userId_arr=[];
        // foreach ($groupChats as $key => $group) {
        //         array_push($userId_arr,$group->sender_id);
        // }
        // $users=User::whereIn('id',$userId_arr)->get();
     
        $user=User::find($request->sender_id);
        return response()->json([
             'status'=>true,
             'data'=>$groupChats,
             'user'=>$user,
             'group'=> $group,
        ]);
    }

    public function deleteMessage($id){
        GroupChat::find($id)->delete();
        event(new GroupChatMessageDelete($id));
        return response()->json([
            'status'=>true,
            'message'=>'Group message deleted successfully',
        ]);
    }
}
