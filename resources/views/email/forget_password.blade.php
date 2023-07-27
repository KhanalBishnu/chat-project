@component('mail::message')
**Dear {{$user->name}},**


@component('mail::button', ['url' => $url])
Click here to reset your password
@endcomponent
<br><br>
Thank you.
@endcomponent