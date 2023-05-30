<div class="group-chat-sender" id="group_chat-{{ $chat->id }}">
        <div class="div_second_sender">
        <h4> {{ $chat->message }} <span class= "group_message_modal"><i class="fa fa-trash " aria-hidden="true" data-id="{{ $chat->id }}"  data-bs-toggle="modal" data-bs-target="#DeleteMessageModal"></i></span> </h4>
        <p><span>{{ $chat->created_at->diffForHumans() }}</span></p>
</div>
</div>