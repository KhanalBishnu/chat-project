@extends('frontend.post.main')
{{-- <style>
    .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
    }

    .active,
    .accordion:hover {
        background-color: #ccc;
    }

    .panel {
        padding: 0 18px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
    }
</style> --}}
@section('content')

<div class="container  " style="display:flex; flex-wrap: wrap;">
    <div class="col-lg-6 mt-5 pt-5">
        <button id="allpostbtn" class="btn">AllPosts </button><button id="friendpostbtn" class="float-end">Friend Posts</button>
        <div id="messagecommentupdate"></div>
    </div>
    <div class="col-lg-6 mt-5 pt-4 d-flex justify-content-end align-items-center">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Create Post
        </button>
    </div>
   
    <hr>
</div>
<div id="allpost" class="container-fluid">

    @foreach ($post as $key=>$postItem)
    <div class="row justify-content-evenly" id="post_div{{ $key }}">
        {{-- <div class="col-lg-12"> --}}
            <div id="" class="card bg-light col-lg-9 px-5 mx-5 my-2 ">
                @if(Auth::id()==$postItem->user_id)
                    <span class=""> <a class="float-end" onclick="deletePost('{{ $postItem->id }}','{{ $key }}')"><i  class="fa-solid fa-trash-can text-danger"></i> </a> </span>
                @endif
                    <div>
                    <p class="float-end">posted by:<b>{{ $postItem->user->name }}</b></p>
                    <p class="text-black"> Post name:: <span class="card-title ">{{ $postItem->name }}</span></p>
                    <small class=" float-end"> 
                        Posted on {{ $postItem->created_at->diffForHumans() }} 

                    </small>
                </div>
                <img class="img-fluid mx-3 px-4" style="height:200px;width:500px"
                    src="{{ $postItem->hasMedia('post_image') ? $postItem->getMedia('post_image')[0]->getFullUrl() : 'https://via.placeholder.com/350x200.png?text=No+Image' }}"
                    alt="Post Image" class="card-img-top">

                <div class="card-body">
                    <p class="card-text">description:<b>{{$postItem->description }}</b></p>
                </div>
                @if (Auth::id())

                <div class="like-dislike-form">
                    <span class="badge bg-primary rounded-pill " id="like_count{{ $key }}">
                        {{ $postItem->like->count() }} {{ Str::plural('like', $postItem->like->count()) }}
                    </span>
                    <form id="like-post-form">
                        <input type="hidden" id="like_unlike{{ $key }}"
                            value="{{ $postItem->likeBy(auth()->user())?'Unlike':'Like' }}">
                        <button bishnu="me" type="button" class="btn btn-outline-primary btn-sm post-like"
                            id="{{ $postItem->id }}-likeUnlike_btn"
                            onclick="likeunlike('{{ $postItem->id }}','like_count{{ $key }}','unlikeWhen{{ $key }}','like_unlike{{ $key }}')">
                            <i class="bi bi-hand-thumbs-up"></i><span
                                id="unlikeWhen{{ $key }}">{{ !$postItem->likeBy(auth()->user())?'Like':'Unlike' }}</span>
                        </button>
                    </form>

                    @endif
                </div>
                <div class="comment-section">
                    <form>
                        <div class="form-group ">
                            <button type="button" class="btn btn-sm btn-primary float-end mt-1"
                                onclick="commentpost('{{ $postItem->id }}',{{ $key }})">Comment</button>
                            <textarea name="comment" id="comment{{ $postItem->id  }}" class="form-control" required
                                placeholder="Add a comment"></textarea>
                        </div>
                    </form>
                    {{-- <small id="comment_count{{ $postItem->id }}"> {{ $postItem->comments->count() }}
                        {{ Str::plural('comment', $postItem->comments->count()) }} --}}

                        <div class="comments mx-1">

                            <div class="accordion" id="accordionExample{{ $key }}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            onclick="commentshowhide('{{ $key }}')"
                                            data-bs-target="#collapseOne{{ $key }}" aria-expanded="true"
                                            aria-controls="collapseOne{{ $key }}">
                                            <small id="comment_count{{ $postItem->id }}"> {{ $postItem->comments->count() }}
                                                {{ Str::plural('comment', $postItem->comments->count()) }}
                                            </small>
                                        </button>
                                    </h2>
                                    <div id="collapseOne{{ $key }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body" id="accordion-body{{ $key }}">
                                            @foreach($postItem->comments as $key=> $comment)
                                            <div id="comment_section{{ $comment->id }}">
                                                <i class="fa-solid fa-user mx-2"></i> <b>{{ $comment->user->name }}</b>
                                                <br>
                                                <span class="mx-3 px-4" id="commentshow{{ $comment->id }}">
                                                    {{ $comment->comment }} </span> <span> Comment on {{ $comment->created_at->diffForHumans() }}</span>

                                                    
                                                @if ($comment->user_id==Auth::id())
                                                <a type="button" class="btn btn-primary editbtn btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $comment->id }}"><i
                                                        class="fas fa-edit"></i>
                                                </a>
                                                <a type="button" class="btn btn-primary editbtn btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteTestModal{{ $comment->id }}"><i
                                                        class="fas fa-trash"></i>
                                                </a>
                                                 {{-- delete test  --}}
                                                  <div class="modal fade" id="deleteTestModal{{ $comment->id }}" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Delete Comment</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" id="delete_test_id" >
                                                                            <h4>Are You sure Delete this Data?</h4>
                                                                            <input type="text" name="comment" value="{{ $comment->comment }}" class="form-control" disabled>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancle</button>
                                                                            <button onclick="deletecomment('{{ $comment->id }}','{{ $postItem->id }}')" type="button" class="delete_test btn btn-primary" id="delete_comment">Confirm</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                    {{--end delete test  --}}

                                                <!-- Modal edit comment -->
                                                <div class="modal fade" id="exampleModal{{ $comment->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Comment
                                                                    Updating..

                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form class="form">
                                                                <div class="modal-body">
                                                                    <div class="container-fluid">
                                                                        <div class="row">

                                                                            <input type="hidden" name="comment_id"
                                                                                id="comment_id"
                                                                                value="{{ $comment->id }}"> <br>
                                                                            <label for="comment">Comment update</label>
                                                                            <br>
                                                                            <input type="text" class="form-control"
                                                                                name="comment"
                                                                                id="comment_update{{ $comment->id }}"
                                                                                value="{{ $comment->comment }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary"
                                                                    onclick="updatecomment('{{ $comment->id }}')">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @endif
                                            </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
<div id="friendpost" class="container-fluid">

    @foreach ($friendpoSt as $key=>$postItem)
    {{-- @if(in_array($postItem->user_id,$friendPost_arr)) --}}
    <div class="row justify-content-evenly" id="post_div{{ $key }}">
        {{-- <div class="col-lg-12"> --}}
            <div id="" class="card bg-light col-lg-9 px-5 mx-5 my-2 ">
                @if(Auth::id()==$postItem->user_id)
                    <span class=""> <a class="float-end" onclick="deletePost('{{ $postItem->id }}','{{ $key }}')"><i  class="fa-solid fa-trash-can text-danger"></i> </a> </span>
                @endif
                    <div>
                    <p class="float-end">posted by:<b>{{ $postItem->user->name }}</b></p>
                    <p class="text-black"> Post name:: <span class="card-title ">{{ $postItem->name }}</span></p>
                    <small class=" float-end"> 
                        Posted on {{ $postItem->created_at->diffForHumans() }} 

                    </small>
                </div>
                <img class="img-fluid mx-3 px-4" style="height:200px;width:500px"
                    src="{{ $postItem->hasMedia('post_image') ? $postItem->getMedia('post_image')[0]->getFullUrl() : 'https://via.placeholder.com/350x200.png?text=No+Image' }}"
                    alt="Post Image" class="card-img-top">

                <div class="card-body">
                    <p class="card-text">description:<b>{{$postItem->description }}</b></p>
                </div>
                @if (Auth::id())

                <div class="like-dislike-form">
                    <span class="badge bg-primary rounded-pill " id="like_count{{ $key }}">
                        {{ $postItem->like->count() }} {{ Str::plural('like', $postItem->like->count()) }}
                    </span>
                    <form id="like-post-form">
                        <input type="hidden" id="like_unlike{{ $key }}"
                            value="{{ $postItem->likeBy(auth()->user())?'Unlike':'Like' }}">
                        <button bishnu="me" type="button" class="btn btn-outline-primary btn-sm post-like"
                            id="{{ $postItem->id }}-likeUnlike_btn"
                            onclick="likeunlike('{{ $postItem->id }}','like_count{{ $key }}','unlikeWhen{{ $key }}','like_unlike{{ $key }}')">
                            <i class="bi bi-hand-thumbs-up"></i><span
                                id="unlikeWhen{{ $key }}">{{ !$postItem->likeBy(auth()->user())?'Like':'Unlike' }}</span>
                        </button>
                    </form>

                    @endif
                </div>
                <div class="comment-section">
                    <form>
                        <div class="form-group ">
                            <button type="button" class="btn btn-sm btn-primary float-end mt-1"
                                onclick="commentpost('{{ $postItem->id }}',{{ $key }})">Comment</button>
                            <textarea name="comment" id="comment{{ $postItem->id  }}" class="form-control" required
                                placeholder="Add a comment"></textarea>
                        </div>
                    </form>
                    {{-- <small id="comment_count{{ $postItem->id }}"> {{ $postItem->comments->count() }}
                        {{ Str::plural('comment', $postItem->comments->count()) }} --}}

                        <div class="comments mx-1">

                            <div class="accordion" id="accordionExample{{ $key }}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            onclick="commentshowhide('{{ $key }}')"
                                            data-bs-target="#collapseOne{{ $key }}" aria-expanded="true"
                                            aria-controls="collapseOne{{ $key }}">
                                            <small id="comment_count{{ $postItem->id }}"> {{ $postItem->comments->count() }}
                                                {{ Str::plural('comment', $postItem->comments->count()) }}
                                            </small>
                                        </button>
                                    </h2>
                                    <div id="collapseOne{{ $key }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body" id="accordion-body{{ $key }}">
                                            @foreach($postItem->comments as $key=> $comment)
                                            <div id="comment_section{{ $comment->id }}">
                                                <i class="fa-solid fa-user mx-2"></i> <b>{{ $comment->user->name }}</b>
                                                <br>
                                                <span class="mx-3 px-4" id="commentshow{{ $comment->id }}">
                                                    {{ $comment->comment }} </span> <span> Comment on {{ $comment->created_at->diffForHumans() }}</span>

                                                    
                                                @if ($comment->user_id==Auth::id())
                                                <a type="button" class="btn btn-primary editbtn btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $comment->id }}"><i
                                                        class="fas fa-edit"></i>
                                                </a>
                                                <a type="button" class="btn btn-primary editbtn btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteTestModal{{ $comment->id }}"><i
                                                        class="fas fa-trash"></i>
                                                </a>
                                                 {{-- delete test  --}}
                                                  <div class="modal fade" id="deleteTestModal{{ $comment->id }}" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Delete Comment</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" id="delete_test_id" >
                                                                            <h4>Are You sure Delete this Data?</h4>
                                                                            <input type="text" name="comment" value="{{ $comment->comment }}" class="form-control" disabled>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancle</button>
                                                                            <button onclick="deletecomment('{{ $comment->id }}','{{ $postItem->id }}')" type="button" class="delete_test btn btn-primary" id="delete_comment">Confirm</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                    {{--end delete test  --}}

                                                <!-- Modal edit comment -->
                                                <div class="modal fade" id="exampleModal{{ $comment->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Comment
                                                                    Updating..

                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form class="form">
                                                                <div class="modal-body">
                                                                    <div class="container-fluid">
                                                                        <div class="row">

                                                                            <input type="hidden" name="comment_id"
                                                                                id="comment_id"
                                                                                value="{{ $comment->id }}"> <br>
                                                                            <label for="comment">Comment update</label>
                                                                            <br>
                                                                            <input type="text" class="form-control"
                                                                                name="comment"
                                                                                id="comment_update{{ $comment->id }}"
                                                                                value="{{ $comment->comment }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary"
                                                                    onclick="updatecomment('{{ $comment->id }}')">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @endif
                                            </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        {{-- @endif --}}
        @endforeach
    </div>


{{-- post modal  --}}
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Post</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-10">
                                <label for="title">Post Title</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <label for="description">Description</label>
                                <textarea name="description" id="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    required>{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <label for="category_id">Choose Category</label>
                                <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option value="">Choose Your Option</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <label for="image">Image Upload</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror" required>
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-primary btn-sm mt-3">Create Post</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
{{-- post modal end  --}}

<script>
 $('#friendpost').hide();
    $('#allpostbtn').click(function(){
        $('#friendpost').hide();
        $('#allpost').show();
    });
    $('#friendpostbtn').click(function(){
        $('#allpost').hide();
        $('#friendpost').show();
    });
    $(document).ready(function(){
    

 });
       function likeunlike(postId,countDivId,buttonText,statusDiv){
          let status=$('#'+statusDiv).val();
          var url="{{ route('likeStore',':id') }}";
          url=url.replace(':id',postId);
          $.ajax({
              type: "post",
              url: url,
              data: {id:postId,status:status},
              success: function (res) {

                if(res.success==true){
                    $('#'+countDivId).text(res.count+' Like');
                    $('#'+buttonText).text(res.text);
                    $('#'+statusDiv).val(res.text);
                   
                }
              }
          });
       }

       function commentpost(postId,key){
        var comment=$('#comment'+postId).val();
        var url="{{ route('post.comment',':id') }}";
          url=url.replace(':id',postId);
          

          $.ajax({
              type: "post",
              url: url,
              data:{id:postId,comment:comment},
              success: function (res) {
                  $('#comment_count'+postId).text(res.count==1?res.count +' comment':res.count +' comments');

              
                  $('#accordion-body'+key).append(res.view);
                  $.notify("Comment Added", "success");

              }
          });
       }
       function commentShow(postId){
        var url="{{ route('comment.show',':id') }}";
          url=url.replace(':id',postId);
        $.ajax({
            type: "get",
            url: url,
            data: {id:postId},
            success: function (res) {
                if(res.status==true){
                var comments = res.data;
                console.log(comments);

                var commentHtml = '';

                $.each(comments, function(index, comment) {
                    commentHtml += `<small><b>` + comment.user_id +`</b>`+ comment.comment + `</small>`;
                    commentHtml +=` <p>`+ comment.comment + `</p><span>` + comment.user_id +`</span>`;
                });
                
                $('#comments'+postId).html(commentHtml);

                 }
            }
        });
       }

         function commentshowhide(key){
             $('#collapseOne'+key).toggle();
         }   
       
         function updatecomment(id){
        
            // var comment_id=$('#comment_id').val();
            var comment=$('#comment_update'+id).val();
             let url="{{ route('comment_update',':id') }}";
            url=url.replace(':id',id);

            $.ajax({
                type: "put",
                url: url,
                data: {id:id,comment:comment},
                success: function (res) {
      
                    $('#exampleModal'+id).hide();
                    $('.modal-backdrop').hide();
                    $('#comment_update'+id).val(res.data.comment);
                     $('#commentshow'+id).text(res.data.comment);
                   
                    
                }
            });
         }   
         function deletecomment(id,postId){
            let url="{{ route('comment_delete',':id') }}";
            url=url.replace(':id',id);
            // debugger;
            $.ajax({
                type: "get",
                url:url,
                data: { id:id ,post_id:postId},
                success: function (res) {
                    debugger;
                    if(res.status==true){
                        $('#deleteTestModal'+id).modal('hide');
                        $('.modal-backdrop').hide();
                        $('#comment_count'+postId).text(res.count==1?res.count +'comment':res.count +' comments');
                    debugger;

                        $('#comment_section'+id).remove();
                        $.notify("Comment deleted", "success");
                    }
                }
            });
         }
    function deletePost(post_id,key){
        var checkstr =  confirm('are you sure you want to delete this post?');
        if(checkstr == true){
        let url="{{ route('deletepost',':id') }}";
        url=url.replace(':id',post_id);

        $.ajax({
            type: "get",
            url: url,
            data: {id:post_id},
            success: function (res) {
                if(res.status==true){
                    $('#post_div'+key).remove();
                    $.notify("Post deleted successfully", "success");
                }
            }
        });
    }else{
        return false;
        }
    }
      
</script>
@endsection