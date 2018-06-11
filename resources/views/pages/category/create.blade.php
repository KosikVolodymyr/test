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
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn send-btn">Create</button>
                {!!Form::close()!!}
            </div>
            
        </div>
        @include('pages._categories')
    </div>
@endsection