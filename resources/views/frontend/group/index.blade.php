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
    <span id="error_show"></span>

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
                <tr id="group_info{{ $group->id }}">
                    <td>{{ $group->id }}</td>
                    <td>
                        <img src="{{ $group->hasMedia('group_image') ? $group->getMedia('group_image')[0]->getFullUrl():'Not Image Found' }}"
                            style="height:80px;weight:100px" class="img-fluid">
                    </td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->join_limit}}</td>
                    <td>

                        <a id="member_add{{ $key }}" data-id="{{ $group->id }}" data-key={{ $key }}
                            data-limit="{{ $group->join_limit }}" data-bs-toggle="modal"
                            data-bs-target="#memberAdd{{ $key }}"> Members
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
                                    <form id="memberAdd{{ $key }}" data-key={{ $key }}>

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
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{-- edit section  --}}

                        <a data-bs-toggle="modal" data-bs-target="#GroupEdit{{ $key }}" data-id="{{ $group->id }}"><i
                                class="fas fa-edit"></i></a>
                        <!-- Group edit Modal -->
                        <div class="modal fade" id="GroupEdit{{ $key }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Group</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form enctype="multipart/form-data" id="updateGroupForm{{ $group->id }}"
                                        data-id="{{ $group->id }}">
                                        <div class="modal-body">
                                            {{-- <input type="text" class="form-control" name="name" id="edit_group_id" value="{{ $group->id }}">
                                            --}}
                                            <label for="">Group Name</label>
                                            <input type="text" class="form-control" name="name" id="group_name"
                                                value="{{ $group->name }}">
                                            <span id="error_name" class="text-danger"> </span> <br>
                                            <label for="">Group Image</label>
                                            <img src="{{ $group->hasMedia('group_image')?$group->getMedia('group_image')[0]->getFullUrl():'' }}"
                                                alt="" width="140px" height="100px">
                                            <br> <br>
                                            <input type="file" class="form-control" name="image" id="group_image">
                                            <span id="error_image" class="text-danger"> </span> <br>
                                            <label for="">Group Limit-Friends</label>
                                            <input type="number" class="form-control" name="group_limit"
                                                id="group_limit" value="{{ $group->join_limit}}">
                                            <span id="error_limit" class="text-danger"> </span>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary update_group">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- delete section  --}}
                        <a data-bs-toggle="modal" data-bs-target="#GroupDelte{{ $key }}"><i class="fa-solid fa-trash"></i></a>

                        {{-- group  Delete modal --}}
                        <div class="modal fade" id="GroupDelte{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Group Delete</h5>
                                        <button id="close_modal_btn{{ $group->id }}" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Are you sure want to delete this group: {{ $group->name }}?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <span id="error_add_member{{ $key }}" class="text-danger"></span>
                                        <button type="submit" class="btn btn-danger">Cancle</button>
                                        <button type="submit" class="btn btn-primary" id="delete_group{{ $group->id }}"
                                            data-id={{ $group->id  }}>Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- share link  --}}

                        <a class="copy cursor-pointer" data-id={{ $group->id }} ><i class="fas fa-share"></i></a>
                    </td>
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
                                    <input type="text" class="form-control" name="name" id="group_name">
                                    <span id="error_name" class="text-danger"> </span> <br>
                                    <label for="">Group Image</label>
                                    <input type="file" class="form-control" name="image" id="group_image">
                                    <span id="error_image" class="text-danger"> </span> <br>
                                    <label for="">Group Limit-Friends</label>
                                    <input type="number" class="form-control" name="group_limit" id="group_limit">
                                    <span id="error_limit" class="text-danger"> </span>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary create_group">Create</button>
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
        e.preventDefault()
        var name=$('#group_name') ;
        var image=$('#group_image') ;
        var limit=$('#group_limit')  ;

        function validation(){
            if(name.val()=='' ) {
                $('#error_name').text('Group Name Field is Required');
                setTimeout(()=>{
                    $('#error_name').text('');
                },2000)
            }
            if(limit.val()==''){
                $('#error_limit').text('Group Limit Field is Required');
                setTimeout(()=>{
                    $('#error_limit').text('');
                },2000)
            }
            if(image.val()==''){
                $('#error_image').text('Group Image Field is Required');
                setTimeout(()=>{
                    $('#error_image').text('');
                },2000)
            }
            if(name.val()=='' || image.val()=='' || limit.val()==''){
                return false;
            }else{
                return true;
            }

        }
        if(validation()==true){
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
                        $('.create_group').text('Creating..');
                        location.reload();
                        $.notify(res.message,"success");
                    }
                    else{
                        $('#error_show').text(res.message);
                        setTimeout( ()=>{
                            $('#error_show').text('')
                        },4000);
                    }
                }
            });
        }

    });
    // show member from friend model

    $('a[id^="member_add"]').click(function(e){
        e.preventDefault();
        // var key=this.id.slice(-1);
        var key=$(this).attr('data-key');

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

    // add member
    $('form[id^="memberAdd"]').submit(function (e) {
        e.preventDefault();
        var key=$(this).attr('data-key');
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

    //  delete group
     $('button[id^="delete_group"]').click(function(){
        // var group_id=this.id.slice(-1);
        var group_id=$(this).attr('data-id');
        let url="{{ route('groupDelete',':id') }}";
        url=url.replace(':id',group_id);
        $.ajax({
            type: "get",
            url: url,
            success: function (res) {
                if(res.status){
                    $('#group_info'+group_id).remove();
                    $.notify(res.message,"success");
                    location.reload();
                }
                else{
                    $('#error_show').text(res.message);
                    setTimeout( ()=>{
                    $('#error_show').text('');

                    },4000);
                }
            }
        });
     });

    //  update group

    $('form[id^="updateGroupForm"]').submit(function(e){
        e.preventDefault();
        $('.update_group').text('Updating...');
        var id=$(this).attr('data-id');
        // alert(id)
        let url="{{ route('groupEdit',':id') }}"
        url=url.replace(':id',id);

        $.ajax({
            type: "post",
            url: url,
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,

            success: function (res) {
                $('.update_group').text('')
                $.notify(res.message,"success");
                location.reload();

            }
        });

    });

    //share link of group
    $('.copy').click(function(){
        var id=$(this).attr('data-id');
        $(this).prepend('<sup class="text-info copied"> <b>Copied Link </b></sup>');
        setTimeout(()=>{
            $('.copied').text('');
        },3000);
        var url=window.location.host+'/admin/share-group/'+id;
        // url copy
        var temp=$("<input>");
        $('body').append(temp);
        temp.val(url).select();
        document.execCommand("copy");
        temp.remove();
    });

</script>
@endsection
