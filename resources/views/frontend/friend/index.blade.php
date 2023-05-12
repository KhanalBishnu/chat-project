@extends('frontend.post.main')
@section('content')
<div class="container-fluid mt-3 pt-3">
    <div class="row ">
        <div class="col-md-8 mt-3 pt-2">
            <div class="card ">
                <div class="card-header">Send Friend Requests</div>
                <div class="row">

                    @foreach($users as $key=> $user)
                    @if(!in_array($user->id,$user_id_arr))
                    @if(! in_array($user->id,$ifacceptedByUser_arr))

                    <div class="col-md-4 mt-2 pt-2">
                        {{-- @if(!$acceptedByUser['friend_id']==$user->id) --}}
                        <div class="card">
                            <a href="{{ route('friend_list.profile',$user->id) }}">
                                <img style="height:100px;"
                                    src="{{  $user->hasMedia('user_image')?$user->getMedia('user_image')[0]->getFullUrl():url('image/images.jpg')  }}"
                                    class="card-img-top" alt="{{ $user->name }}"> </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text">{{ $user->bio }}</p>
                                <div>

                                    <input type="hidden" id="addfriend{{$key}}"
                                        value="{{ !Auth::user()->friends()->where('friend_id', $user->id)->exists() ?'Add Friend':'Cancle Friend' }}">
                                    <button id="btnstatus{{ $key }}"
                                        onclick="addfriend('{{  $user->id  }}','addfriend{{$key}}','btnstatus{{ $key }}')"
                                        type="button"
                                        class="btn btn-primary">{{  ! Auth::user()->friends()->where('friend_id', $user->id)->exists() ? 'Add Friend':'Cancle Friend' }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(($loop->iteration % 3) == 0)
                </div>
                <div class="row">
                    @endif
                    @endif
                    @endif
                    @endforeach

                </div>


            </div>
        </div>
        <div class="col-md-4  mt-3 pt-2">
            <div class="card ">
                <div class="card-header"> Friend Requests</div>

                @forelse($friends as $user)

                <div class="  ">
                    <div class="card px-2">
                        <a href="{{ route('friend_list.profile',$user['users']) }}">
                            <img style="height:80px;"
                                src="{{  $user['users']->hasMedia('user_image')?$user['users']->getMedia('user_image')[0]->getFullUrl():url('image/images.jpg')  }}"
                                class="card-img-top" alt="{{ $user['users']->name }}"> </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $user['users']->name }}</h5>
                            <div>
                                <form action="{{ route('friend_request.accept',$user['users']->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Confirm Friend</button>
                                </form>
                                <a href="{{ route('friend_request.ByUsercancle',$user['users']->id)}}"
                                    class="btn btn-danger btn-sm float-end">Cancle Friend</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div style="height:300px" class="text-warning m-3 p-2">You Have No Friend Request Send By AnyOne</div>
                @endforelse
            </div>
            <div class="mt-3"><a class="btn btn-success" href="{{ route('Yourfriends') }}">You Want See Your Friends</a>
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
</script>
@endsection