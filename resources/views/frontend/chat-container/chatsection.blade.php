@foreach ($chats as $chat)
    @if (Auth::id()!=$chat->sender_id)
    <div class="group-chat-sender" id="{{ $chat->id }}-chat">
            <div class="div_second_sender">
        <h4 ><small>{{ $chat->message }}</small>  <span class= "group_message_modal"><i class="fa fa-trash " aria-hidden="true" data-id="{{ $chat->id }}"  data-bs-toggle="modal" data-bs-target="#DeleteMessageModal"></i></span>
            
            {{-- <span class= "group_update_message_modal"><i class="fa fa-edit edit_group_chat" aria-hidden="true"  data-bs-toggle="modal" data-id="{{ $chat->id }}" data-message="{{ $chat->message }} " data-bs-target="#groupChatEditModel"></i></span> --}}
        </h4>
        <p><span class="date_chat-user">{{$chat->created_at->diffForHumans()}}</span></p>
      
        </div>
        </div>
    @else
    <div class="group-chat-receiver" id="{{ $chat->id }}-chat">
      
        <h4><small>{{ $chat->message }}</small>   </h4>
       
        <div class="image-section">
            
            <img src="{{ $chat->user->hasMedia('user_image') ? $chat->user->getMedia('user_image')[0]->getFullUrl(): asset('image/images.jpg')  }}" alt="" width="25px" height="25px">
            <span class="group-chat-user-name">{{ $chat->user->name }}</span> <span class="date_chat-user">{{$chat->created_at->diffForHumans()}}</span>
        </div>
    </div>
    @endif

@endforeach