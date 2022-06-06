<div class="form-group row">
    {{--    <label class="col-md-2 control-label">رقم الفاتورة</label>--}}
    {{--    <div class="col-md-4">--}}
    {{--        {!! Form::text('code',null,[--}}
    {{--                        'class' =>'form-control '.($errors->has('code') ? ' is-invalid' : null),--}}
    {{--                        'placeholder'=> 'رقم الفاتورة' ,--}}
    {{--                        ]) !!}--}}
    {{--        @error('code')--}}
    {{--        <div class="invalid-feedback" style="color: #ef1010">--}}
    {{--            {{ $message }}--}}
    {{--        </div>--}}
    {{--        @enderror--}}
    {{--    </div>--}}

    <label class="col-md-2 control-label">رقم الفاتورة لدى المورد</label>
    <div class="col-md-4">
        {!! Form::text('supplier_invoice_code',null,[
                        'class' =>'form-control '.($errors->has('supplier_invoice_code') ? ' is-invalid' : null),
                        'placeholder'=> 'رقم الفاتورة لدى المورد' ,
                        ]) !!}
        @error('supplier_invoice_code')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{--@dd($errors->all())--}}
<div class="form-group row">
    <label class="col-md-2 control-label">اسم المورد</label>
    <div class="col-md-4">
        {!! Form::select('supplier_id',$suppliers, null,['class' =>'form-control'.($errors->has('supplier_id') ? ' is-invalid' : null),'placeholder'=>'اختر المورد' ,'x-model'=>'supplier_id' ]) !!}
        @error('supplier_id')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

    <label class="col-md-2 control-label">التاريخ </label>
    <div class="col-md-4">
        {!! Form::date('date', isset($invoice) ?  $invoice->date : now(),[
                       'class' =>'form-control '.($errors->has('date') ? ' is-invalid' : null),
                       'placeholder'=> 'التاريخ ' ,
                       ]) !!}
        @error('date')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>


<div>
    <button class="btn btn-success" type="button" x-on:click="addItem">اضافة صنف
    </button>
    @error('products')
    <div class="invalid-feedback" style="color: #ef1010">
        {{ $message }}
    </div>
    @enderror
    <table class="table table-responsive table-hover table-stripe">
        <thead>
        <tr>
            <th>#</th>
            <th>الصنف</th>
            <th>الوحدة</th>
            <th>سعر الشراء</th>
            <th>الكمية</th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody>
        <template x-for="(product,i) in products" :key="i">
            <tr x-data=""
                x-init="()=>{

                 $watch('product.product_id', product_id =>{
             let selected_product= supplier_products.find((product)=>product.id==product_id)
             product.buying_price=selected_product.buying_price;
            });


            }">
                <td x-text="i+1"></td>

                <td>
                    <select x-bind:name="`products[${i}][product_id]`" class="form-control"
                            x-model="product.product_id"
                    >
                        <option selected>اختر الصنف</option>
                        <template x-for="supplier_product in supplier_products" :key="supplier_product.id">
                            <option x-bind:value="supplier_product.id" x-text="supplier_product.name"
                                    :selected="product.product_id==supplier_product.id">
                            </option>
                        </template>
                    </select>
                </td>

                <td>
                    <select x-bind:name="`products[${i}][unit_id]`" class="form-control"
                            :value="typeof product == 'object'? product.unit_id:null">
                        <option disabled>اختر</option>
                        @foreach($units as $id=>$name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    @error('products.*.unit_id')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </td>

                <td>
                    <input type="number" class="form-control" x-bind:name="`products[${i}][buying_price]`"
                           placeholder="السعر" step="0.01"
                           {{--                           :value="product.buying_price"--}}
                           {{--                           x-on:change="setProduct($event,i,'buying_price')"--}}
                           x-model="product.buying_price"
                    >
                </td>

                <td>
                    <input type="number" class="form-control" x-bind:name="`products[${i}][quantity]`"
                           placeholder="الكمية" x-on:change="setProduct($event,i,'quantity')"
                           :value="product.quantity">
                </td>

                <td>
                    <button class="btn btn-danger" type="button" x-on:click="deleteItem(i)">حذف</button>
                </td>
            </tr>
        </template>
        </tbody>
    </table>
</div>

<div class="form-group row">
    <label class="col-md-2 control-label">اجمالى الفاتورة</label>
    <div class="col-md-4">
        {{--        <span x-text="total"></span>--}}
        {!! Form::number('total',null,[
                         'class' =>'form-control '.($errors->has('total') ? ' is-invalid' : null),
                         'placeholder'=> 'اجمالى الفاتورة' ,'readonly','x-model'=>'total'
                         ]) !!}
        @error('total')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
    @empty($invoice)
        <label class="col-md-2 control-label">المسدد </label>
        <div class="col-md-4">
            {!! Form::number('received',0,[
                             'class' =>'form-control '.($errors->has('received') ? ' is-invalid' : null),
                             'placeholder'=> 'المبلغ المسدد ','step'=>'0.01'
                             ]) !!}
            @error('received')
            <div class="invalid-feedback" style="color: #ef1010">
                {{ $message }}
            </div>
            @enderror
        </div>
    @endempty
</div>
<div class="form-group row">
    <label class="col-md-2 control-label">ملاحظات</label>
    <div class="col-md-10">
        {!! Form::textarea('notes',null,['cols'=> '30','rows'=>3,
    'class' =>'form-control '.($errors->has('notes') ? ' is-invalid' : null),
     'placeholder'=> 'ملاحظات'  ]) !!}
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
