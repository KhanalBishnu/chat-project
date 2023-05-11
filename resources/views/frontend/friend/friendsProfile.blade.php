@extends('frontend.post.main')
@section('content')
<div class="container-fluid mt-5  pt-4">

    <div class=" pt-5 text-center bg-info text-white text-center pb-4">Your Friend {{ $user->name }}`s Profile</div>

    <div id="success_message"></div>
    <div class="row justify-content-evenly pt-5 mt-2">

        <div class="col-lg-6 border border-warning">
            <div class="text-white bg-primary  text-center mt-2"> <b>Information</b> </div>
            <hr>
            <form action="" class="mt-3">
                <label class="form-label" for="name">Name</label>
                <input type="text" name="" id="" class="form-control" value="{{ $user->name }}" disabled>
                <label class="form-label" for="name">Roll No</label>
                <input type="text" name="" id="" class="form-control" value="{{ $user->id }}" disabled>
                <label class="form-label" for="name">Email</label>
                <input type="text" name="" id="" class="form-control" value="{{ $user->email }}" disabled>
             
            </form>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-3  ">
            <h3 class="text-white bg-warning text-center">{{ $user->name }} Profile </h3>
            <div id="profile_image_display">
                <img class="img-fluid"
                    src="{{ $user->hasMedia('user_image') ?  $user->getMedia('user_image')[0]->getFullUrl() : '' }}"
                    alt="" style="height:200px;weight:150px">
            </div>
        </div>
    </div>
</div>
</div>



@endsection