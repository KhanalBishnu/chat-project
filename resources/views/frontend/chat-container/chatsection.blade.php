@foreach ($chats as $chat)
@if (Auth::id()==$chat->sender_id)
<div class="group-chat-sender" id="{{ $chat->id }}-chat">
    <div class="div_second_sender">
        <h4><small>{{ $chat->message }}</small> <span class="group_message_modal"><i class="fa fa-trash "
                    aria-hidden="true" data-id="{{ $chat->id }}" data-bs-toggle="modal"
                    data-bs-target="#DeleteMessageModal"></i></span>

            {{-- <span class= "group_update_message_modal"><i class="fa fa-edit edit_group_chat" aria-hidden="true"  data-bs-toggle="modal" data-id="{{ $chat->id }}"
            data-message="{{ $chat->message }} " data-bs-target="#groupChatEditModel"></i></span> --}}
        </h4>
        @if($chat->hasMedia('chat_image'))
        <a href="{{  $chat->getMedia('chat_image')[0]->getFullUrl() }}" class="img-f;" target="_black">

            <img class="send_img" src="{{ $chat->getMedia('chat_image')[0]->getFullUrl() }}" width="150" height="150">
        </a>

        @endif
        @if($chat->hasMedia('chat_video'))
        <a href="{{  $chat->getMedia('chat_video')[0]->getFullUrl() }}" class="img-f;" target="_black">
            <video width="150" height="150" autoplay>
                <source src="{{  $chat->getMedia('chat_video')[0]->getFullUrl() }} " type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </a>

        @endif
        @if($chat->hasMedia('chat_pdf'))
        <a href="{{  $chat->getMedia('chat_pdf')[0]->getFullUrl() }}" class="img-f;" target="_black">

            <embed src="{{ $chat->getMedia('chat_pdf')[0]->getFullUrl()  }}" width="150" height="150">
        </a>

        @endif
        <p><span class="date_chat-user">{{$chat->created_at->diffForHumans()}}</span></p>

    </div>
</div>

@else
<div class="group-chat-receiver" id="{{ $chat->id }}-chat">

    <h4><small>{{ $chat->message }}</small> </h4>
    @if($chat->hasMedia('chat_image'))
    <a href="{{  $chat->getMedia('chat_image')[0]->getFullUrl() }}" class="img-f;" target="_black">

        <img class="send_img" src="{{ $chat->getMedia('chat_image')[0]->getFullUrl() }}" width="150" height="150">
    </a>

    @endif
    @if($chat->hasMedia('chat_video'))
    <a href="{{  $chat->getMedia('chat_video')[0]->getFullUrl() }}" class="img-f;" target="_black">
        <video width="150" height="150" autoplay>
            <source src="{{  $chat->getMedia('chat_video')[0]->getFullUrl() }} " type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </a>

    @endif
    @if($chat->hasMedia('chat_pdf'))
    <a href="{{  $chat->getMedia('chat_pdf')[0]->getFullUrl() }}" class="img-f;" target="_black">

        <embed src="{{ $chat->getMedia('chat_pdf')[0]->getFullUrl()  }}" width="150" height="150">
    </a>

    @endif

    <div class="image-section">

        <img src="{{ $user->hasMedia('user_image') ? $user->getMedia('user_image')[0]->getFullUrl(): asset('image/images.jpg')  }}"
            alt="" width="25px" height="25px">
        <span class="group-chat-user-name">{{ $user->name }}</span> <span
            class="date_chat-user">{{$chat->created_at->diffForHumans()}}</span>
    </div>
</div>
@endif

@endforeach