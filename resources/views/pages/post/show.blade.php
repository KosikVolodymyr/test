@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <article class="post">
                <div class="post-content">
                    <header class="entry-header text-center text-uppercase">
                        @if ($post->category)
                            <h6><a href="{{route('category.show', $post->category->slug)}}"> {{$post->category->name}}</a></h6>
                        @endif
                        <h1 class="entry-title">{{$post->name}}</h1>
                    </header>
                    <div class="entry-content">
                        {!!$post->content!!}
                    </div>
                    @if ($post->file)
                        <div class="entry-content">
                            <a href="{{route('post.download', $post->slug)}}"><i class="fa fa-download"></i> <span>{{$post->old_file_name}}</span></a>
                        </div>
                    @endif
                    <div class="social-share">
                        <span class="social-share-title pull-left text-capitalize">By {{$post->author->name}} On {{$post->getDate()}}</span>
                        @if (Auth::check())
                            @if (Auth::user()->id == $post->user_id)
                                <span class="social-share-title  pull-right text-capitalize"> 
                                    {!!Form::open(['route' => ['post.destroy', $post->slug], 'method' => 'delete'])!!}
                                        <a href="{{route('post.edit', $post->slug)}}"><i class="fa fa-pencil"></i></a> 
                                        {!!Form::button('<i class="fa fa-remove"></i>', [
                                            'type' => 'submit',
                                            'class' => 'delete',
                                            'onclick' => 'return confirm("Delete '.$post->name.' ?")'
                                        ])!!}
                                    {!!Form::close()!!}
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
            </article>
            
            <div id="postComments" class="bottom-comment">
                <h4>{{$post->comments()->count()}} post comments</h4>
                @foreach ($post->comments as $comment)
                    <div class="panel border-bottom">
                        <div class="comment-text">
                            <h6>{{$comment->author}}</h6>
                            <p class="comment-date">
                                {{$comment->getDate()}}
                            </p>
                            <p class="para">{{$comment->content}}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="leave-comment">
                <h4>Leave a comment</h4>
                <div id="commentErrors"></div>
                {!!Form::open(['id' => 'postForm', 'class' => 'form-horizontal contact-form', 'route' => 'addComment', 'method' => 'post'])!!}
                    {!!Form::hidden('post', $post->id)!!}
                    <div class="form-group">
                        <div class="col-md-6">    
                            @if (Auth::check())
                                {!!Form::text('author', Auth::user()->name, [
                                    'id' => 'name', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'Author', 
                                    'readonly' => ''
                                ])!!}
                            @else
                                {!!Form::text('author', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Author'])!!}
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!!Form::textarea('content', null, ['class' => 'form-control', 'rows' => '6', 'placeholder' => 'Content'])!!}
                        </div>
                    </div>
                    {!!Form::submit('Send comment',['class'=>'btn send-btn'])!!}
                {!!Form::close()!!}
            </div>
        </div>
        @include('pages._categories')
    </div>
@endsection