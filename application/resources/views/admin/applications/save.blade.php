@extends('adminlte::page')

@section('title', $title)

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@stop

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
    			{!! Form::open(['route' => 'applications.store', 'method' => 'POST', 'autocomplete' => 'off', 'files' => true]) !!}
    		@else
    			{!! Form::open(['route' => ['applications.update',$data->id], 'method' => 'PUT', 'autocomplete' => 'off', 'files' => true]) !!}
    		@endif
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#application">Application</a></li>
                  <li><a data-toggle="tab" href="#admob">AdMob</a></li>
                  <li><a data-toggle="tab" href="#onesignal">OneSignal</a></li>
                </ul>

                <div class="tab-content">
                  <div id="application" class="tab-pane fade in active">
                    <br />
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input class="form-control" name="name" id="name" value="{{ @$data->name }}" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control summernote" name="description" id="description">{{ @$data->description }}</textarea>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" readonly="readonly" placeholder="Generate Api Key" name="api_key" id="api_key" value="{{ @$data->api_key }}">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success" id="generate-key"><i class="fa fa-key"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon:</label>
                        @if(!empty(@$data->icon))
                            <br />
                            <img src="{{ asset('application/storage/app/'.@$data->icon) }}" class="img-thumbnail" width="100" height="100" />
                            <br />
                            <br />
                        @endif
                        <input type="file" class="form-control" name="icon" id="icon" />
                    </div>
                    <div class="form-group">
                        <label for="user_id">Operator:</label>
                        <select class="form-control simple-select" style="width: 100% !important;" name="user_id" id="user_id">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if($user->id == @$data->user_id) selected='selected' @endif>{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="current_version">Current Version:</label>
                        <input class="form-control" name="current_version" id="current_version" value="{{ @$data->current_version }}" />
                    </div>
                    <div class="form-group">
                        <label for="author">Author:</label>
                        <input class="form-control" name="author" id="author" value="{{ @$data->author }}" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input class="form-control" name="email" id="email" value="{{ @$data->email }}" />
                    </div>
                    <div class="form-group">
                        <label for="website">Website:</label>
                        <input class="form-control" name="website" id="website" value="{{ @$data->website }}" />
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input class="form-control" name="phone" id="phone" value="{{ @$data->phone }}" />
                    </div>
                    <div class="form-group">
                        <label for="about">About:</label>
                        <textarea class="form-control summernote" name="about" id="about">{{ @$data->about }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="privacy">Privacy:</label>
                        <textarea class="form-control summernote" name="privacy" id="privacy">{{ @$data->privacy }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="dev_play_url">Google Play Developer Url:</label>
                        <input class="form-control" name="dev_play_url" id="dev_play_url" value="{{ @$data->dev_play_url }}" />
                    </div>
                  </div>
                  <div id="admob" class="tab-pane fade">
                    <br />
                    <div class="form-group">
                        <label for="publisher_id">Publisher ID:</label>
                        <input class="form-control" name="publisher_id" id="publisher_id" value="{{ @$data->publisher_id }}" />
                    </div>
                    <div class="form-group">
                        <label for="banner_id">Banner ID:</label>
                        <input class="form-control" name="banner_id" id="banner_id" value="{{ @$data->banner_id }}" />
                    </div>
                    <div class="form-group">
                        <label for="interstitial_id">Interstitial ID:</label>
                        <input class="form-control" name="interstitial_id" id="interstitial_id" value="{{ @$data->interstitial_id }}" />
                    </div>
                    <div class="form-group">
                        <label for="interstitial_clicks">Interstitial Clicks:</label>
                        <input class="form-control" name="interstitial_clicks" id="interstitial_clicks" value="{{ @$data->interstitial_clicks }}" />
                    </div>
                  </div>
                  <div id="onesignal" class="tab-pane fade">
                    <br />
                    <div class="form-group">
                        <label for="one_signal_app_id">OneSignal App ID:</label>
                        <input class="form-control" name="one_signal_app_id" id="one_signal_app_id" value="{{ @$data->one_signal_app_id }}" />
                    </div>
                    <div class="form-group">
                        <label for="one_signal_rest_key">OneSignal Rest Key:</label>
                        <input class="form-control" name="one_signal_rest_key" id="one_signal_rest_key" value="{{ @$data->one_signal_rest_key }}" />
                    </div>
                  </div>
                </div>

    			<button class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
    			<a class="btn btn-danger" href="{{ route('applications.index') }}"><i class="fa fa-times"></i> Cancel</a>
    		{!! Form::close() !!}
    	</div>
    </div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select.simple-select').select2();
        $('textarea.summernote').summernote({
            height: 200
        });

        $("#generate-key").click(function(){
            var api_key = makeid(80);
            $("#api_key").val(api_key);
        });

        function makeid(length) {
           var result           = '';
           var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
           var charactersLength = characters.length;
           for ( var i = 0; i < length; i++ ) {
              result += characters.charAt(Math.floor(Math.random() * charactersLength));
           }
           return result;
        }
    });
</script>
@stop