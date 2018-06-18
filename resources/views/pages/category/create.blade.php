@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="leave-comment mr0"><!--leave comment-->     
                <h3 class="text-uppercase">Category</h3>
                @include('pages._errors')
                <br>
                {!!Form::open(['class' => 'form-horizontal contact-form', 'route' => 'category.store'])!!}
                    <div class="form-group">
                        <div class="col-md-12">
                            {!!Form::label('name', 'Name')!!}
                            {!!Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!!Form::label('description', 'Description')!!}
                            {!!Form::textarea('description', old('description'), ['id' => 'description', 'class' => 'form-control'])!!}
                        </div>
                    </div>
                    {!! Form::submit('Create',['class'=>'btn send-btn'])!!}
                {!!Form::close()!!}
            </div>
        </div>
        @include('pages._categories')
    </div>
@endsection