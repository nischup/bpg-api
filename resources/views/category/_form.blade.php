@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-imageupload.css') }}">
@stop

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Category <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="category" value="{{ old('category') }}"  placeholder="category">
        @if ($errors->has('category'))
            <label id="category-error" class="error" for="category"> {{ $errors->first('category') }}</label>
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
        @if ($errors->has('status'))
            <label id="status-error" class="error" for="status"> {{ $errors->first('status') }}</label>
        @endif
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


