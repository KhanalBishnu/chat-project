<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function create()
    {
       $modules= Permission::pluck('module')->unique()->toArray();
        
        return view('create',compact('modules'));
    }
    public function store(Request $request){
        $data=$request->validate([
            'name'=>'required|unique:roles,name',
        ]);
        try {
            
            $role=Role::create($data);
      
            $permissions=$request->permissions;
            $role->syncPermissions($permissions);
              return redirect()->route('role.index')->with('message','Role Created Successfully');
        } catch (\Throwable $th) {
            return back()->with('message',$th->getMessage());
        }
       
    }

    public function role(){
        $roles=Role::all();
        return view('roleindex', compact('roles'));
    }
    public function edit($id){
        $role=Role::find($id);
        $modules=Permission::pluck('module')->unique()->toArray();
        return view('editrole', compact('role','modules'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required|string|unique:roles,name,'.$id,
        ]);
        try {
            
            $role=Role::find($id);
            $role->update([
                'name'=>$request->name
            ]);
            $permissions=$request->permissions;
            $role->syncPermissions($permissions);
            return redirect()->route('role.index')->with('message','Update Role Successfully');


        } catch (\Throwable $th) {
            return back()->with('message',$th->getMessage());

        }

    }

    public function delete($id){
        try {
            $role=Role::find($id);
            if($role){
                $role->delete();
                return response()->json([
                    'status'=>true,
                    'message'=>'Role Deleted Successfully',
                ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'Role Not Found!, Please try again',
                ]);
            }
         
        }catch (\Throwable $th) {
            return response()->json([
                'status'=>true,
                'message'=>$th->getMessage(),
            ]);
        }
    }
}
