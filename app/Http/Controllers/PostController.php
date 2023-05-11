<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\PostRepositoryInterface;
use App\Models\FriendShip;

class PostController extends Controller
{
    protected $post;
    public function __construct(PostRepositoryInterface $post) {
        $this->post= $post;
    }

    public function index(){
       $post= $this->post->all();
       $friendPost=FriendShip::where('user_id',Auth::id())->where('status','accepted')->get();
       dd($friendPost);
    //    $postByFriend=
       return view('admin.post.index',compact('post'));
    }
    public function create(){
        $category=Category::all();
        return view('admin.post.create',compact('category'));
    }
    public function store(Request $request){
        $data=$request->validate([
            'name'=>'required|string',
            'description'=>'string',
            'category_id'=>'required',
            'image'=>'mimes:png,jpg',
            'user_id'=>'nullable'
            
        ]);
        $this->post->store($data);
        Alert::success('success','Post Added Successfully');
        return redirect()->back();
    }
    public function edit($id){
     $post= $this->post->edit($id);
     $category=Category::all();
     return view('admin.post.edit',compact('post','category'));
    }
    public function update(Request $request,$id){

    }
    public function delete($id){

        $post=Post::find($id);
        if($post){
            $post->delete();
            return response()->json([
                'status'=>true,
                'message'=>'deleted',
            ]);
        }

    }
}
