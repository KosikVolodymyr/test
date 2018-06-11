@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <article class="post">

                <div class="post-content">
                    <header class="entry-header text-center text-uppercase">
                        <h1 class="entry-title">{{$category->name}}</h1>
                    </header>
                    <div class="entry-content">
                        <p>{{$category->description}}</p>
                    </div>
                    <div class="social-share">
                        <span
                                class="social-share-title pull-left text-capitalize">By {{$category->author->name}} On {{$category->getDate()}}
                        </span>
                        @if(Auth::check())
                            @if(Auth::user()->id == $category->user_id)
                                <span class="social-share-title  pull-right text-capitalize"> 
                                    {!!Form::open(['route' => ['category.destroy', $category->slug], 'method' => 'delete'])!!}
                                    <a href="{{route('category.edit', $category->slug)}}"><i class="fa fa-pencil"></i></a> 
                                    <button type="submit" class="delete" onclick="return confirm('Delete {{$category->name}} ?')">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    {!!Form::close()!!}
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
            </article>
            <aside class="widget border pos-padding">
                <h3 class="widget-title text-uppercase text-center">Posts</h3>
                @foreach($posts as $post)
                    <article class="post">
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                <h1 class="entry-title"><a href="{{route('post.show', $post->slug)}}">{{$post->name}}</a></h1>
                            </header>
                            <div class="entry-content">
                                <p>{!!$post->description!!}</p>

                                <div class="btn-continue-reading text-center text-uppercase">
                                    <a href="{{route('post.show', $post->slug)}}" class="more-link">Continue Reading</a>
                                </div>
                            </div>
                            <div class="social-share">
                                <span class="social-share-title pull-left text-capitalize">By <a href="#">{{$post->author->name}}</a> On {{$post->getDate()}}</span>
                                @if(Auth::check())
                                    @if(Auth::user()->id == $post->user_id)
                                        <span class="social-share-title  pull-right text-capitalize"> 
                                            {!!Form::open(['route' => ['post.destroy', $post->slug], 'method' => 'delete'])!!}
                                            <a href="{{route('post.edit', $post->slug)}}"><i class="fa fa-pencil"></i></a> 
                                            <button type="submit" class="delete" onclick="return confirm('Delete {{$post->name}} ?')">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                            {!!Form::close()!!}
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
                <a href="{{route('post.category', $category->id)}}" class="btn send-btn" role="button"  style="margin-top: 25px;">Create</a>
            </aside>
            {!!$posts->links()!!}
            <div id="categoryComments" class="bottom-comment">
                <h4>{{$category->comments()->count()}} category comments</h4>
                @foreach($category->comments as $comment)
                    <div class="panel border-bottom">
                        <div class="comment-text">
                            <h6>{{$comment->author}}</h6>
                            <p class="comment-date">
                                {{$comment->getdate()}}
                            </p>
                            <p class="para">{{$comment->content}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="leave-comment">
                <h4>Leave a comment</h4>
                <div id="commentErrors"></div>
                {!!Form::open(['id' => 'categoryForm', 'class' => 'form-horizontal contact-form', 'route' => 'addCategoryComment', 'method' => 'post'])!!}
                    {!!Form::hidden('category', $category->id)!!}
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name="author" placeholder="author"
                                @if(Auth::check())
                                    value="{{Auth::user()->name}}" readonly=""
                                @endif
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea class="form-control" rows="6" name="content" placeholder="Content"></textarea>
                        </div>
                    </div>
                    {!! Form::submit('Send comment',['class'=>'btn send-btn'])!!}
                {!!Form::close()!!}
            </div>
            
        </div>
        @include('pages._categories')
    </div>
@endsection