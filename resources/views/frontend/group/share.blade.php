@extends('frontend.post.main')
@section('content')
<div class="container-fluid mt-5 pt-4">
    <div class="row">
      <h3 class="bg-info text-center">Joining  To Group</h3>
    </div>
    <div class="row">
        <div class="col-md-5 mt-2 pt-3">
            <img src="{{ $group->hasMedia('group_image') ? $group->getMedia('group_image')[0]->getFullUrl():'' }}" height="400px" width="450px">
        </div>
        <div class="col-md-6 mt-2 pt-3">
            <h5>Group Name: {{ $group->name }}</h5>
            <h5>Total Number Of Members in this group :{{ $totalMember }}</h5>
            <h5>Now available seats in this group :{{ $available_seet }}</h5>
            @if($isOwner_member==true)
            <h6>Hy {{ $user->name }}, you are the owner of this group😎😎</h6>
            @elseif($isJoind_member>0)
            <h5>Hy {{ $user->name }}, You already join this group👍👍</h5>
            @elseif($available_seet==0)
            <h5>Sorry This group already full 🤦‍♀️🤦‍♀️</h5>
            @else
            <button class="join_now btn btn-dark" type="submit" data-id={{ $group->id }}>Join Now</button>
            @endif

        </div>


    </div>
</div>
<script>
    $('.join_now').click(function(){
        $(this).text('Joining...');
        var group_id=$(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "{{ route('joinGroup') }}",
            data: {id:group_id},
            success: function (response) {
                if(response.status==true){
                    $('.join_now').text('Joined Now');
                    $.notify(res.message,"success");
                }
                else{
                    $.notify(res.message,"error");

                }
            }
        });
    });
</script>

@endsection