@extends('frontend.post.main')
{{-- @extends('layouts.app') --}}
@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        {{-- <div id="testing_div"></div> --}}
        <div class="container-fluid mt-5 pt-3">

        </div>
        @if(count($groups)>0 || count($other_groups)>0)

                <div class="col-lg-3 mt-3">
                    <ul class="list-group">
                        @foreach ($groups as $group)
                        <li id="{{ $group->id }}-select_status" class="list-group-item list-group-item-dark cursor-pointer group_list " data-id="{{ $group->id }}" data-name="  {{ $group->name }}">

                            @if ($group->hasMedia('group_image'))
                                <img src="{{ $group->getMedia('group_image')[0]->getFullUrl() }}" alt="" class="img-thumbnail" style="height:50px;width:80px">
                            @else
                            <img src="{{ asset('image/images.jpg')  }}" alt="" srcset="" class="img-thumbnail" style="height:50px;width:80px">
                            @endif
                                    {{ $group->name }}
                        </li>

                        @endforeach
                        @foreach ($other_groups as $group)
                        <li id="{{ $group->id }}-select_status" class="list-group-item list-group-item-dark cursor-pointer group_list " data-id="{{ $group->id }}" data-name="  {{ $group->name }}">

                        @if ($group->hasMedia('group_image'))
                            <img src="{{ $group->getMedia('group_image')[0]->getFullUrl() }}" alt="" class="img-thumbnail" style="height:50px;width:80px">
                        @else
                        <img src="{{ asset('image/images.jpg')  }}" alt="" srcset="" class="img-thumbnail" style="height:50px;width:80px">
                        @endif
                                {{ $group->name }}
                                

                            </li>

                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-9 mt-4">
                    <h1 class="start-head">Click For Start Chat</h1>
                    <div class="group-chat-section " >
                        <div class="group-chat-header">
                            Header
                        </div>
                         <div id="group-chat-container">
                             <span id="group_name"></span>


                            {{-- chat here for sender and receiver  --}}

                            </div>
                            <div id="message-send-section">

                                <form id="group-chat-form">
                                    <div class="input-group">
                                      <input type="text" name="message" id="message" required placeholder="Enter message" class="form-control">
                                      <button type="submit" id="send_message" class="btn btn-send"> <i class="fas fa-paper-plane"></i></button>
                                    </div>
                                  </form>

                            </div>

                    </div>
                </div>
        @else
            <div class="container-fluid text-center col-lg-12">
                <h4>User Not Found!</h4>
            </div>
        @endif
    </div>
</div>

<!-- delete groupchat Modal -->
<div class="modal fade" id="groupChatDeleteModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Message</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  >
                <div class="modal-body">
                    <h5>Are you sure want to delete this message?</h5>
                    <input id="groupChat_message">
                    <input type="hidden" id="groupChat_message_id">
                </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <a id="groupChat_delete_form" class="btn btn-primary">Confirm</a>
            </div>
        </form>
          </div>
        </div>
      </div>

@endsection
