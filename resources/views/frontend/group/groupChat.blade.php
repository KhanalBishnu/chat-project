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
                        <li id="{{ $group->id }}-select_status" class="list-group-item list-group-item-dark cursor-pointer user_list " data-id="{{ $group->id }}">

                        @if ($group->hasMedia('group_image'))
                            <img src="{{ $group->getMedia('group_image')[0]->getFullUrl() }}" alt="" class="img-thumbnail" style="height:50px;width:80px">
                        @else
                        <img src="{{ asset('image/images.jpg')  }}" alt="" srcset="" class="img-thumbnail" style="height:50px;width:80px">
                        @endif
                                {{ $group->name }}
                                <b><sup id="{{ $group->id }}-status" class="offline-status">Offline</sup></b>

                            </li>

                        @endforeach
                        @foreach ($other_groups as $group)
                        <li id="{{ $group->id }}-select_status" class="list-group-item list-group-item-dark cursor-pointer user_list " data-id="{{ $group->id }}">

                        @if ($group->hasMedia('group_image'))
                            <img src="{{ $group->getMedia('group_image')[0]->getFullUrl() }}" alt="" class="img-thumbnail" style="height:50px;width:80px">
                        @else
                        <img src="{{ asset('image/images.jpg')  }}" alt="" srcset="" class="img-thumbnail" style="height:50px;width:80px">
                        @endif
                                {{ $group->name }}
                                <b><sup id="{{ $group->id }}-status" class="offline-status">Offline</sup></b>

                            </li>

                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-9 mt-4">
                    <h1 class="start-head">Click For Start Chat</h1>
                    <div class="chat-section " >
                         <div id="chat-container">


                            {{-- chat here for sender and receiver  --}}

                            </div>
                            <form action="" id="chat-form">
                                <input type="text" name="message" id="message" required placeholder="Enter message" >
                                <input type="submit" value="Send" class="btn btn-primary btn-lg float-end mx-5 ">
                            </form>

                    </div>
                </div>
        @else
            <div class="container-fluid text-center col-lg-12">
                <h4>User Not Found!</h4>
            </div>
        @endif
    </div>
</div>



@endsection
