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
use App\Events\GroupMessageUpdateEvent;

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
        GroupChat::create([
           'group_id'=>$data['group_id'],
           'message'=>$data['message'],
           'sender_id'=>$sender_id,
        ]);
        $groupMessage=GroupChat::with('userInfo')->where(['group_id'=>$data['group_id'], 'message'=>$data['message'],'sender_id'=>$sender_id,])->first();
        $src=$groupMessage->userInfo->hasMedia('user_image') ? $groupMessage->userInfo->getMedia('user_image')[0]->getFullUrl(): asset('image/images.jpg');
        $time=$groupMessage->created_at->diffForHumans();
        // dd($time);
        
        event(new GroupChatEvent($groupMessage,$src,$time));

        // return response()->json([
        //      'status'=>true,
        //      'data'=>$groupMessage,
        // ]);
        return response()->json([
            'status'=>true,
            'view'=>view('frontend.group.component.messageSend',compact('groupMessage'))->render()
        ]);
    }
    public function loadGroupChatMessage(Request $request){
        $group=Group::find($request->group_id);
        $groupChats=GroupChat::with('userInfo')->where('group_id',$request->group_id)->get();
        // dd($groupChats);
     
        $user=User::find($request->sender_id);
        // return response()->json([
        //      'status'=>true,
        //      'data'=>$groupChats,
        //      'user'=>$user,
        //      'group'=> $group,
        // ]);
        return response()->json([
            'status'=>true,
            'group'=> $group,

            'view'=>view('frontend.group.component.groupMessageLoad',compact('groupChats','user','group'))->render()
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

    public function updateMessage(Request $request){
        // dd($request->all());
        $data=$request->all();
        $groupMessage=GroupChat::find($data['id']);
        if($groupMessage){
            $groupMessage->update(['message'=>$data['message']]);
        }
        event(new GroupMessageUpdateEvent($groupMessage));
        return response()->json([
            'status'=>true,
            'groupMessage'=>$groupMessage,

        ]);

    }
}
