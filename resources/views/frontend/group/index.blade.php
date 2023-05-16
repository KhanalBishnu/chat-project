@extends('frontend.post.main')
@section('content')
<div class="container mt-5 pt-5">
    <div>
        <h2 class="text-info text-center"> Groups</h2>
    </div>
    <hr>
</div>
<div class="create-groups mx-4">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-end my-3 py-2" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        Create Group
    </button>

    <div class="show-group">
        @if(count($groups)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Group Image</th>
                    <th>Group Name</th>
                    <th>Group Limit Member</th>
                    <th>Add Members</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $key=>$group )
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>
                        <img src="{{ $group->hasMedia('group_image') ? $group->getMedia('group_image')[0]->getFullUrl():'Not Image Found' }}"
                            style="height:80px;weight:100px" class="img-fluid">
                    </td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->join_limit}}</td>
                    <td>

                        <a id="member_add{{ $key }}" data-id="{{ $group->id }}" data-limit="{{ $group->join_limit }}"
                            data-bs-toggle="modal" data-bs-target="#memberAdd{{ $key }}"> Members
                        </a>
                        {{-- group member add modal --}}
                        <div class="modal fade" id="memberAdd{{ $key }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Member Add In Group</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="memberAdd{{ $key }}">

                                        <div class="modal-body">
                                            <input type="hidden" name="group_id" id="" value="{{ $group->id }}">
                                            <input type="hidden" name="limit" id="" value="{{ $group->join_limit}}">
                                            
                                           
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Select </th>
                                                        <th>Name </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="member_show{{ $key }}">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <span id="error_add_member{{ $key }}" class="text-danger"></span>
                                            <button  type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td>Action</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
       
        <h2>No Groups Found!</h2>
        @endif
    </div>


    <!-- Group Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" enctype="multipart/form-data" id="createGroupForm">
                    <div class="modal-body">
                        <label for="">Group Name</label>
                        <input type="text" class="form-control" name="name">
                        <label for="">Group Image</label>
                        <input type="file" class="form-control" name="image">
                        <label for="">Group Limit-Friends</label>
                        <input type="number" class="form-control" name="group_limit">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<script>
    //   group create 
    $('#createGroupForm').submit(function (e) {
            e.preventDefault();
            let url="{{route('groupCreate')}}";

            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success: function (res) {
                    if(res.status==true){
                        location.reload();
                        $.notify(res.message,"success");
                    
                    }
                }
            });
    });
   $('a[id^="member_add"]').click(function(e){
        e.preventDefault();
        var key=this.id.slice(-1);
            var group_id=$(this).attr('data-id');
            var group_limit=$(this).attr('data-limit');
            $('#member_show'+key).html('');
            $.ajax({
                type: "get",
                url: "{{ route('getmember') }}",
                data:{group_id:group_id},
                success: function (res) {
                    if(res.status==true){
                       
                         $('#member_show'+key).append(res.view);
                        
                    }
                }
            });
    });

    $('form[id^="memberAdd"]').submit(function (e) { 
        e.preventDefault();
        var key=this.id.slice(-1);
        let formData=$(this).serialize();
        $.ajax({
            type: "post",
            url: "{{ route('groupMember') }}",
            data: formData,
            success: function (res) {
                if(res.status){
                    // $('#memberAdd'+key).modal('hide');
                    $.notify(res.message,"success");
                    location.reload();
                }
                else{
                    $('#error_add_member'+key).text(res.message);
                    setTimeout(function(){
                        $('#error_add_member'+key).text('');
                          }, 3000);
                }
            }
        });
     });

</script>
@endsection