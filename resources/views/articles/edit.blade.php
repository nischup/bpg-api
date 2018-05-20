@extends('layouts.app')
@section('breadcrumb')
 @section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-imageupload.css') }}">
@stop

<!-- leftside content header -->
<div class="content-header">
	<div class="leftside-content-header">
		<ul class="breadcrumbs">
			<li><i class="fa fa-pie-chart" aria-hidden="true"></i><a href="{{ route('dashboard') }}">Dashboard</a></li>
			<li><a href="{{ route('articles.index') }}">Edit Articles</a></li>
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
			<b> Edit Articles </b>
		</h4>
		<span class="pull-right">
			<a href="{{ route('articles.index')}}" class="btn btn-success btn-right-side"><i class="fa fa-list"></i></a>
		</span>
		<div class="panel">
			<div class="panel-content">
			{!! Form::model($article, ['route'=>['articles.update', $article->id], 'method' => 'PUT', 'class' => 'form-horizontal form-stripe']) !!}
					<div class="form-group">
						<label for="catname" class="col-sm-2 control-label"> Title </label>
						<div class="col-sm-4">
							{{Form::text('title',null,array('class' => 'form-control'))}}
						</div>
					</div>

					<div class="form-group">
						<label for="catname" class="col-sm-2 control-label"> Description </label>
						<div class="col-sm-4">
							{{Form::textarea('description',null,array('class' => 'form-control', 'rows' => '3'))}}
						</div>
					</div>

					<div class="form-group">
					    <label for="catname" class="col-sm-2 control-label"> Image </label>
					    <div class="col-sm-4">
				            <div class="imageupload panel panel-default">
				                <div class="file-tab panel-body">
				                	<img src="/uploads/articles/{{ $article->image }}" alt="No Image" width="150" height="150">
				                    <label class="btn btn-default btn-file">
				                        <span>Browse</span>
				                        <!-- The file is stored here. -->
				                        <input type="file" name="image" value="{{ $article->image }}">
				                    </label>
				                    <button type="button" class="btn btn-default">Remove</button>
				                </div>
				            </div>
					    </div>
					</div>

					<div class="form-group">
						<label for="status" class="col-sm-2 control-label"> Articles Status </label>
						<div class="col-sm-4">
							<select name="status" id="select2-example-basic" class="form-control" style="width: 100%">
								<option value=""> Select Status </option>
								<option value="1" selected=""> Active </option>
								<option value="0"> In-Active </option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-2">
							<button type="submit" class="btn btn-primary" disabled="">
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
     <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap-imageupload.js') }}"></script>

 <script>
    var $imageupload = $('.imageupload');
    $imageupload.imageupload();
</script>

@stop