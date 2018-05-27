@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-imageupload.css') }}">
@stop

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Title <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="quiz_title" value="{{ old('quiz_title') }}"  placeholder="Quiz Title">
        @if ($errors->has('quiz_title'))
            <label id="quiz_title-error" class="error" for="quiz_title"> {{ $errors->first('quiz_title') }}</label>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Quiz Topic <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="quiz_topic" value="{{ old('quiz_topic') }}"  placeholder="Quiz Topic">
        @if ($errors->has('quiz_topic'))
            <label id="quiz_topic-error" class="error" for="quiz_topic"> {{ $errors->first('quiz_topic') }}</label>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Image <span class="required" aria-required="true">*</span> </label>
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
        @if ($errors->has('image'))
            <label id="image-error" class="error" for="image"> {{ $errors->first('image') }}</label>
        @endif
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

@section('script')
     <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap-imageupload.js') }}"></script>

 <script>
    var $imageupload = $('.imageupload');
    $imageupload.imageupload();
</script>

@stop


