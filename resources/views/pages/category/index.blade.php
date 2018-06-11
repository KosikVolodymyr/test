@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <aside class="widget border pos-padding">
                <h3 class="widget-title text-uppercase text-center">Categories</h3>
                <ul>
                    <li>
                        <span>({{$postsCount}})</span>
                        <a href="{{route('post.index')}}">All posts</a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <span>({{$category->posts()->count()}})</span>
                            <a href="{{route('category.show', $category->slug)}}">{{$category->name}}</a>
                            @if(Auth::check())
                                @if(Auth::user()->id == $category->user_id)
                                    <span class="post-count pull-right"> 
                                        {!!Form::open(['route' => ['category.destroy', $category->slug], 'method' => 'delete'])!!}
                                        <a href="{{route('category.edit', $category->slug)}}"><i class="fa fa-pencil"></i></a> 
                                        <button type="submit" class="delete" onclick="return confirm('Delete {{$category->name}} ?')">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                        {!!Form::close()!!}
                                    </span>
                                @endif
                            @endif
                        </li>
                    @endforeach
                    @if($nullableCategory > 0)
                        <li>
                            <span>({{$nullableCategory}})</span>
                            <a href="{{route('post.nonecategory')}}">Posts without category</a>
                        </li>
                    @endif
                </ul>
                <a href="{{route('category.create')}}" class="btn send-btn" role="button"  style="margin-top: 25px;">Create</a>
            </aside>
        </div>
    </div>
@endsection
