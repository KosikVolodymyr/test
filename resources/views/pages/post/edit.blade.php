@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="leave-comment mr0"><!--leave comment-->
                    
                <h3 class="text-uppercase">Post</h3>
                @include('pages._errors')
                <br>
                {!!Form::open(['class' => 'form-horizontal contact-form', 'route' => ['post.update', $post->slug], 'method'=>'put', 'files' => true])!!}
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$post->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="category">Category</label>
                            {!!Form::select('category', $categories, $post->category ? $post->category->id : null, [
                                    'placeholder' => 'Set category',
                                    'class' => 'form-control',
                                    'id' => 'category'
                                ])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="description">Description</label>
                            <textarea class="form-control ckeditor" id="description" name="description">{{$post->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="content">Content</label>
                            <textarea class="form-control ckeditor" id="content" name="content">{{$post->content}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="file">File</label>
                            @if($post->file)
                                <span>{{$post->old_file_name}}</span>
                            @endif
                            <input type="file" class="form-control" id="file" name="upload_file" style="padding: 0px; border: none; background: none;" value="{{$post->file}}">
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn send-btn">Save</button>
                {!!Form::close()!!}
            </div>
            
        </div>
        @include('pages._categories')
    </div>
@endsection