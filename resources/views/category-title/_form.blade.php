@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-imageupload.css') }}">
@stop


<div class="form-group">
    <label for="status" class="col-sm-2 control-label"> Category </label>
    <div class="col-sm-4">
         <select name="category_id" id="select2-example-basic" class="form-control" style="width: 100%">
                <option value=""> Select Category </option>
                @foreach($category as $cat_data)
                    <option value="{{ $cat_data['id'] }}"> {{ $cat_data['title'] }} </option>
                @endforeach
        </select>
        @if ($errors->has('status'))
            <label id="status-error" class="error" for="status"> {{ $errors->first('status') }}</label>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Category Title <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="category_title" value="{{ old('category_title') }}"  placeholder="category title">
        @if ($errors->has('category_title'))
            <label id="category_title-error" class="error" for="category_title"> {{ $errors->first('category_title') }}</label>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Category Description <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <textarea type="text" class="form-control" name="category_description" value="{{ old('category_description') }}"  placeholder="category Description"></textarea>
        @if ($errors->has('category_description'))
            <label id="category_title-error" class="error" for="category_description"> {{ $errors->first('category_description') }}</label>
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


