@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="leave-comment">
            <h4>Login</h4>
            @if (session('status'))
                <div class="alert alert-danger">
                    {{session('status')}}
                </div>
            @endif
            @include('pages._errors')
            {!!Form::open(['class' => 'form-horizontal contact-form', 'route' => 'login', 'method' => 'post'])!!}
                <div class="form-group">
                    <div class="col-md-12">
                        {!!Form::text('email', old('email'), ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email'])!!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {!!Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password'])!!}
                    </div>
                </div>
                {!! Form::submit('Login',['class'=>'btn send-btn'])!!}
            {!!Form::close()!!}
        </div>
    </div>
    @include('pages._categories')
</div>
@endsection


