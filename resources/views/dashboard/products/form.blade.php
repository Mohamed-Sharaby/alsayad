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

    <label class="col-md-2 control-label">القسم</label>
    <div class="col-md-4">
        {!! Form::select('category_id',$categories,null,['class' =>'form-control '.($errors->has('category_id') ? ' is-invalid' : null)
, 'placeholder'=>  'القسم' ]) !!}
        @error('category_id')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 control-label">سعر البيع</label>
    <div class="col-md-4">
        {!! Form::number('selling_price',null,[
                         'class' =>'form-control '.($errors->has('selling_price') ? ' is-invalid' : null),
                         'placeholder'=> 'سعر البيع' ,'step'=>'0.01'
                         ]) !!}
        @error('selling_price')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{--    @empty($product)--}}
    {{--        <label class="col-md-2 control-label"> الكمية الابتدائية </label>--}}
    {{--        <div class="col-md-4">--}}
    {{--            {!! Form::number('start_quantity',null,[--}}
    {{--                             'class' =>'form-control '.($errors->has('start_quantity') ? ' is-invalid' : null),--}}
    {{--                             'placeholder'=> 'الكمية الابتدائية ' ,--}}
    {{--                             ]) !!}--}}
    {{--            @error('start_quantity')--}}
    {{--            <div class="invalid-feedback" style="color: #ef1010">--}}
    {{--                {{ $message }}--}}
    {{--            </div>--}}
    {{--            @enderror--}}
    {{--        </div>--}}
    {{--    @endempty--}}
</div>

<div class="form-group row">
    <label class="col-md-2 control-label">النوع</label>
    <div class="col-md-4">
        {!! Form::select('type',types(),null,['class' =>'form-control '.($errors->has('type') ? ' is-invalid' : null)
, 'placeholder'=>  'اختر النوع', 'x-model'=>'type']) !!}
        @error('type')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
<div x-show="type=='made'">
    <div class="form-group row">
        <label class="col-md-2 control-label"> طريقة التصنيع </label>
        <div class="col-md-4">
            {!! Form::select('made_in_order',made_in_order(),null,['class' =>'form-control '.($errors->has('made_in_order') ? ' is-invalid' : null) ]) !!}
            @error('made_in_order')
            <div class="invalid-feedback" style="color: #ef1010">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

<div x-show="type=='ready'">
    <div class="form-group row">
        <label class="col-md-2 control-label">الوحدة </label>
        <div class="col-md-4">
            {!! Form::select('unit_id',$units,null,['class' =>'form-control '.($errors->has('unit_id') ? ' is-invalid' : null)
, 'placeholder'=>  'الوحدة' ]) !!}
            @error('unit_id')
            <div class="invalid-feedback" style="color: #ef1010">
                {{ $message }}
            </div>
            @enderror
        </div>
        <label class="col-md-2 control-label">سعر الشراء</label>
        <div class="col-md-4">
            {!! Form::number('buying_price',isset($product) ? $product->getAttributes()['buying_price'] : null,[
                             'class' =>'form-control '.($errors->has('buying_price') ? ' is-invalid' : null),
                             'placeholder'=> 'سعر الشراء' ,'step'=>'0.01'
                             ]) !!}
            @error('buying_price')
            <div class="invalid-feedback" style="color: #ef1010">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>


<div x-show="type=='made'">
    <button class="btn btn-success" type="button" x-on:click="materials.push(materials.length)">اضافة مكون
    </button>
    <table class="table table-responsive table-hover table-stripe">
        <thead>
        <tr>
            <th>#</th>
            <th>الماده الخام</th>
            <th>الوحدة</th>
            <th>الكمية</th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody>
        <template x-for="(material,i) in materials">
            <tr>
                <td x-text="i+1"></td>
                <td>
                    <select x-bind:name="`material[${i}][material_id]`" class="form-control"
                            :value="typeof material=='object'?material.id:null">
                        @foreach($materials as $id=>$name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select x-bind:name="`material[${i}][unit_id]`" class="form-control"
                            :value="typeof material == 'object'? material.pivot.unit_id:null">
                        @foreach($units as $id=>$name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <input type="number" class="form-control" x-bind:name="`material[${i}][quantity]`"
                           :value="typeof material=='object'?  material.pivot.quantity:null"
                    >
                </td>
                <td>
                    <button class="btn btn-danger" type="button" x-on:click="materials.splice(i,1)">حذف</button>
                </td>
            </tr>
        </template>
        </tbody>
    </table>

    <div class="form-group row">
        <label class="col-md-2 control-label"> تكلفة التصنيع</label>
        <div class="col-md-4">
            {!! Form::number('made_cost',null,[
                             'class' =>'form-control '.($errors->has('made_cost') ? ' is-invalid' : null),
                             'placeholder'=> 'تكلفة التصنيع' ,'step'=>'0.0001'
                             ]) !!}
            @error('made_cost')
            <div class="invalid-feedback" style="color: #ef1010">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 control-label">ملاحظات</label>
    <div class="col-md-4">
        {!! Form::textarea('notes',null,['cols'=> '30','rows'=>3,
    'class' =>'form-control '.($errors->has('notes') ? ' is-invalid' : null),
     'placeholder'=> 'ملاحظات'  ]) !!}
        @error('notes')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
    <label class="col-md-2 control-label">نوع الطبخ</label>
    <div class="col-md-4">
        {!! Form::select('is_cooking',is_cooking(),null,['class' =>'form-control '.($errors->has('is_cooking') ? ' is-invalid' : null)
, 'placeholder'=>  'اختر ']) !!}
        @error('is_cooking')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 control-label">الصورة </label>
    <div class="col-sm-4">
        {!! Form::file('image',[ 'class' =>'form-control '.($errors->has('image') ? ' is-invalid' : null) ]) !!}
        @error('image')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
    @isset($product)
        @if($product->image)
            <a data-fancybox="gallery" href="{{$product->image}}">
                <img src="{{$product->image}}" width="100" height="100"
                     class="img-thumbnail">
            </a>
        @else لا يوجد صورة @endif
    @endisset
</div>

<div class="text-center form-group row">
    <button type="submit"
            class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md">
        حفظ
    </button>
</div>
