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
                    @if ($chat->message!=null)
        <h4>{{ $chat->message }}  <span class= "group_message_modal"><i class="fa fa-trash " aria-hidden="true"  data-bs-toggle="modal" data-id="{{ $chat->id }}" data-message="{{ $chat->message }} " data-bs-target="#groupChatDeleteModel"></i></span>
        </h4>
        @endif
        @if($chat->hasMedia('group_chat_image'))
        @foreach ($chat->getMedia('group_chat_image') as $groupFile)
        <div class="file-store">
            <i class="fa fa-trash file_group_chat_delete"  data-id="{{ $groupFile->id }}"></i>   <a  href="{{  $groupFile->getFullUrl() }}" class="img-f;" target="_black">

                  <img class="send_img" src="{{ $groupFile->getFullUrl() }}" alt="">
             </a>
        </div>
            @endforeach
        @endif
        @if($chat->hasMedia('group_chat_video'))
        @foreach ($chat->getMedia('group_chat_video') as $groupFile)
        <div class="file-store">
                  <i class="fa fa-trash file_group_chat_delete"  data-id="{{ $groupFile->id }}"></i>  <a  href="{{  $groupFile->getFullUrl() }}" class="img-f;" target="_black">
                        <video width="100" height="100" autoplay>
                            <source src="{{   $groupFile->getFullUrl() }} " type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </a>
                </div>
                @endforeach
         @endif
        @if($chat->hasMedia('group_chat_pdf'))
        @foreach ($chat->getMedia('group_chat_pdf') as $groupFile)
        <div class="file-store">
            <i class="fa fa-trash file_group_chat_delete"  data-id="{{ $groupFile->id }}"></i>   <a  href="{{  $groupFile->getFullUrl() }}" class="img-f;" target="_black">

                        <embed src= "{{ $groupFile->getFullUrl()  }}" width= "100" height= "100">
                </a>
            </div>
            @endforeach
         @endif
        <p><span class="date_chat-user">{{$chat->created_at->diffForHumans()}}</span></p>

        </div>
        </div>
    @else
    <div class="group-chat-receiver" id="group_chat-{{ $chat->id }}">
            @if ($chat->message!=null)
        <h4>{{ $chat->message }}   </h4>
        @endif
        @if($chat->hasMedia('group_chat_image'))
        @foreach ($chat->getMedia('group_chat_image') as $groupFile)
        <div class="file-store">
                <i class="fa fa-trash file_group_chat_delete"  data-id="{{ $groupFile->id }}"></i>   <a  href="{{  $groupFile->getFullUrl() }}" class="img-f;" target="_black">

                      <img class="send_img" src="{{ $groupFile->getFullUrl() }}" alt="">
                 </a>
                </div>
                @endforeach
        @endif
        @if($chat->hasMedia('group_chat_video'))
        @foreach ($chat->getMedia('group_chat_video') as $groupFile)
        <div class="file-store">
                <i class="fa fa-trash file_group_chat_delete"  data-id="{{ $groupFile->id }}"></i>    <a  href="{{  $groupFile->getFullUrl() }}" class="img-f;" target="_black">
                        <video width="200" height="200" autoplay>
                            <source src="{{   $groupFile->getFullUrl() }} " type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </a>
                </div>
            @endforeach

     @endif
    @if($chat->hasMedia('group_chat_pdf'))
    @foreach ($chat->getMedia('group_chat_pdf') as $groupFile)
    <div class="file-store">
              <i class="fa fa-trash file_group_chat_delete"  data-id="{{ $groupFile->id }}"></i>   <a  href="{{  $groupFile->getFullUrl() }}" class="img-f;" target="_black">

                        <embed src= "{{ $groupFile->getFullUrl()  }}" width= "100" height= "100">
                </a>
            </div>
            @endforeach

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
