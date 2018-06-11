@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="leave-comment">
            
            <h4>Login</h4>
            @if(session('status'))
                <div class="alert alert-danger">
                    {{session('status')}}
                </div>
            @endif
            @include('pages._errors')
            {!!Form::open(['class' => 'form-horizontal contact-form', 'route' => 'login', 'method' => 'post'])!!}
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                {!! Form::submit('Login',['class'=>'btn send-btn'])!!}
            {!!Form::close()!!}
        </div>
    </div>
    @include('pages._categories')
</div>
@endsection


