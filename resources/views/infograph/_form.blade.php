
<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Title <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="title"  placeholder="Title">
        <span class="alert-danger"> {{ $errors->has('title') ? 'required' : '' }} </span>
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Description <span class="required" aria-required="true">*</span> </label>
    <div class="col-sm-4">
        <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
    </div>
</div>

<div class="form-group">
    <label for="catname" class="col-sm-2 control-label"> Image </label>
    <div class="col-sm-4">
        <input type="file" class="form-control" name="image">
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