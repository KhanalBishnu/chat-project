@extends('frontend.post.main')
@section('content')
<div class="container-fluid mt-5 pt-5">
    <div class="row">
        @forelse ($yourFriends as $user)
            <div id="user_info{{ $user->id }}" class="col-md-3 card_friend_list">
                {{-- <div class="card">
                    <img class="card-img-top"
                        src="{{  $user->hasMedia('user_image')?$user->getMedia('user_image')[0]->getFullUrl():url('image/images.jpg')  }}"
                        alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title">{{ $user->name }}</h4>
                        <p class="card-text">Some example text some example text. John Doe is an architect and engineer
                        </p>
                        <div class="row">
                            <div>
                                <a href="{{ route('friend_list.profile',$user->id) }}"
                                    class="btn btn-primary btn-sm">See
                                    Profile</a>
                                 <a  class="btn btn-danger btn-sm float-end" href="{{ route('friend_list.delete',$user->id) }}">Delete
                                Friend</a>
                                <a id="delete_friend" class="btn btn-danger btn-sm float-end"
                                    onclick="deletebtn('{{ $user->id }}')">Delete Friend</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                        <img class=" img-fluid_file" src="{{  $user->hasMedia('user_image')?$user->getMedia('user_image')[0]->getFullUrl():url('image/images.jpg')  }}" alt="Card image" height="100" width="100">
                        <div class="card-body">
                          <h4 class="card-title_name">{{ $user->name }}</h4>
                          {{-- <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p> --}}
                    {{-- <div class="card_friend_list" > --}}

                          <a href="{{ route('friend_list.profile',$user->id) }}"
                                class="btn btn-primary btn-sm">See
                                Profile</a>
                        
                            <a id="delete_friend" class="btn btn-danger btn-sm float-end"
                                onclick="deletebtn('{{ $user->id }}','{{ $user->name }}')">Unfriend</a>
                        </div>
                    {{-- </div> --}}
            </div>
            @empty
            <div class="text-center text-warning">You Have No Friend</div>
            <div class="text-center text-primary"><a class="btn btn-primary" href="{{ route('friends') }}">If You Want
                    Make
                    Friend Then Cick Here</a>
            </div>

      
        @endforelse
    </div>
    
</div>




<script>
    // function deletebtn(id){
        //     let url="{{ route('friend_list.delete',':id') }}";
        //     url=url.replace(':id',id);

        
        //     $.ajax({
        //         type: "get",
        //         url: url,
        //         data: {id:id},
            
        //         success: function (res) {
        //         $('#user_info'+id).remove();
        //         $.notify("delete Friend","success");
        //         }
        //     });

    // }
  function deletebtn(id,name){
    swal.fire({
        title: "Are you sure want to Unfriend "+name+" ?",
        // text: "But you will still be able to retrieve this file.",
        type: "info",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
    }).then(function (result) {
        if (result.value) {
            let url="{{ route('friend_list.delete',':id') }}";
            url=url.replace(':id',id);
                $.ajax({
                    type: "get",
                    url: url,
                    data: {id:id},
                    success: function (res) {
                        $('#user_info'+id).remove();
                        $.notify("delete Friend","success");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error deleting!", "Please try again", "error");
                    }
                });
        }
    });
  }


  
</script>
@endsection