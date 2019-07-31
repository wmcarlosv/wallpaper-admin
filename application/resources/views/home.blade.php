@extends('adminlte::page')

@section('title', $title)

@include('flash::message')

@section('content')
	@if(Auth::user()->role == 'administrator')
	    <div class="row">
	    	<div class="col-md-4">
	    		<div class="info-box">
				  <!-- Apply any bg-* class to to the icon to color it -->
				  <span class="info-box-icon bg-blue"><i class="fa fa-gamepad"></i></span>
				  <div class="info-box-content">
				    <span class="info-box-text">Applications</span>
				    <span class="info-box-number">{{ $applications->count() }}</span>
				  </div>
				  <!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
	    	</div>

	    	<div class="col-md-4">
	    		<div class="info-box">
				  <!-- Apply any bg-* class to to the icon to color it -->
				  <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
				  <div class="info-box-content">
				    <span class="info-box-text">Users</span>
				    <span class="info-box-number">{{ $users->count() }}</span>
				  </div>
				  <!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
	    	</div>

	    	<div class="col-md-4">
	    		<div class="info-box">
				  <!-- Apply any bg-* class to to the icon to color it -->
				  <span class="info-box-icon bg-red"><i class="fa fa-image"></i></span>
				  <div class="info-box-content">
				    <span class="info-box-text">Wallpapers</span>
				    <span class="info-box-number">{{ $wallpapers->count() }}</span>
				  </div>
				  <!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
	    	</div>
	    </div>

	    <div class="row">
	    	<div class="col-md-12">
	    		<div class="panel panel-default">
	    			<div class="panel-heading">
	    				<h2>Last 100 Wallpapers Uploads</h2>
	    			</div>
	    			<div class="panel-body">
	    				<table class="table table-bordered table-striped">
	    					<thead>
	    						<th>ID</th>
	    						<th>Application</th>
	    						<th>Thumbnail</th>
	    						<th>-</th>
	    					</thead>
	    					<tbody>
	    						@foreach($wallpapers as $w)
		    						<tr>
		    							<td>{{ $w->id }}</td>
		    							<td>{{ $w->application->name }}</td>
		    							<td>
		    								<img src="{{ asset('application/storage/app/'.$w->thumbnail) }}" width="60" height="100" class="img-thumbnail" />
		    							</td>
		    							<td>
		    								<a class="btn btn-info" href="{{ asset('application/storage/app/'.$w->wallpaper_url) }}" target="_blank"><i class="fa fa-eye"></i> View</a>
		    							</td>
		    						</tr>
		    					@endforeach
	    					</tbody>
	    				</table>
	    			</div>
	    		</div>
	    	</div>
	    </div>
    @else
    @section('content_header')
	    <h1>Applications</h1>
	@stop
    <div class="row">
    	@foreach(Auth::user()->applications as $app)
	    	<div class="col-md-6">
		    	 <a href="{{ route('application_dashboard',$app->slug) }}">
		          <div class="box box-widget widget-user-2">
		            <div class="widget-user-header bg-yellow">
		              <div class="widget-user-image">
		                <img class="img-circle" src="{{ asset('application/storage/app/'.$app->icon) }}" alt="User Avatar">
		              </div>
		              <h3 class="widget-user-username">{{ $app->name }}</h3>
		              <h5 class="widget-user-desc">Version: {{ $app->current_version }}</h5>
		            </div>
		            <div class="box-footer no-padding">
		              <ul class="nav nav-stacked">
		                <li><a href="#">Categories <span class="pull-right badge bg-blue">{{ $app->categories->count() }}</span></a></li>
		                <li><a href="#">Wallpapers <span class="pull-right badge bg-red">{{ $app->wallpapers->count() }}</span></a></li>
		              </ul>
		            </div>
		          </div>
		      	</a>
		    </div>
	    @endforeach
    </div>
    @endif
@stop
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$('#flash-overlay-modal').modal();
	});
</script>
@stop