@extends('frontend.post.main')
{{-- @extends('layouts.app') --}}
@section('content')
<div class="container-fluid mt-5">
    <div class="row mt-5">
       
        <div class="container-fluid">

        </div>
        @if(count($users)>0)
        <div class="searchUser mt-4">
            <i class="fas fa-search"  data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
        </div>

        <div class="col-lg-3 mt-3">
            <ul class="list-group">
                @foreach ($users as $user)
                <li id="{{ $user->id }}-select_status"
                    class="list-group-item list-group-item-dark cursor-pointer user_list " data-id="{{ $user->id }}" data-name="{{ $user->name }}">

                    @if ($user->hasMedia('user_image'))
                    <img src="{{ $user->getMedia('user_image')[0]->getFullUrl() }}" alt="" class="img-thumbnail"
                        style="height:50px;width:80px">
                    @else
                    <img src="{{ asset('image/images.jpg')  }}" alt="" srcset="" class="img-thumbnail"
                        style="height:50px;width:80px">
                    @endif
                    {{ $user->name }}
                    <b><sup id="{{ $user->id }}-status" class="offline-status">Offline</sup></b>

                </li>

                @endforeach
            </ul>
        </div>
        

        <div class="col-lg-9 mt-4">
            <h1 class="start-head">Click For Start Chat</h1>
            <div class="chat-section ">
                    <div class="group-chat-header">
                            Header
                        </div>
                <div id="chat-container">


                    {{-- chat here for sender and receiver  --}}

                </div>
                <div id="fileDivShow"></div>
               
                <form action="" id="chat-form">
                    <div class="input-group">
                            <label for="image" class="upload-label">
                                    <i class="fas fa-image"></i>
                                </label>
                                <input type="file" name="file" id="image" class="upload-input">
                        <input type="text" name="message" id="message"  placeholder="Enter message"
                            class="form-control">
                        <button style="display:none" type="submit" id="send_message" class="btn btn-primary"> <i
                                class="fas fa-paper-plane"></i></button>
                </form>
                

            </div>
        </div>
        @else
        <div class="container-fluid text-center col-lg-12">
            <h4>User Not Found!</h4>
        </div>
        @endif
       
    </div>
</div>
{{-- search modal  --}}
<!-- Button trigger modal -->

      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Search User</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <form action="" id="search_form">
                        <h5>Search<input type="text" name="search" id="search_users" oninput="searchUser()"></h5>
                    </form>
                    <div class="user_show"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

{{-- delete modal  --}}
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="DeleteMessageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message Deleting..</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="delete-message-form">
                <div class="modal-body">
                    <input type="hidden" name="id" id="delete_message_id">
                    <p>Are You sure Want delete beleow message?</p>
                    <p><b id="chat-message-name"></b></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger delete_message">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // token setup
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
    //
        
    // search user
        function searchUser() {
            var name=$('#search_users').val();
            $.ajax({
                type: "get",
                url: "{{ route('searchUserChat') }}",
                data: {search:name},
            
                success: function (res) {
                    if(res.status){
                        $('.user_show').html(res.view);
                        $(".user_list").click(function(e) {
                            e.preventDefault();
                            $('#exampleModal').modal('hide');
                            $(".modal-backdrop").hide();
                            $('#search_users').val('');
                            $('.user_show').html('');

                            $("#" + receiver_id + "-select_status").removeClass("user-select");
                            $("#chat-container").html("");
                            var getUserId = $(this).attr("data-id");
                            receiver_id = getUserId;

                            $(".start-head").hide();
                            $(".user_profile").hide();
                            $(".chat-section").show();
                            // name of user 
                            var userName=$(this).attr('data-name');
                            $('.group-chat-header').text(userName);

                            loadOldChat();
                            $("#" + receiver_id + "-select_status").addClass("user-select");
                            $("#chat-container")
                                .get(0)
                                .scrollIntoView({ behavior: "smooth" });
                        });
                    }
                }
            });
        }
    //
</script>
@endsection