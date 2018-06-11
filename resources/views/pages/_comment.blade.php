<div class="panel border-bottom">
    <div class="comment-text">
        <h6>{{$comment->author}}</h6>
        <p class="comment-date">
            {{$comment->getdate()}}
        </p>
        <p class="para">{{$comment->content}}</p>
    </div>
</div>

