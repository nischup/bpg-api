@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-imageupload.css') }}">
@stop


<div class="form-group">
    <label for="status" class="col-sm-2 control-label"> Pips </label>
    <div class="col-sm-4">
         <select name="pips_id" id="select2-example-basic" class="form-control" style="width: 100%">
                <option value=""> Select Pips </option>
                @foreach($pips as $pips_data)
                    <option value="{{ $pips_data['id'] }}"> {{ $pips_data['pips'] }} </option>
                @endforeach
        </select>
        @if ($errors->has('pips_id'))
            <label id="pips_id-error" class="error" for="pips_id"> {{ $errors->first('pips_id') }}</label>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="status" class="col-sm-2 control-label"> Signal </label>
    <div class="col-sm-4">
         <select name="signal_id" id="select2-example-basic" class="form-control" style="width: 100%">
                <option value=""> Select signal </option>
                @foreach($signal as $signal_data)
                    <option value="{{ $signal_data['id'] }}"> {{ $signal_data['signal_name'] }} </option>
                @endforeach
        </select>
        @if ($errors->has('signal_id'))
            <label id="status-error" class="error" for="signal_id"> {{ $errors->first('signal_id') }}</label>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Pips Number <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <textarea type="text" class="form-control" name="pips_number" value="{{ old('pips_number') }}"  placeholder="Pips Number"></textarea>
        @if ($errors->has('pips_number'))
            <label id="category_title-error" class="error" for="pips_number"> {{ $errors->first('pips_number') }}</label>
        @endif
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


