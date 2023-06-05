@if ($group->hasMedia('group_chat_image'))
    @foreach ($group->getMedia('group_chat_image') as $item)
            <img src="{{ $group->getUrl() }}" alt="">
    @endforeach
@else
    
@endif