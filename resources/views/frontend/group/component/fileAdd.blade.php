<div class="group-chat-sender" id="group_chat-{{ $groupChat->id }}">
        <div class="div_second_sender">
            <img src=" {{ $groupChat->getMedia('group_chat_image')[0]->getFullUrl() }} " alt="" width="100px" height="100px">
        <h4><span class= "group_message_modal"><i class="fa fa-trash " aria-hidden="true"  data-bs-toggle="modal" data-id="{{ $groupChat->id }}" data-message="{{ $groupChat->message }}" data-bs-target="#groupChatDeleteModel"></i></span> </h4>
        <p><span>{{ $groupChat->created_at->diffForHumans() }}</span></p>
</div>
</div>