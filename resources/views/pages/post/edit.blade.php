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
                            {!!Form::label('name', 'Name')!!}
                            {!!Form::text('name', $post->name, ['id' => 'name', 'class' => 'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            {!!Form::label('category', 'Category')!!}
                            {!!Form::select('category', $categories, $post->category ? $post->category->id : null, [
                                'placeholder' => 'Set category',
                                'class' => 'form-control',
                                'id' => 'category'
                            ])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!!Form::label('description', 'Description')!!}
                            {!!Form::textarea('description', $post->description, ['id' => 'description', 'class' => 'form-control ckeditor'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!!Form::label('content', 'Content')!!}
                            {!!Form::textarea('content', $post->content, ['id' => 'content', 'class' => 'form-control ckeditor'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!!Form::label('file', 'File')!!}
                            @if ($post->file)
                                <span>{{$post->old_file_name}}</span>
                            @endif
                            {!!Form::file('upload_file', ['id' => 'file', 'class' => 'form-control'])!!}
                        </div>
                    </div>
                    {!! Form::submit('Save',['class'=>'btn send-btn'])!!}
                {!!Form::close()!!}
            </div>
        </div>
        @include('pages._categories')
    </div>
@endsection