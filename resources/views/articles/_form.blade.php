
 @section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-imageupload.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <style>
        .note-editing-area{
            height: 300px;
        }
    </style>
 @stop

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Title <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Article Title">
        @if ($errors->has('title'))
            <label id="title-error" class="error" for="title"> {{ $errors->first('title') }}</label>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Description <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <textarea type="text" class="form-control summernote"  rows="20" name="description" placeholder="Article Description"> {{ old('description') }} </textarea>
        @if ($errors->has('description'))
            <label id="description-error" class="error" for="description"> {{ $errors->first('description') }}</label>
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
    <label for="type" class="col-sm-2 control-label"> Type <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
         <select name="type" id="select2-example-basic" class="form-control" style="width: 100%">
                <option value=""> Select Type </option>
                <option value="1"> সর্বশেষ </option>
                <option value="2"> আলোচিত </option>
                <option value="3"> অদেখা </option>
        </select>
        @if ($errors->has('type'))
            <label id="type-error" class="error" for="type"> {{ $errors->first('type') }}</label>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    {{--<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="crossorigin="anonymous"></script>--}}
    <script src="{{ asset('js/bootstrap-imageupload.js') }}"></script>

 <script>
    var $imageupload = $('.imageupload');
    $imageupload.imageupload();
</script>


    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>

@stop



