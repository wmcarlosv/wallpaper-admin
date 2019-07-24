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
    			{!! Form::open(['route' => 'wallpapers.store', 'method' => 'POST', 'files' => true]) !!}
    		@else
    			{!! Form::open(['route' => ['wallpapers.update',$data->id], 'method' => 'PUT', 'files' => true]) !!}
    		@endif
                <div class="form-group">
                    <label for="wallpaper_url">Wallpaper:</label>
                    @if(!empty(@$data->thumbnail))
                        <br />
                        <img src="{{ asset('application/storage/app/'.@$data->thumbnail) }}" class="img-thumbnail" width="100" height="100" />
                        <br />
                        <br />
                    @endif
                    <input type="file" name="wallpaper_url" class="form-control"/>
                    <input type="hidden" name="application_id" value="{{ $application->id }}">
                </div>
    			<button class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
    			<a class="btn btn-danger" href="{{ route('wallpapers.index',$application->slug) }}"><i class="fa fa-times"></i> Cancel</a>
    		{!! Form::close() !!}
    	</div>
    </div>
@stop