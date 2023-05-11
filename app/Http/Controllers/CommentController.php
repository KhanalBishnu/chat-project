<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function commentPost(Request $request ,$id){
        $comments=Comment::where('post_id',$id)->get();
       $post=Post::find($id);
       if($post){
          $comment= Comment::create([
                'user_id'=>Auth::id(),
                'post_id'=>$id,
                'comment'=>$request->comment,
           ]);
           $user=auth()->user()->name;
           $count_commet=Comment::where('post_id',$id)->count();
          return response()->json([
              'status'=>true,
              'message'=>'Comment Added successfully',
              'data'=>$comment,
              'count'=>$count_commet,
              'view'=>view('frontend.post.component.commentSection',compact('comment'))->render()
             
          ]);

       }
    }
    public function commentEdit($id){
        $user_comment=Comment::where('user_id',Auth::id())->where('id',$id)->first();
        if($user_comment){
           return response()->json([
                'userComment'=>$user_comment,
           ]);
        }
    }

    public function commentShow($id){
       $comments=Comment::where('post_id',$id)->latest()->get();
       if($comments){
           return response()->json([
                'status'=>true,
                'data'=>$comments
           ]);
       }
    }
    public function comment_update(Request $request ,$id){
        $data=$request->all();
        $comment=Comment::find($id);
        if($comment){
            $comment->update($data);
            return response()->json([
                'status'=>true,
                'data'=>$comment,
                'message'=>'Comment updated '
            ]);
        }
    }

    public function comment_delete(Request $request,$id){
        $comment=Comment::find($id);
       

      try {
          if($comment){
              $comment->delete();
              $count=Comment::where('post_id',$request->post_id)->count();
              return response()->json([
                'status'=>true,
                'count'=>$count,
                'message'=>'comment deleeted successfully'
              ]);
          }
          
      } catch (\Throwable $th) {
        return response()->json([
            'status'=>false,
            'message'=>'something went wrong!',
        ]);
      }
    }

}
