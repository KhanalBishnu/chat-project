@if($groupOwner->creator_id)
<div id="owner_profile">
    <h5 id="text">This Group Owner: </h5><br>
    <span id="owner_name">{{ $groupOwner->user->name }}</span>
    <a href="{{ route('friend_list.profile',$groupOwner->creator_id) }}">
        <img id="img-view-member" src="{{ $groupOwner->user->hasMedia('user_image') ? $groupOwner->user->getMedia('user_image')[0]->getFullUrl():asset('image/images.jpg') }}" alt="">
    </a>
</div>
   
    @endif
<br>
<hr>
    Members: 
    <br>


@foreach ($groupMembers as $groupMember)
    
<tr>
   
        <td>
            <a href="{{ route('friend_list.profile',$groupMember->user_id) }}">
            <img src="{{ $groupMember->user->hasMedia('user_image') ? $groupMember->user->getMedia('user_image')[0]->getFullUrl():'' }}" alt="">
        </a>
        </td>
        <td>
       {{ $groupMember->user->name }}
       <br>
        </td>                 
</tr>
@endforeach