@extends('frontend.post.main')
@section('content')
<div class="container-fluid mt-3 pt-3">
    <div class="row ">
        <div class="col-md-8 mt-3 pt-2">
            <div class="card ">
                <div class="card-header">Send Friend Requests</div>
                <div class="row">

                    @foreach($users as $user)
                    @if(!in_array($user->id,$user_id_arr))
                    @if(! in_array($user->id,$ifacceptedByUser_arr))

                    <div class="col-md-4 mt-2 pt-2">
                            {{-- @if(!$acceptedByUser['friend_id']==$user->id) --}}
                        <div class="card">
                            <img style="height:100px;"
                                src="{{  $user->hasMedia('user_image')?$user->getMedia('user_image')[0]->getFullUrl():url('image/images.jpg')  }}"
                                class="card-img-top" alt="{{ $user->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text">{{ $user->bio }}</p>
                                @if(!Auth::user()->friends()->where('friend_id', $user->id)->exists())
                                <form action="{{ route('friend_request.send') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-primary">Add Friend</button>
                                </form>
                                @else
                                {{-- @if(!$acceptedByUser) --}}
                                <a href="{{ route('send_request.cancleBySender',$user->id) }}" class="btn btn-danger">Cancle Friend</a>
                                {{-- @else --}}
                                

                                @endif
                                {{-- @endif --}}

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

                <div class=" my-2  ">
                    <div class="card px-2">
                        <img style="height:80px;"
                            src="{{  $user['users']->hasMedia('user_image')?$user['users']->getMedia('user_image')[0]->getFullUrl():url('image/images.jpg')  }}"
                            class="card-img-top" alt="{{ $user['users']->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user['users']->name }}</h5>

                            <form action="{{ route('friend_request.accept',$user['users']->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Confirm Friend</button>
                            </form>
                            <a href="{{ route('friend_request.ByUsercancle',$user['users']->id)}}" class="btn btn-danger float-end">Cancle Friend</a>
                        </div>
                    </div>
                </div>
                @empty
                <div style="height:300px">You Have No Friend Request Send By AnyOne</div>
                @endforelse
            </div>


        </div>
    </div>
</div>
</div>
@endsection