@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-imageupload.css') }}">
@stop
@extends('layouts.app')
@section('breadcrumb')
<!-- leftside content header -->
<div class="content-header">
	<div class="leftside-content-header">
	    <ul class="breadcrumbs">
	        <li><i class="fa fa-pie-chart" aria-hidden="true"></i><a href="{{ route('dashboard') }}">Dashboard</a></li>
	        <li><a href="{{ route('question.index') }}"> Add question </a></li>
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
			<b> Add question </b>
		</h4>
		<span class="pull-right">
			<a href="{{ route('question.index')}}" class="btn btn-success btn-right-side"><i class="fa fa-list"></i></a>
		</span>
		 <div class="panel">
            <div class="panel-content">
				<form action="{{ route('question.store') }}" method="post" class="form-horizontal form-stripe" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group">
					    <label for="catname" class="col-sm-2 control-label"> Quiz Topic <span class="required" aria-required="true">*</span> </label>
					    <div class="col-sm-4">
					        <select name="quiz_topic_id" id="select2-example-basic" class="form-control" style="width: 100%">
					         <option value=""> Select Topic </option>
					         	@foreach($quiz as $data_quiz)
					                <option value="{{ $data_quiz->id }}"> {{ $data_quiz->quiz_title }} </option>
					            @endforeach
					        </select>
					        @if ($errors->has('quiz_topic_id'))
					            <label id="quiz_topic_id-error" class="error" for="quiz_topic_id"> {{ $errors->first('quiz_topic_id') }}</label>
					        @endif
					    </div>
					</div>

					 <div class="form-group">
					    <label for="catname" class="col-sm-2 control-label"> Question <span class="required" aria-required="true">*</span> </label>
					    <div class="col-sm-4">
					        <input type="text" class="form-control" value="{{ old('question') }}" name="question"  placeholder="Question">
					        @if ($errors->has('question'))
					            <label id="question-error" class="error" for="question"> {{ $errors->first('question') }}</label>
					        @endif
					    </div>
					</div>

					<div class="form-group">
					    <label for="catname" class="col-sm-2 control-label"> Question Explanation </label>
					    <div class="col-sm-4">
					        <input type="text" class="form-control" value="{{ old('question_explanation') }}" name="question_explanation"  placeholder="Question Explanation">
					        @if ($errors->has('question_explanation'))
					            <label id="question_explanation-error" class="error" for="question_explanation"> {{ $errors->first('question_explanation') }}</label>
					        @endif
					    </div>
					</div>


					<div class="form-group">
					    <label for="catname" class="col-sm-2 control-label"> Point <span class="required" aria-required="true">*</span> </label>
					    <div class="col-sm-4">
					        <input type="number" min="0" class="form-control" value="{{ old('point') }}" name="point"  placeholder="Point">
					        @if ($errors->has('point'))
					            <label id="point-error" class="error" for="point"> {{ $errors->first('point') }}</label>
					        @endif
					    </div>
					</div>

					<div class="form-group">
					    <label for="catname" class="col-sm-2 control-label"> Question Image </label>
					    <div class="col-sm-4">
					            <div class="imageupload panel panel-default">
					                <div class="file-tab panel-body">
					                    <label class="btn btn-default btn-file">
					                        <span>Browse</span>
					                        <!-- The file is stored here. -->
					                        <input type="file" name="image">
					                    </label>
					                    <button type="button" class="btn btn-default">Remove</button>
					                </div>
					            </div>
					    </div>
					</div>

					<div class="form-group">
					    <label for="status" class="col-sm-2 control-label"> Status </label>
					    <div class="col-sm-4">
					         <select name="status" id="select2-example-basic" class="form-control" style="width: 100%">
					                <option value=""> Select Status </option>
					                <option value="1"> Active </option>
					                <option value="0"> In-Active </option>
					        </select>
					    </div>
					</div>

					<div class="form-group">
					    <div class="col-md-6 col-md-offset-2">
					        <button type="submit" class="btn btn-primary">
					            ADD
					        </button>
					    </div>
					</div>

                </form>
            </div>
        </div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<h4 class="section-subtitle">
			<b>Add Question Option</b>
		</h4>
		 <div class="panel">
            <div class="panel-content">
				<form action="{{ route('question.option.store') }}" method="post" class="form-horizontal form-stripe" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
					    <label for="catname" class="col-sm-2 control-label"> Question <span class="required" aria-required="true">*</span> </label>
					    <div class="col-sm-4">
					        <select name="question_option" id="select2-example-basic" class="form-control" style="width: 100%">
					                <option value=""> Select Question </option>
					                @foreach($question as $data_q)
					                <option value="{{ $data_q->id }}"> {{ $data_q->question }} </option>
					                @endforeach
					        </select>
					        @if ($errors->has('question_option'))
					            <label id="question_option-error" class="error" for="question_option"> {{ $errors->first('question_option') }}</label>
					        @endif
					    </div>
					</div>

					<div class="form-group">
					    <label for="catname" class="col-sm-2 control-label"> First Option <span class="required" aria-required="true">*</span> </label>
					    <div class="col-sm-4">
					        <input type="text" class="form-control" value="{{ old('option_1') }}" name="option_1"  placeholder="Option 1">
					        @if ($errors->has('option_1'))
					            <label id="option_1-error" class="error" for="option_1"> {{ $errors->first('option_1') }}</label>
					        @endif
					    </div>
					    <div class="col-sm-2"> <input type="radio" name="answer" value="1" checked="checked" /> </div>
					</div>

					<div class="form-group">
					    <label for="catname" class="col-sm-2 control-label"> Second Option <span class="required" aria-required="true">*</span> </label>
					    <div class="col-sm-4">
					        <input type="text" class="form-control" value="{{ old('option_2') }}" name="option_2"  placeholder="Option 2">
					        @if ($errors->has('option_2'))
					            <label id="option_2-error" class="error" for="option_2"> {{ $errors->first('option_2') }}</label>
					        @endif
					    </div>
					    <div class="col-sm-2"> <input type="radio" name="answer" value="2"> </div>
					</div>

					<div class="form-group">
					    <label for="catname" class="col-sm-2 control-label"> Third Option <span class="required" aria-required="true">*</span> </label>
					    <div class="col-sm-4">
					        <input type="text" class="form-control" value="{{ old('option_3') }}" name="option_3"  placeholder="Option 3">
					        @if ($errors->has('option_3'))
					            <label id="option_3-error" class="error" for="option_3"> {{ $errors->first('option_3') }}</label>
					        @endif
					    </div>
					    <div class="col-sm-2"> <input type="radio" name="answer" value="3"> </div>
					</div>

					<div class="form-group">
					    <label for="catname" class="col-sm-2 control-label"> Fourth Option <span class="required" aria-required="true">*</span> </label>
					    <div class="col-sm-4">
					        <input type="text" class="form-control" value="{{ old('option_4') }}" name="option_4"  placeholder="Option 4">
					        @if ($errors->has('option_4'))
					            <label id="option_4-error" class="error" for="option_4"> {{ $errors->first('option_4') }}</label>
					        @endif
					    </div>
					    <div class="col-sm-2"> <input type="radio" name="answer" value="4"> </div>
					</div>

					<div class="form-group">
					    <div class="col-md-6 col-md-offset-2">
					        <button type="submit" class="btn btn-primary">
					            Save
					        </button>
					    </div>
					</div>
                </form>
            </div>
        </div>
	</div>
</div>
@stop

@section('script')
    <script src="{{ asset('js/bootstrap-imageupload.js') }}"></script>
 <script>
    var $imageupload = $('.imageupload');
    $imageupload.imageupload();
</script>

@stop

