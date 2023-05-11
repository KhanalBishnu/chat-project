<div id="comment_section {{ $comment->id }}">
    <i class="fa-solid fa-user mx-2"></i> <b>{{ $comment->user->name }}</b>
    <br>
    <span class="mx-3 px-4" id="commentshow{{ $comment->id }}">
        {{ $comment->comment }} </span>


    @if ($comment->user_id==Auth::id())
    <a type="button" class="btn btn-primary editbtn btn-sm" data-bs-toggle="modal"
        data-bs-target="#exampleModal{{ $comment->id }}"><i class="fas fa-edit"></i>
    </a>
    <a type="button" class="btn btn-primary btn-sm" onclick="deleteC"><i class="fas fa-trash"></i>
    </a>



{{-- edit  --}}
<div class="modal fade" id="exampleModal{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comment
                    Updating..

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <input type="hidden" name="comment_id" id="comment_id" value="{{ $comment->id }}"> <br>
                            <label for="comment">Comment update</label>
                            <br>
                            <input type="text" class="form-control" name="comment" id="comment_update{{ $comment->id }}"
                                value="{{ $comment->comment }}">
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="updatecomment('{{ $comment->id }}')">Update</button>
            </div>
        </div>
    </div>
</div>

@endif
</div>