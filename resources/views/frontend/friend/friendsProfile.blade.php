@extends('frontend.post.main')
@section('content')
<div class="container-fluid mt-2  pt-4">

    <div class=" pt-5 text-center bg-info text-white text-center pb-4">Your Friend {{ $user->name }}`s Profile</div>

    <div id="success_message"></div>
    <div class="row p-1 ">

        <div class="col-lg-6 border border-warning profile_info">
                
            
                <img id="profile_image_display"
                    src="{{ $user->hasMedia('user_image') ?  $user->getMedia('user_image')[0]->getFullUrl() : '' }}"
                    alt="">
                <hr>
            <form action="" class="mt-1">
                <div class="info_user">
                    <input type="hidden" name="id" id="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="name" id="user_name" value="{{ $user->name }}">
                    <p class="user_profile_key">Name:  <span class="value_user_profile">{{ $user->name }}</span></p>
                
                    <p class="user_profile_key">Email:  <span class="value_user_profile">{{ $user->email }}</span></p>
                  
                </div>
                <div class="message_send_user">Lets Chat
        
                        {{-- <a id="" href="{{ route('chat') }}"> Lets Chat</a> --}}
             
                     </div>
             
            </form>
        </div>

        {{-- chat section  --}}
        <div class="chat-section_user_message col-lg-6">
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
    
</div>
</div>
<script>

     $(".message_send_user").click(function(e) {

        $("#" + receiver_id + "-select_status").removeClass("user-select");
        $("#chat-container").html("");
        var getUserId = $('#user_id').val();
        receiver_id = getUserId;

      
        $(".chat-section_user_message").toggle();
        // name of user
        var userName=$('#user_name').val();
        $('.group-chat-header').text(userName);

        loadOldChat();
        $("#" + receiver_id + "-select_status").addClass("user-select");
        $("#chat-container")
            .get(0)
            .scrollIntoView({ behavior: "smooth" });
    });

    // for message button
    $('#message').on('input',function(){
        let val=$('#message').val();
        if(val=="" || val==null){
            $('#send_message').hide();
        }else{
            $('#send_message').show();
        }

    });
     var receiver_id=$('#user_id').val();

                       
</script>


@endsection