@extends('adminlte::page')

@section('title', $title)

@include('flash::message')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
              <li class="list-group-item"><center>Menu</center></li>
              <li class="list-group-item"><a href="{{ route('categories.index',$application->slug) }}"><i class="fa fa-list"></i> Categories</a></li>
              <li class="list-group-item"><a href="{{ route('wallpapers.index',$application->slug) }}"><i class="fa fa-image"></i> Wallpapers</a></li>
            </ul>
        </div> 
        <div class="col-md-9">
            <a class="btn btn-success" href="{{ route('wallpapers.create',$application->slug) }}"><i class="fa fa-plus"></i> New</a>
            <br />
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>{{ $title }}</h2>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped data-table">
                        <thead>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Thumbnail</th>
                            <th>Tags</th>
                            <th>Status</th>
                            <th>/</th>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->category->name }}</td>
                                    <td>
                                        @if(!empty($d->thumbnail))
                                            <img src="{{ asset('application/storage/app/'.$d->thumbnail) }}" class="img-thumbnail" width="50" height="50">
                                        @else
                                            <label class="label label-warning">Not Image</label>
                                        @endif    
                                    </td>
                                    <td>{{ $d->tags }}</td>
                                    <td>
                                        @if($d->status == 'active')
                                            <label class="label label-success">Active</label>
                                        @else
                                            <label class="label label-danger">Inactive</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('wallpapers.edit',[$application->slug,$d->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                        {!! Form::open(['route' => ['wallpapers.destroy',$d->id], 'method' => 'DELETE', 'style' => 'display:inline']) !!}

                                            @if($d->status == 'active')
                                                <button title="Inactivate" class="btn btn-danger change-status"><i class="fa fa-times"></i></button>
                                            @else
                                                <button title="Activate" class="btn btn-success change-status"><i class="fa fa-check"></i></button>
                                            @endif

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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