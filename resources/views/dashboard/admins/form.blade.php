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

    <label class="col-md-2 control-label" for="example-email">البريد
        الالكترونى</label>
    <div class="col-md-4">
        {!! Form::email('email',null,[
                     'class' =>'form-control '.($errors->has('email') ? ' is-invalid' : null),
                     'placeholder'=> 'البريد الالكترونى' ,
                     ]) !!}
        @error('email')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 control-label">كلمة المرور</label>
    <div class="col-md-4">
        {!! Form::password('password',[
                     'class' =>'form-control '.($errors->has('password') ? ' is-invalid' : null),
                     'placeholder'=> 'كلمة المرور' ,
                     ]) !!}
        @error('password')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror </div>

    <label class="col-md-2 control-label">تأكيد كلمة المرور</label>
    <div class="col-md-4">
        {!! Form::password('password_confirmation',[
                     'class' =>'form-control '.($errors->has('password_confirmation') ? ' is-invalid' : null),
                     'placeholder'=>  'تأكيد كلمة المرور' ,
                     ]) !!}
    </div>
</div>

<div class="form-group row">
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
{{--    @if(auth()->id() != $admin->id)--}}
    <label class="col-sm-2 control-label"> المنصب</label>
    <div class="col-sm-4">
        {!! Form::select('roles',$roles,null,['class' =>'form-control '.($errors->has('roles') ? ' is-invalid' : null)
 , 'placeholder'=>  'اختر المنصب', ]) !!}
        @error('roles')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
{{--@endif--}}
</div>

<div class="form-group row">
    <label class="col-md-2 control-label">العنوان</label>
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


        <label class="col-md-2 control-label">المرتب الاساسى</label>
        <div class="col-md-4">
            {!! Form::number('salary',isset($admin) ? $admin->salary : null,[
                        'class' =>'form-control '.($errors->has('salary') ? ' is-invalid' : null),
                        'placeholder'=> 'المرتب الاساسى' ,
                        ]) !!}
            @error('salary')
            <div class="invalid-feedback" style="color: #ef1010">
                {{ $message }}
            </div>
            @enderror
        </div>


</div>

<div class="text-center form-group row">
    <button type="submit"
            class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md"> حفظ
    </button>
</div>
