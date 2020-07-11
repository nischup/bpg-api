@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-imageupload.css') }}">
@stop

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Month Year <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="month_year" value="{{ old('month_year') }}"  placeholder="month_year">
        @if ($errors->has('month_year'))
            <label id="month_year-error" class="error" for="month_year"> {{ $errors->first('month_year') }}</label>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> pips <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="pips" value="{{ old('pips') }}"  placeholder="pips">
        @if ($errors->has('pips'))
            <label id="pips-error" class="error" for="pips"> {{ $errors->first('pips') }}</label>
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


