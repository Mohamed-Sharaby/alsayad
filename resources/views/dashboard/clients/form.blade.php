<div class="form-group row">
    <label class="col-md-2 control-label">الاسم</label>
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

    <label class="col-md-2 control-label">المنطقة</label>
    <div class="col-md-4">
        {!! Form::text('area',null,[
                        'class' =>'form-control '.($errors->has('area') ? ' is-invalid' : null),
                        'placeholder'=> 'المنطقة' ,
                        ]) !!}
        @error('area')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>


<div class="form-group row">
    <label class="col-md-2 control-label">العنوان  </label>
    <div class="col-md-4">
        {!! Form::text('address',null,[
                      'class' =>'form-control '.($errors->has('address') ? ' is-invalid' : null),
                      'placeholder'=> 'العنوان' ,
                      ]) !!}
        @error('address')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

    <label class="col-md-2 control-label">الجوال</label>
    <div class="col-md-4">
        {!! Form::text('phone',null,[
                     'class' =>'form-control '.($errors->has('phone') ? ' is-invalid' : null),
                     'placeholder'=> 'الجوال' ,
                     ]) !!}
        @error('phone')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 control-label">ملاحظات  </label>
    <div class="col-md-10">
        {!! Form::textarea('notes',null,['rows'=>3,
                    'class' =>'form-control '.($errors->has('notes') ? ' is-invalid' : null),
                    'placeholder'=> 'ملاحظات' ,
                    ]) !!}
        @error('notes')
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
