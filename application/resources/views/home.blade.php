@extends('adminlte::page')

@section('title', $title)

@include('flash::message')

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')
	@if(Auth::user()->role == 'administrator')
	    <div class="row">
	    	<div class="col-md-4">
	    		<div class="info-box">
				  <!-- Apply any bg-* class to to the icon to color it -->
				  <span class="info-box-icon bg-blue"><i class="fa fa-gamepad"></i></span>
				  <div class="info-box-content">
				    <span class="info-box-text">Applications</span>
				    <span class="info-box-number">0</span>
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
				    <span class="info-box-number">0</span>
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
				    <span class="info-box-number">0</span>
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
	    						<th>View</th>
	    					</thead>
	    					<tbody></tbody>
	    				</table>
	    			</div>
	    		</div>
	    	</div>
	    </div>
    @else

    @endif
@stop
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$('#flash-overlay-modal').modal();
	});
</script>
@stop