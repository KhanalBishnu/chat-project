@if($groupOwner->creator_id)

    This Group Owner: <br>
    <a href="{{ route('friend_list.profile',$groupOwner->creator_id) }}">

        <img src="{{ $groupOwner->user->hasMedia('user_image') ? $groupOwner->user->getMedia('user_image')[0]->getFullUrl():asset('image/images.jpg') }}" alt="" style="height:50px;width:40px"  >
    </a>
    {{ $groupOwner->user->name }}
    @endif
<br>
<hr>
    Members: 
    <br>


@foreach ($groupMembers as $groupMember)
    
<tr>
   
        <td>
            <a href="{{ route('friend_list.profile',$groupMember->user_id) }}">
            <img src="{{ $groupMember->user->hasMedia('user_image') ? $groupMember->user->getMedia('user_image')[0]->getFullUrl():'' }}" alt="" style="height:50px;width:40px"  >
        </a>
        </td>
        <td>
       {{ $groupMember->user->name }}
       <br>
        </td>                 
</tr>
@endforeach