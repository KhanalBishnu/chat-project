
<div class="group-chat-sender" id="group_chat-{{ $groupMessage->id }}">
        <div class="div_second_sender">
        @if($groupMessage->hasMedia('group_chat_image'))
                <img class="img-fluid" src="{{ $groupMessage->getMedia('group_chat_image')[0]->getFullUrl() }}" width="50px" height="60px">
                @endif
             {{-- {{ dd($src) }}   --}}
             {{-- <img src=" {{ $src }} " alt="" width="100px" height="100px"> --}}
                
        <h4> {{ $groupMessage->message }} <span class= "group_message_modal"><i class="fa fa-trash " aria-hidden="true"  data-bs-toggle="modal" data-id="{{ $groupMessage->id }}" data-message="{{ $groupMessage->message }}" data-bs-target="#groupChatDeleteModel"></i></span> 
               </h4>
        <p><span>{{ $groupMessage->created_at->diffForHumans() }}</span></p>
</div>
</div>
 