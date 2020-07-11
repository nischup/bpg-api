@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-imageupload.css') }}">
@stop

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


<div class="form-group">
    <label for="catname" class="col-sm-2 control-label">  Name <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name" value="{{ old('name') }}"  placeholder="Name">
        @if ($errors->has('name'))
            <label id="name-error" class="error" for="name"> {{ $errors->first('name') }}</label>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label">  Email Address<span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="email" value="{{ old('email') }}"  placeholder="Email">
        @if ($errors->has('email'))
            <label id="email-error" class="error" for="email"> {{ $errors->first('email') }}</label>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Subject <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="subject" value="{{ old('subject') }}"  placeholder="Subject">
        @if ($errors->has('subject'))
            <label id="subject-error" class="error" for="subject"> {{ $errors->first('subject') }}</label>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label">  Description <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="message" value="{{ old('message') }}"  placeholder="Description">
        @if ($errors->has('message'))
            <label id="message-error" class="error" for="message"> {{ $errors->first('message') }}</label>
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

<script type="text/javascript">


    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>

@stop


