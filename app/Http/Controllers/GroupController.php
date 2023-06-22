<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupChat;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public  function index()
    {
        $user = User::find(Auth::id());
        $count = DB::table('notifications')->where('notifiable_id', Auth::id())->where('read_at', Null)->count();
        $groups = Group::where('creator_id', Auth::id())->get();

        return view('frontend.group.index', compact('user', 'count', 'groups'));
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $data = $request->all();
            $group = Group::create([
                'creator_id' => Auth::id(),
                'name' => $request->name,
                'join_limit' => $request->group_limit
            ]);
            if ($request->image) {
                $group->addMedia($request->image)->toMediaCollection('group_image');
            }
            return response()->json([
                'status' => true,
                'message' => $data['name'] . 'Group Created Successfully',
                'data' => $group
            ]);
        } catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' =>$th->getMessage(),
                
            ]);
        }
    }

    public function getMember(Request $request)
    {
        $data=$request->all();
        $user = User::find(Auth::id());

        
        // $checkedGroupMember=GroupMember::where('group_id',$data['group_id'])->get('user_id')->toArray();
        $checkedGroupMember=GroupMember::where('group_id',$data['group_id'])->pluck('user_id')->toArray();
        // dd($checkedGroupMember);

        $members = User::where(function ($query) use ($user) {
            $query->whereExists(function ($query) use ($user) {
                $query->from('friend_ships')
                    ->whereRaw('friend_ships.friend_id = users.id')
                    ->where('friend_ships.user_id', $user->id)
                    ->where('friend_ships.status', 'accepted');
            })->orWhereExists(function ($query) use ($user) {
                $query->from('friend_ships')
                    ->whereRaw('friend_ships.user_id = users.id')
                    ->where('friend_ships.friend_id', $user->id)
                    ->where('friend_ships.status', 'accepted');
            });
        })->get();
        // dd($members);

        return response()->json([
            'status' => true,
            'data' => $members,
            'groupMembers'=>$checkedGroupMember,
            'view'=>view('frontend.group.response_group_member',compact('members','checkedGroupMember'))->render()
        ]);
    }

    public function AddMember(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        try {
            if (!isset($data['members'])) {
                return response()->json(['status' => false, 'message' => 'At least one member select plz! ']);

            } 
            else if (count($data['members'] ) > (int)$data['limit']) {

                return response()->json(['status' => false, 'message' => 'Onlu you can select ' . $data['limit'] . ' members']);
            }
             else { 
               GroupMember::where('group_id',$data['group_id'])->delete();
                foreach ($data['members'] as  $value) {
                   
                    GroupMember::create([
                        'group_id'=>$data['group_id'],
                        'user_id'=>$value
                    ]);
                }
                // dd($members);
                return response()->json([
                    'status' => true,
                    'message'=>'Member Added Successfully',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    // delete group 
    public function groupDelete($id){
        // dd($id);
        $group=Group::find($id);
        // dd($group);
        try {
            if($group){

                GroupMember::where('group_id',$id)->delete();
                $group->delete();
            }
            
            return response()->json([
                'status' => true,
                'message'=>'Group Deleted Successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message'=>$th->getMessage(),
            ]);
        }
    }

    // edit group 
    public function groupEdit(Request $request,$id){
        $data=$request->all();
        // dd($data);
        $updateGroup=Group::find($id);
        try {
       
        if($updateGroup){
            $updateGroup->update([
                'name'=>$data['name'],
                'join_limit'=>$data['group_limit']
            ]);
            if($request->hasFile('image')){
                $updateGroup->clearMediaCollection('group_image');
                $updateGroup->addMedia($data['image'])->toMediaCollection('group_image');
            }
            return response()->json([
                'status' => true,
                'message'=>'Group Updated Successfully',
            ]);
        }
    } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message'=>$th->getMessage(),
            ]);
            }

    }
    // share group 

    public function GroupShare($id){
        $group=Group::find($id);
        $totalMember=GroupMember::where('group_id',$id)->count();
        $available_seet=$group->join_limit-$totalMember;
        $isOwner_member=$group->creator_id==Auth::id()?true:false;
        $isJoind_member=GroupMember::where(['group_id'=>$id,'user_id'=>Auth::id()])->count();
        $user = User::find(Auth::id());
        $count = DB::table('notifications')->where('notifiable_id', Auth::id())->where('read_at', Null)->count();


        return view('frontend.group.share',compact('group','totalMember','available_seet','isOwner_member','isJoind_member','user','count'));
    }

    public function joinGroup(Request $request){
        try {
            GroupMember::insert([
                'group_id'=>$request->id,
                'user_id'=>Auth::id(),
            ]);
            return response()->json([
                'status'=>true,
                'message'=>'Joining this group successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage(),
            ]);
        }
    }

    public function showMemberGroup(Request $request){
        $data=$request->all();
        // dd($data);
        $groupOwner=Group::find($data['group_id']);
        $groupMembers=GroupMember::where('group_id',$data['group_id'])->get();
        return response()->json([
            'status'=>true,
            'group'=>$groupOwner,
            'view'=>view('frontend.group.component.showMember',compact('groupMembers','groupOwner'))->render(),
        ]);
        // dd($groupMember);
        
    }

    // leave gorup 
    public function leaveGroup(Request $request){
        $groupId=$request->id;
        try {
            $groupMember=GroupMember::where('group_id',$groupId)->where('user_id',Auth::id())->delete();
            return response()->json([
                'status'=>true,
                'message'=>"Group Leaved Successfully",
            ]);
            
        } catch (\Throwable $th) {
           return response()->json([
               'status'=>false,
               'message'=>$th,
           ]);
        }
        
       
    }

    public function DeleteGroup(Request $request){
        $groupId=$request->id;
        try {
            $groupMembers=GroupMember::where('group_id',$groupId)->get();
            $groupChats=GroupChat::where('group_id',$groupId)->get();
            if(count($groupMembers)>0){
                foreach ($groupMembers as $key => $value) {
                    GroupMember::find($value->id)->delete();
                }
            }
            if(count($groupChats)>0){
                foreach ($groupChats as $key => $value) {
                    GroupChat::find($value->id)->delete();
                }
            }
            $group=Group::find($groupId)->delete();
                return response()->json([
                    'status'=>true,
                    'message'=>'Deleted Group Successfully',
                ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>$th,
            ]);
        }
    }
    
}
