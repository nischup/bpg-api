@extends('layouts.app')
@section('breadcrumb')
<!-- leftside content header -->
<div class="content-header">
	<div class="leftside-content-header">
		<ul class="breadcrumbs">
			<li><i class="fa fa-pie-chart" aria-hidden="true"></i><a href="{{ route('dashboard') }}">Dashboard</a></li>
			<li><a href="{{ route('pips_detail.index') }}">Edit Pips Detail</a></li>
		</ul>
	</div>
</div>
@stop
@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<!--SUCCESS-->
		@if (Session::has('success'))           
		<div class="alert alert-success fade in">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			{!! Session::get('success') !!}
		</div>
		@endif 
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<h4 class="section-subtitle">
			<b> Edit Pips Detail</b>
		</h4>
		<span class="pull-right">
			<a href="{{ route('pips_detail.index')}}" class="btn btn-success btn-right-side"><i class="fa fa-list"></i></a>
		</span>
		<div class="panel">
			<div class="panel-content">
			{!! Form::model($pips_detail, ['route'=>['pips_detail.update', $pips_detail->id], 'method' => 'PUT', 'class' => 'form-horizontal form-stripe']) !!}

					<div class="form-group">
						<label for="status" class="col-sm-2 control-label"> Pips </label>
						<div class="col-sm-4">
							<select name="pips_id" id="select2-example-basic" class="form-control" style="width: 100%">
					                {{-- <option value=""> Select Category </option> --}}
					             @foreach($pips as $pips_data)
					                    <option value="{{ $pips_data['id'] }}"> {{ $pips_data['pips'] }} </option>
					                @endforeach
					        </select>
						</div>
					</div>					


					<div class="form-group">
						<label for="status" class="col-sm-2 control-label"> Signal </label>
						<div class="col-sm-4">
							<select name="signal_id" id="select2-example-basic" class="form-control" style="width: 100%">
					                {{-- <option value=""> Select Category </option> --}}
					            @foreach($signal as $signal_data)
				                    <option value="{{ $signal_data['id'] }}"> {{ $signal_data['signal_name'] }} </option>
				                @endforeach
					        </select>
						</div>
					</div>

					<div class="form-group">
						<label for="catname" class="col-sm-2 control-label"> Pips Number </label>
						<div class="col-sm-4">
							{{Form::text('pips_number',null,array('class' => 'form-control'))}}
						</div>
					</div>					

					<div class="form-group">
					    <label for="pips_type" class="col-sm-2 control-label"> Pips Type </label>
					    <div class="col-sm-4">
					         <select name="pips_type" id="select2-example-basic" class="form-control" style="width: 100%">
					                <option value=""> Select pips_type </option>
					                <option value="1"> Short </option>
					                <option value="0"> Long </option>
					        </select>
					        @if ($errors->has('pips_type'))
					            <label id="pips_type-error" class="error" for="pips_type"> {{ $errors->first('pips_type') }}</label>
					        @endif
					    </div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-2">
							<button type="submit" class="btn btn-primary">
								Update
							</button>
						</div>
					</div>
			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop

@section('script')

 <script>
 	function previewImage(event) {
 		var output = document.getElementById('output');
 		output.src = URL.createObjectURL(event.target.files[0]);
 	};
</script>

@stop