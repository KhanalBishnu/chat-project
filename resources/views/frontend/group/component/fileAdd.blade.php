<div class="group-chat-sender" id="group_chat-{{ $groupChat->id }}">
        <div class="div_second_sender">
            <img src=" {{ $path }} " alt="" width="100px" height="100px">
        <h4><span class= "group_message_modal">
            <i id="fa-trash_image" class="fa fa-trash " aria-hidden="true"  data-bs-toggle="modal" data-id="{{ $src->id }}" ></i></span> </h4>
        <p><span>{{ $groupChat->created_at->diffForHumans() }}</span></p>
</div>
</div>