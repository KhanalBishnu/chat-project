@extends('frontend.post.main')
@section('content')
<div class="container-fluid mt-5 pt-5">
    <div class="row">
        @foreach ($yourFriends as $user)
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <div class="card" style="width:200px">
                <img class="card-img-top"
                    src="{{  $user['user']->hasMedia('user_image')?$user['user']->getMedia('user_image')[0]->getFullUrl():url('image/images.jpg')  }}"
                    alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">{{ $user['user']->name }}</h4>
                    <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
                    <a href="{{ route('friend_list.profile',$user['user']->id) }}" class="btn btn-primary">See Profile</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection