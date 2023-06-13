<ul class="list-group">
        @forelse ($users as $user)
        <li id="{{ $user->id }}-select_status"
            class="list-group-item list-group-item-dark cursor-pointer user_list " data-id="{{ $user->id }}" data-name="{{ $user->name }}">

            @if ($user->hasMedia('user_image'))
            <img src="{{ $user->getMedia('user_image')[0]->getFullUrl() }}" alt="" class="img-thumbnail"
                style="height:50px;width:80px">
            @else
            <img src="{{ asset('image/images.jpg')  }}" alt="" srcset="" class="img-thumbnail"
                style="height:50px;width:80px">
            @endif
            {{ $user->name }}
            <b><sup id="{{ $user->id }}-status" class="offline-status">Offline</sup></b>

        </li>

        @empty
        <h6>Not User Found!</h6>
        @endforelse
    </ul>