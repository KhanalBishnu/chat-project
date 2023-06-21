@extends('frontend.post.main')
@section('content')
<div class="container-fluid mt-3 pt-3">
    <div class="all_friend_list mt-4 pt-3">All Friends And Request List<a id="your_friend_list_a" class="float-end" href="{{ route('Yourfriends') }}">Your Friends</a></div>
    
     
    <div class="row ">
        <div class="col-md-8 mt-3 pt-2 all_friend"><h5 class="header_friend_list">Send Friend Requests</h5>
            <div class="row">
                @foreach($users as $key=> $user)
                @if(!in_array($user->id,$user_id_arr))
                @if(! in_array($user->id,$ifacceptedByUser_arr))
                <div id="user_info{{ $user->id }}" class="col-md-4 card_friend_list_all" id="card_friend_list_all{{ $user->id }}">
                    
                            <a href="{{ route('friend_list.profile',$user->id) }}">
                                    <img class=" img_fluid_file" src="{{  $user->hasMedia('user_image')?$user->getMedia('user_image')[0]->getFullUrl():url('image/images.jpg')  }}" alt="Card image">
                                    </a> 
                
                            
                    <div class="card-body">
                              <h4 class="card-title_name">{{ $user->name }}</h4>
                        <div class="">
                            <input type="hidden" id="addfriend{{$key}}"
                                value="{{ !Auth::user()->friends()->where('friend_id', $user->id)->exists() ?'Add Friend':'Cancle Friend' }}">
                            <button id="btnstatus{{ $key }}"
                                onclick="addfriend('{{  $user->id  }}','addfriend{{$key}}','btnstatus{{ $key }}')"
                                type="button"
                                class="btn btn-primary">{{  ! Auth::user()->friends()->where('friend_id', $user->id)->exists() ? 'Add Friend':'Cancle Friend' }}</button>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                @endforeach
                   
            </div>
                

        </div>
        <div class="col-md-4  mt-3 pt-2">
            
                <div class="header_friend_list"> <h4 class="header_friend_list">Friend Requests</h4>

                @forelse($friends as $user)

                {{-- <div class="  "> --}}
                    <div class="card px-2 friend_request_view" id="friend_request_view{{ $user['users']->id }}">
                        <a href="{{ route('friend_list.profile',$user['users']) }}">
                            <img   src="{{  $user['users']->hasMedia('user_image')?$user['users']->getMedia('user_image')[0]->getFullUrl():url('image/images.jpg')  }}"class="img_fluid_file" alt="{{ $user['users']->name }}"> </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $user['users']->name }}</h5>
                            <div class="button_action_request">
                                <form action="{{ route('friend_request.accept',$user['users']->id) }}" method="POST" >
                                    @csrf
                                    <input type="hidden" name="id" id="user_accept_id" value="{{ $user['users']->id }}">
                                    <a onclick="acceptForm({{ $user['users']->id }})" class="btn btn-primary btn-sm">Confirm </a>
                                </form>
                                <a onclick="cancleRequest({{ $user['users']->id }})" class="btn btn-danger btn-sm float-end">Cancle </a>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>
                @empty
                <div class=" header_friend_list text-warning m-3 p-2">You Have No Friend Request Send By AnyOne</div>
                @endforelse
            </div>
         
         


        </div>
    </div>
</div>
</div>
<script>
    function addfriend(friendId,statusDiv,btnId){
       
        let status=$('#'+statusDiv).val();
        let url="{{ route('friend_request.send') }}"
        $.ajax({
            type: "post",
            url: url,
            data: {friend_id:friendId,status:status},
           
            success: function (res) {
                debugger;
                if(res.status==true){
                   $('#'+btnId).text(res.text);
                   $('#'+statusDiv).val(res.text);
                   $.notify(res.message,"success");
                }
            }
        });
    }
    function cancleRequest(id) {
        Swal.fire({
            title:"Are You Sure?",
            showCancelButton:true,
            confirmButtonText:"Yes",
            cancelButtonText:"No",
            showLoaderOnConfirm:true,

            
            allowOutsideClick:()=>! Swal.isLoading()
        }).then((result)=>{
            if(result.value){
                let url="{{ route('friend_request.ByUsercancle',':id')}}";
                url=url.replace(':id',id);
                $.ajax({
                    type: "get",
                    url: url,
                    success: function (res) {
                        if(res.status){
                            $('#friend_request_view'+id).remove();
                            $.notify(res.message,'success');
                        }else{
                            $.notify(res.message,'error');
                        }
                    }
                });
            }
        });



       
    }

    function acceptForm(id){
        let url="{{ route('friend_request.accept',':id')}}";
                url=url.replace(':id',id);
                $.ajax({
                    type: "post",
                    url: url,
                    success: function (res) {
                        if(res.status){
                            $('#friend_request_view'+id).remove();
                            $.notify(res.message,'success');
                        }else{
                            $.notify(res.message,'error');
                        }
                    }
                });
    }

</script>
@endsection