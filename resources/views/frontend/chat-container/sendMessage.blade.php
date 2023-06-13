<div class="group-chat-sender" id="group_chat-{{ $chat->id }}">
        <div class="div_second_sender">
                @if($chat->hasMedia('chat_image'))
                 <a target="_blank" href="{{ $chat->getMedia('chat_image')[0]->getFullUrl() }}">
                        <img src="{{ $chat->getMedia('chat_image')[0]->getFullUrl() }}" width="150" height="150">
                 </a>
                @endif
                @if($chat->hasMedia('chat_pdf'))
                   <a target="_blank" href="{{ $chat->getMedia('chat_pdf')[0]->getFullUrl() }}">
                        <embed src="{{ $chat->getMedia('chat_pdf')[0]->getFullUrl() }}" width="150" height="150" >
                   </a>
                @endif
                @if($chat->hasMedia('chat_video'))
                 <a target="_blank" href="{{ $chat->getMedia('chat_video')[0]->getFullUrl() }}">
                        <video src="" autoplay  width="150" height="150">
                                <source src="{{ $chat->getMedia('chat_video')[0]->getFullUrl() }}" >  
                                        our browser does not support the video tag.
                        </video>
                  </a>
                @endif
        <h4> {{ $chat->message }} <span class= "group_message_modal"><i class="fa fa-trash " aria-hidden="true" data-id="{{ $chat->id }}"  data-bs-toggle="modal" data-bs-target="#DeleteMessageModal"></i></span> </h4>
        <p><span>{{ $chat->created_at->diffForHumans() }}</span></p>
</div>
</div>