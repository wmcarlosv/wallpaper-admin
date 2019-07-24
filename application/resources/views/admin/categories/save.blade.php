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
    		@if($action == 'create')
    			{!! Form::open(['route' => 'categories.store', 'method' => 'POST', 'files' => true]) !!}
    		@else
    			{!! Form::open(['route' => ['categories.update',$data->id], 'method' => 'PUT', 'files' => true]) !!}
    		@endif
    			<div class="form-group">
    				<label for="name">Name:</label>
    				<input type="text" name="name" class="form-control" value="{{ @$data->name }}" />
    			</div>
                <div class="form-group">
                    <label for="cover">Cover:</label>
                    @if(!empty(@$data->cover))
                        <br />
                        <img src="{{ asset('application/storage/app/'.@$data->cover) }}" class="img-thumbnail" width="100" height="100" />
                        <br />
                        <br />
                    @endif
                    <input type="file" name="cover" class="form-control"/>
                    <input type="hidden" name="application_id" value="{{ $application->id }}">
                </div>
    			<button class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
    			<a class="btn btn-danger" href="{{ route('categories.index',$application->slug) }}"><i class="fa fa-times"></i> Cancel</a>
    		{!! Form::close() !!}
    	</div>
    </div>
@stop