@foreach($postItem->comments as $key=> $comment)
<div class="comment">
    <i class="fa-solid fa-user mx-2"></i> <b>{{ $comment->user->name }}</b>
    <br>
    <span class="mx-3 px-4" id="commentshow{{ $comment->id }}">
        {{ $comment->comment }} </span>

</div>