<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public  function index(){
        $user=User::find(Auth::id());
        $count = DB::table('notifications')->where('notifiable_id', Auth::id())->where('read_at', Null)->count();
        $groups=Group::where('creator_id',Auth::id())->get();

        return view('frontend.group.index',compact('user','count','groups'));
    }

    public function store(Request $request){
        try {
            // dd($request->all());
            $data=$request->all();
            $group=Group::create([
                'creator_id'=>Auth::id(),
                'name'=>$request->name,
                'join_limit'=>$request->group_limit
            ]);
            if($request->image){
                $group->addMedia($request->image)->toMediaCollection('group_image');
            }

            return response()->json([
                'status'=>true,
                'message'=>$data['name'].'Group Created Successfully',
                'data'=>$group
            ]);

        } catch (\Throwable $th) {
           
        }
    }

    public function getMember(){
        $user = User::find(Auth::id());

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
            'status'=>true,
            'data'=>$members
        ]);
    }
}
