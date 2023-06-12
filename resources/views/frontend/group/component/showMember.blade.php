@if($groupOwner->creator_id)

    This Group Owner: <br>
    <img src="{{ $groupOwner->user->hasMedia('user_image') ? $groupOwner->user->getMedia('user_image')[0]->getFullUrl():asset('image/images.jpg') }}" alt="" style="height:50px;width:40px"  >
    {{ $groupOwner->user->name }}
    @endif
<br>
<hr>
    Members: 
    <br>


@foreach ($groupMembers as $groupMember)
    
<tr>
   
        <td>
            <img src="{{ $groupMember->user->hasMedia('user_image') ? $groupMember->user->getMedia('user_image')[0]->getFullUrl():'' }}" alt="" style="height:50px;width:40px"  >
           
        </td>
        <td>
       {{ $groupMember->user->name }}
        </td>                 
</tr>
@endforeach