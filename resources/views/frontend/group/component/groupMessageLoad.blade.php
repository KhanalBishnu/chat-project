<style>
.send_img{
    height: 150px;
    width: 150px;
}
</style>
@foreach ($groupChats as $chat)
    @if (Auth::id()==$chat->sender_id)
    <div class="group-chat-sender" id="group_chat-{{ $chat->id }}">
            <div class="div_second_sender">
        <h4>{{ $chat->message }}  <span class= "group_message_modal"><i class="fa fa-trash " aria-hidden="true"  data-bs-toggle="modal" data-id="{{ $chat->id }}" data-message="{{ $chat->message }} " data-bs-target="#groupChatDeleteModel"></i></span>
        </h4>
        @if($chat->hasMedia('group_chat_image'))
             <a  href="{{  $chat->getMedia('group_chat_image')[0]->getFullUrl() }}" class="img-f;" target="_black">
       
                  <img class="send_img" src="{{ $chat->getMedia('group_chat_image')[0]->getFullUrl() }}" alt="">
             </a>
    
        @endif
        @if($chat->hasMedia('group_chat_video'))
            <a  href="{{  $chat->getMedia('group_chat_video')[0]->getFullUrl() }}" class="img-f;" target="_black">
                <video width="200" height="200" autoplay>
                    <source src="{{  $chat->getMedia('group_chat_video')[0]->getFullUrl() }} " type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </a>
    
         @endif
        @if($chat->hasMedia('group_chat_pdf'))
            <a  href="{{  $chat->getMedia('group_chat_pdf')[0]->getFullUrl() }}" class="img-f;" target="_black">
                
                    <embed src= "{{ $chat->getMedia('group_chat_pdf')[0]->getFullUrl()  }}" width= "400" height= "300">
            </a>
    
         @endif
        <p><span class="date_chat-user">{{$chat->created_at->diffForHumans()}}</span></p>

        </div>
        </div>
    @else
    <div class="group-chat-receiver" id="group_chat-{{ $chat->id }}">

        <h4>{{ $chat->message }}   </h4>
        @if($chat->hasMedia('group_chat_image'))
        <a href=" {{  $chat->getMedia('group_chat_image')[0]->getFullUrl() }}" target="_blank">
                <img class="send_img" src="{{ $chat->getMedia('group_chat_image')[0]->getFullUrl() }}" alt="">
        </a>
        @endif
        @if($chat->hasMedia('group_chat_video'))
        <a  href="{{  $chat->getMedia('group_chat_video')[0]->getFullUrl() }}" class="img-f;" target="_black">
            <video width="200" height="200" autoplay>
                <source src="{{  $chat->getMedia('group_chat_video')[0]->getFullUrl() }} " type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </a>

     @endif
    @if($chat->hasMedia('group_chat_pdf'))
        <a  href="{{ $chat->getMedia('group_chat_pdf')[0]->getFullUrl() }}"  class="img-f;">
            
                <embed src= "{{ $chat->getMedia('group_chat_pdf')[0]->getFullUrl()  }}" width= "400" height= "300">
        </a>

     @endif
        <div class="image-section">
            <img src="{{ $chat->userInfo->hasMedia('user_image') ? $chat->userInfo->getMedia('user_image')[0]->getFullUrl(): asset('image/images.jpg')  }}" alt="" width="20px" height="20px">
           
            <span class="group-chat-user-name">{{ $chat->userInfo->name }}</span> <span class="date_chat-user">{{$chat->created_at->diffForHumans()}}</span>
        </div>
    </div>
    @endif
 {{-- pdf shhow view  --}}

     {{-- <div class="modal fade" id="ImageViewModelOfGroup{{ $chat->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    @if($chat->hasMedia('group_chat_pdf'))
                    <embed src= "{{ $chat->getMedia('group_chat_pdf')[0]->getFullUrl()  }}" width= "400" height= "300">
    @endif

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>  --}}
@endforeach
