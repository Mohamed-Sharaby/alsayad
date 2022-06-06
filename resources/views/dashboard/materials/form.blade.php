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

    <label class="col-md-2 control-label">الوحدة</label>
    <div class="col-md-4">
        {!! Form::select('unit_id',$units,null,['class' =>'form-control '.($errors->has('unit_id') ? ' is-invalid' : null)
, 'placeholder'=>  'الوحدة' ]) !!}
        @error('unit_id')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
<div class="form-group row">

    @empty($product)
        <label class="col-md-2 control-label"> الكمية الابتدائية</label>
        <div class="col-md-4">
            {!! Form::number('start_quantity',null,[
                             'class' =>'form-control '.($errors->has('start_quantity') ? ' is-invalid' : null),
                             'placeholder'=> 'الكمية الابتدائية' ,
                             ]) !!}
            @error('start_quantity')
            <div class="invalid-feedback" style="color: #ef1010">
                {{ $message }}
            </div>
            @enderror
        </div>
    @endempty
    <label class="col-md-2 control-label"> سعر الشراء</label>
    <div class="col-md-4">
        {!! Form::number('buying_price',null,[
                         'class' =>'form-control '.($errors->has('buying_price') ? ' is-invalid' : null),
                         'placeholder'=> ' سعر الشراء' ,'step'=>'0.01'
                         ]) !!}
        @error('buying_price')
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
