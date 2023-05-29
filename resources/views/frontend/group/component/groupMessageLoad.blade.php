@foreach ($groupChats as $chat)
    @if (Auth::id()==$chat->sender_id)
    <div class="group-chat-sender" id="group_chat-{{ $chat->id }}">
            <div class="div_second_sender">
        <h4>{{ $chat->message }}  <span class= "group_message_modal"><i class="fa fa-trash " aria-hidden="true"  data-bs-toggle="modal" data-id="{{ $chat->id }}" data-message="{{ $chat->message }} " data-bs-target="#groupChatDeleteModel"></i></span>
        </h4>
        <p><span class="date_chat-user">{{$chat->created_at->diffForHumans()}}</span></p>
      
        </div>
        </div>
    @else
    <div class="group-chat-receiver" id="group_chat-{{ $chat->id }}">
      
        <h4>{{ $chat->message }}   </h4>
       
        <div class="image-section">
            <img src="{{ $chat->userInfo->hasMedia('user_image') ? $chat->userInfo->getMedia('user_image')[0]->getFullUrl(): asset('image/images.jpg')  }}" alt="" width="25px" height="25px">
            <span class="group-chat-user-name">{{ $chat->userInfo->name }}</span> <span class="date_chat-user">{{$chat->created_at->diffForHumans()}}</span>
        </div>
    </div>
    @endif

@endforeach