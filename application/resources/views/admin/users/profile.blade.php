@extends('adminlte::page')

@section('title', $title)

@section('content')
	@if($errors->any())
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
	@endif
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>{{ $title }}</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => ['update_profile',$data->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}

    			<div class="form-group">
    				<label for="name">Name:</label>
    				<input type="text" name="name" class="form-control" value="{{ @$data->name }}" />
    			</div>
    			<div class="form-group">
    				<label for="email">Email:</label>
    				<input type="email" name="email" class="form-control" value="{{ @$data->email }}" />
    			</div>
    			<button class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
    			<a class="btn btn-danger" href="{{ route('home') }}"><i class="fa fa-times"></i> Cancel</a>
    		{!! Form::close() !!}
    	</div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Change Password</h2>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => ['update_password',$data->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Re-Password:</label>
                    <input type="password" name="password_confirmation" class="form-control" />
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                <a class="btn btn-danger" href="{{ route('home') }}"><i class="fa fa-times"></i> Cancel</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop