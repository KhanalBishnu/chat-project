<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\GroupMember;

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
        } catch (\Throwable $th) { }
    }

    public function getMember(Request $request)
    {
        $data=$request->all();
        $user = User::find(Auth::id());

        
        // $checkedGroupMember=GroupMember::where('group_id',$data['group_id'])->get('user_id')->toArray();
        $checkedGroupMember=GroupMember::where('group_id',$data['group_id'])->pluck('user_id')->toArray();
        dd($checkedGroupMember);

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
        return response()->json([
            'status' => true,
            'data' => $members,
            'groupMembers'=>$checkedGroupMember
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
}
