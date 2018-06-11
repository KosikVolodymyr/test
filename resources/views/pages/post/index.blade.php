@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Posts</h3>
            @foreach($posts as $post)
                <article class="post">
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            @if($post->category)
                                <h6><a href="{{route('category.show', $post->category->slug)}}"> {{$post->category->name}}</a></h6>
                            @endif
                            <h1 class="entry-title"><a href="{{route('post.show', $post->slug)}}">{{$post->name}}</a></h1>
                        </header>
                        <div class="entry-content">
                            <p>{!!$post->description!!}</p>
                            <div class="btn-continue-reading text-center text-uppercase">
                                <a href="{{route('post.show', $post->slug)}}" class="more-link">Continue Reading</a>
                            </div>
                        </div>
                        <div class="social-share">
                            <span class="social-share-title pull-left text-capitalize">By {{$post->author->name}} On {{$post->getDate()}}</span>
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
            <a href="{{route('post.create')}}" class="btn send-btn" role="button"  style="margin-top: 25px;">Create</a>
        </aside>
        {{$posts->links()}}
    </div>
    @include('pages._categories')
</div>
@endsection