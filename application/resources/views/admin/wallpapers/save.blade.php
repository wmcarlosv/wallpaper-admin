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
    			{!! Form::open(['route' => 'wallpapers.store', 'method' => 'POST', 'files' => true, 'autocomplete' => 'off']) !!}
    		@else
    			{!! Form::open(['route' => ['wallpapers.update',$data->id], 'method' => 'PUT', 'files' => true, 'autocomplete' => 'off']) !!}
    		@endif
                <div class="form-group">
                    <label for="category_id">Category: </label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option>-</option>
                        @foreach($application->categories as $cat)
                            <option value="{{ $cat->id }}" @if($cat->id == @$data->category_id) selected = 'selected' @endif>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
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
                <div class="form-group">
                    <label for="tags">Tags:</label>
                    <input type="text" name="tags" value="{{ @$data->tags }}" id="tags" placeholder="Tag1,Tag2,Tag3" class="form-control" />
                </div>
    			<button class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
    			<a class="btn btn-danger" href="{{ route('wallpapers.index',$application->slug) }}"><i class="fa fa-times"></i> Cancel</a>
    		{!! Form::close() !!}
    	</div>
    </div>
@stop