@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }} (Application)</h1>
@stop

@include('flash::message')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="info-box">
              <!-- Apply any bg-* class to to the icon to color it -->
              <span class="info-box-icon bg-blue"><i class="fa fa-list"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Categories</span>
                <span class="info-box-number">{{ $data->categories->count() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-6">
            <div class="info-box">
              <!-- Apply any bg-* class to to the icon to color it -->
              <span class="info-box-icon bg-red"><i class="fa fa-image"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Wallpapers</span>
                <span class="info-box-number">{{ $data->wallpapers->count() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
              <li class="list-group-item"><center>Menu</center></li>
              <li class="list-group-item"><a href="{{ route('categories.index',$data->slug) }}"><i class="fa fa-list"></i> Categories</a></li>
              <li class="list-group-item"><a href="{{ route('wallpapers.index',$data->slug) }}"><i class="fa fa-image"></i> Wallpapers</a></li>
            </ul>
        </div> 
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Last 100 Wallpapers Uploads</h2>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Thumbnail</th>
                            <th>View</th>
                        </thead>
                        <tbody>
                            @foreach($data->wallpapers() as $wall)
                                <tr>
                                    <td>{{ $wall->id }}</td>
                                    <td>{{ $wall->category->name }}</td>
                                    <td></td>
                                    <td></td>
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