<div class="form-group row">
    <label class="col-md-2 control-label">الاسم  </label>
    <div class="col-md-4">
        {!! Form::text('name',null,[
                       'class' =>'form-control '.($errors->has('name') ? ' is-invalid' : null),
                       'placeholder'=> 'الاسم' ,
                       ]) !!}
        @error('name')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

</div>


<div class="text-center form-group row">
    <button type="submit"
            class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md">
        حفظ
    </button>
</div>
