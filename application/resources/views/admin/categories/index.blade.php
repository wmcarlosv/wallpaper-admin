@extends('adminlte::page')

@section('title', $title)

@include('flash::message')

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>{{ $title }}</h2>
    	</div>
    	<div class="panel-body">
    		<a class="btn btn-success" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> New</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
    				<th>Name</th>
    				<th>Email</th>
    				<th>Role</th>
    				<th>Status</th>
    				<th>/</th>
    			</thead>
    			<tbody>
    				@foreach($data as $d)
    					<tr>
    						<td>{{ $d->id }}</td>
    						<td>{{ $d->name }}</td>
    						<td>{{ $d->email }}</td>
    						<td>{{ $d->role }}</td>
    						<td>
    							@if($d->status == 'active')
    								<label class="label label-success">Active</label>
    							@else
    								<label class="label label-danger">Inactive</label>
    							@endif
    						</td>
    						<td>
    							<a class="btn btn-info" href="{{ route('users.edit',[$d->id]) }}"><i class="fa fa-pencil"></i> Edit</a>
    							{!! Form::open(['route' => ['users.destroy',$d->id], 'method' => 'DELETE', 'style' => 'display:inline']) !!}

    								@if($d->status == 'active')
    									<button class="btn btn-danger change-status"><i class="fa fa-times"></i> Inactivate</button>
    								@else
    									<button class="btn btn-success change-status"><i class="fa fa-check"></i> Activate</button>
    								@endif

    							{!! Form::close() !!}
    						</td>
    					</tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
    </div>
@stop
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$("table.data-table").DataTable();
		$('#flash-overlay-modal').modal();

		$("body").on('click','button.change-status', function(){
			if(!confirm('Do you want to activate or inactivate this record?')){
				return false;
			}
		});
	});
</script>
@stop