<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupChat;
use Illuminate\Http\Request;
use App\Events\GroupChatEvent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\FileAddGroupChatEvent;
use App\Events\GroupChatMessageDelete;
use App\Events\GroupMessageUpdateEvent;

class GroupChatController extends Controller
{
    public function index(){
        $user=User::find(Auth::id());
        $count = DB::table('notifications')->where('notifiable_id', Auth::id())->where('read_at', Null)->count();

        $groups=Group::where('creator_id',Auth::id())->get();
        $join_groups=DB::table('group_members')->where('user_id',Auth::id())->pluck('group_id')->toArray();
       
        $other_groups=Group::whereIn('id',$join_groups)->get();
      
        return view('frontend.group.groupChat',compact('groups','other_groups','user','count'));
    }

    public function chatStore(Request $request){
        $data=$request->all();
        // dd($data);
        $sender_id=Auth::id();
       $chatGroup= GroupChat::create([
           'group_id'=>$data['group_id'],
           'message'=>$data['message'],
           'sender_id'=>$sender_id,
        ]);
        
        
            if(array_key_exists('file',$data)){
                foreach ($data['file'] as $key => $file) {
                    
                    $size=$file->getSize()/1024/1024;
                    $fileName=$file->getClientoriginalName();
                    $exploaded=explode('.',$fileName);
                    $extension=$exploaded[count($exploaded)-1];
                    // dd($extension);
                    if($extension=="mp4"){
                        $chatGroup->addMedia($file)->toMediaCollection('group_chat_video');
                    }
                    if($extension=="pdf"){
                        $chatGroup->addMedia($file)->toMediaCollection('group_chat_pdf');
                    }
                    if($extension=="png" || $extension=="jpg" || $extension=="jpeg" || $extension=="gif"){

                        $chatGroup->addMedia($file)->toMediaCollection('group_chat_image');
                    }
                }

            
        }
      $image=$chatGroup->hasMedia('group_chat_image') ? $chatGroup->getMedia('group_chat_image')[0]->getFullUrl():'';
      $video=$chatGroup->hasMedia('group_chat_video') ? $chatGroup->getMedia('group_chat_video')[0]->getFullUrl():'';
      $pdf=$chatGroup->hasMedia('group_chat_pdf') ? $chatGroup->getMedia('group_chat_pdf')[0]->getFullUrl():'';
        

        $groupMessage=GroupChat::with('userInfo','media')->where(['group_id'=>$data['group_id'], 'message'=>$data['message'],'sender_id'=>$sender_id,])->first();
        
        $src=$groupMessage->userInfo->hasMedia('user_image') ? $groupMessage->userInfo->getMedia('user_image')[0]->getFullUrl(): asset('image/images.jpg');
        $time=$groupMessage->created_at->diffForHumans();
  

        // $src=$chatGroup->hasMedia('group_chat_image') ? $chatGroup->getMedia('group_chat_image')[0]->getFullUrl():'';
    
      
        event(new GroupChatEvent($groupMessage,$src,$time,$image,$video,$pdf));

        return response()->json([
            'status'=>true,
            'view'=>view('frontend.group.component.messageSend',compact('groupMessage','src'))->render()
        ]);
    }
    public function loadGroupChatMessage(Request $request){
        $group=Group::find($request->group_id);
        $groupChats=GroupChat::with('userInfo','media')->where('group_id',$request->group_id)->get();
      

        $user=User::find($request->sender_id);
       
        return response()->json([
            'status'=>true,
            'group'=> $group,

            'view'=>view('frontend.group.component.groupMessageLoad',compact('groupChats','user','group'))->render()
        ]);
    }

    public function deleteMessage($id){
        $chat=GroupChat::find($id);
        if($chat){

            if($chat->hasMedia('group_chat_image') || $chat->hasMedia('group_chat_video') || $chat->hasMedia('group_chat_pdf') ){
                DB::table('media')->where('model_type','App\Models\GroupChat')->where('model_id',$chat->id)->delete();
            }
            $chat->delete();
        }

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

    public function GroupImageSend(Request $request){
        $data=$request->all();
        // dd($data);
        $sender_id=$data['sender_id'];
        $groupChat=GroupChat::where('group_id',$data['group_id'])->first();
        $groupChat->addMedia($data['file'])->toMediaCollection('group_chat_image');
        // $sender_id=$data['sender_id'];
        $src=$groupChat->hasMedia('group_chat_image') ? $groupChat->getMedia('group_chat_image')[0]->getFullUrl():'';
        // dd($src);
    
        $src =DB::table('media')->where('model_type','App\Models\GroupChat')->where('model_id',$groupChat->id)->orderByDesc('created_at')->first();
      $path= url('/').'/storage/'.$src->id.'/'.$src->file_name;
        // dd($path);
        event(new FileAddGroupChatEvent($sender_id,$groupChat,$path));
        return response()->json([
             'status'=>true,
             'view'=>view('frontend.group.component.fileAdd',compact('groupChat','sender_id','path','src'))->render()
         ]);

    }
    public function deleteGroupChatImage(Request $request){
        dd($request->all());
    }

    public function showGroupPic(Request $request){
        // dd($request->all());
        $group=GroupChat::where('group_id',$request->group_id)->with('media')->first();
        // dd(count($group->getMedia('group_chat_image'))>0);
        // foreach ($group->getMedia('group_chat_image') as $key => $value) {
        //     dd($value->getUrl());
        // }
        
        if($group){
            return response()->json([
                'status'=>true,
                'view'=> view('frontend.group.component.showgallery',compact('group'))->render()
            ]);
        }


    }
    public function DeleteGroupImageFile(Request $request){
        $id=$request->id;
        if($id){
            DB::table('media')->where('id',$id)->delete();
           
            return response()->json([
                'status'=>true,
                'message'=>'Success'
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'Not found id'
            ]);
        }
    }

}
