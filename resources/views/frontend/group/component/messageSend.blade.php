<div class="group-chat-sender" id="group_chat-{{ $groupMessage->id }}">
        <div class="div_second_sender">
                @if($groupMessage->hasMedia('group_chat_image'))
                @foreach ($groupMessage->getMedia('group_chat_image') as $groupFile)

                       <div id="file_send_group"><i class="fa fa-trash file_group_chat_delete" data-id="{{ $groupFile->id }}"></i> <a
                                href="{{  $groupFile->getFullUrl() }}" class="img-f;" target="_black"><img class="img-fluid"
                                src="{{ $groupFile->getFullUrl() }}" width="100" height="100"></a></div>
                        @endforeach
                        @endif
                        @if($groupMessage->hasMedia('group_chat_video'))
                        @foreach ($groupMessage->getMedia('group_chat_video') as $groupFile)

                          <div id="file_send_group"><i class="fa fa-trash file_group_chat_delete" data-id="{{ $groupFile->id }}"></i> <a
                                href="{{  $groupFile->getFullUrl() }}" class="img-f;" target="_black"><video
                                        width="100" height="100" autoplay>
                                        <source src="{{  $groupFile->getFullUrl() }} " type="video/mp4">
                                        Your browser does not support the video tag.
                                </video></a></div>
                                @endforeach

                                @endif
                                @if($groupMessage->hasMedia('group_chat_pdf'))
                                @foreach ($groupMessage->getMedia('group_chat_pdf') as $groupFile)
                                 <div id="file_send_group"><i class="fa fa-trash file_group_chat_delete" data-id="{{ $groupFile->id }}"></i> <a
                                        href="{{  $groupFile->getFullUrl() }}" class="img-f;" target="_black"> <embed
                                                src="{{ $groupFile->getFullUrl()  }}" width="100" height="100"></a></div>
                                        @endforeach
                                        @endif


        </div>
        <div class="group-chat-sender-file">
                @if ( $groupMessage->message!=NULL )
                        <h4> {{ $groupMessage->message }}
                                <span class="group_message_modal"><i
                                class="fa fa-trash " aria-hidden="true"
                                data-bs-toggle="modal" data-id="{{ $groupMessage->id }}"
                                data-message="{{ $groupMessage->message }}"
                                data-bs-target="#groupChatDeleteModel"></i></span>

                        </h4>
        @endif

        <p><span>{{ $groupMessage->created_at->diffForHumans() }}</span></p>
        </div>
</div>
