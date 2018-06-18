@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="leave-comment mr0"><!--leave comment--> 
                <h3 class="text-uppercase">Post</h3>
                @include('pages._errors')
                <br>
                {!!Form::open(['class' => 'form-horizontal contact-form', 'route' => 'post.store', 'files' => true])!!}
                    <div class="form-group">
                        <div class="col-md-12">
                            {!!Form::label('name', 'Name')!!}
                            {!!Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            {!!Form::label('category', 'Category')!!}
                            {!!Form::select('category', $categories, $category, [
                                'placeholder' => 'Set category', 
                                'class' => 'form-control',
                                'id' => 'category'
                            ])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!!Form::label('description', 'Description')!!}
                            {!!Form::textarea('description', old('description'), ['id' => 'description', 'class' => 'form-control ckeditor'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!!Form::label('content', 'Content')!!}
                            {!!Form::textarea('content', old('content'), ['id' => 'content', 'class' => 'form-control ckeditor'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!!Form::label('file', 'File')!!}
                            {!!Form::file('upload_file', ['id' => 'file', 'class' => 'form-control'])!!}
                        </div>
                    </div>
                    {!! Form::submit('Create',['class'=>'btn send-btn'])!!}
                {!!Form::close()!!}
            </div>
        </div>
        @include('pages._categories')
    </div>
@endsection