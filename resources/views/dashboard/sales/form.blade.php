<div class="form-group row">
    <label class="col-md-2 control-label">رقم الفاتورة</label>
    <div class="col-md-4">
        {!! Form::text('code',null,[
                        'class' =>'form-control '.($errors->has('code') ? ' is-invalid' : null),
                        'placeholder'=> 'رقم الفاتورة' ,
                        ]) !!}
        @error('code')
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


<div class="form-group row">
    <label class="col-md-2 control-label">اسم العميل</label>
    <div class="col-md-4">
        {!! Form::select('client_id',$clients, null,['class' =>'form-control'.($errors->has('client_id') ? ' is-invalid' : null),'placeholder'=>'اختر العميل'   ]) !!}
        @error('client_id')
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
            <th>سعر البيع</th>
            <th>الكمية</th>
            <th>اجمالى سعر الصنف</th>
            <th>نوع الطبخ</th>
            <th>سعر الطبخ</th>
            <th>السعر النهائى</th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody>
        <template x-for="(row_product,i) in row_products" :key="i">
            <tr x-data=""
                x-init="$watch('row_product.product_id', product_id =>{
             let selected_product= products.find((product)=>product.id==product_id)
             row_product.product_price=selected_product.selling_price;
            })

            $watch('row_product.quantity', quantity =>{
             row_product.total_product_price= row_product.product_price * row_product.quantity;
             row_product.total = parseInt(row_product.product_price * row_product.quantity)
              + parseInt(row_product.cooking_price);
            })

            $watch('row_product.cooking_price', cooking_price =>{
             row_product.total =  parseInt(row_product.product_price * row_product.quantity) + parseInt(cooking_price);
            })

             $watch('row_product.product_price', product_price =>{
             row_product.total_product_price =  row_product.product_price * row_product.quantity;
             row_product.total =  parseInt(row_product.product_price * row_product.quantity) + parseInt(row_product
             .cooking_price);
            })
            ">
                <td x-text="i+1"></td>
                <td>
                    <select x-bind:name="`products[${i}][product_id]`" class="form-control"
                            x-model="row_product.product_id">
                        <option selected>اختر الصنف</option>
                        <template x-for="product in products" :key="product.id">
                            <option x-bind:value="product.id" x-text="product.name"
                                    :selected="row_product.product_id==product.id">
                            </option>
                        </template>
                    </select>
                </td>

                <td>
                    <input type="number" class="form-control" x-bind:name="`products[${i}][product_price]`"
                           placeholder="سعر البيع" step="0.01"
                           x-model="row_product.product_price"
                    >
                </td>

                <td>
                    <input type="number" class="form-control" x-bind:name="`products[${i}][quantity]`"
                           placeholder="الكمية" x-on:change="setProduct($event,i,'quantity')"
                           x-model="row_product.quantity"
                    >
                </td>
                <td>
                    <input type="number" class="form-control" x-bind:name="`products[${i}][total_product_price]`"
                           placeholder="اجمالى سعر الصنف" x-on:change="setProduct($event,i,'total_product_price')"
                           readonly step="0.01"
                           x-model="row_product.total_product_price">
                </td>
                <td>
                    <select x-bind:name="`products[${i}][cooking_id]`" class="form-control"
                            x-model="row_product.cooking_id">

                        <template x-for="cooking in cookings" :key="cooking.id">
                            <option x-bind:value="cooking.id" x-text="cooking.name"
                                    :selected="row_product.cooking_id==cooking.id">
                            </option>
                        </template>
                    </select>
                </td>

                <td>
                    <input type="number" class="form-control" x-bind:name="`products[${i}][cooking_price]`"
                           placeholder="سعر الطبخ" x-on:change="setProduct($event,i,'cooking_price')"
                           step="0.01"
                           x-model="row_product.cooking_price">
                </td>

                <td>
                    <input type="number" class="form-control" x-bind:name="`products[${i}][total]`"
                           placeholder="السعر النهائى" x-on:change="setProduct($event,i,'total')"
                           readonly step="0.01"
                           x-model="row_product.total">
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

        {!! Form::number('total',null,[
                         'class' =>'form-control '.($errors->has('total') ? ' is-invalid' : null),
                         'placeholder'=> 'اجمالى الفاتورة' ,'readonly','step'=>'0.01',
'x-model'=>'totalInvoice'
                         ]) !!}
        {{--        {!! Form::number('total',null,[--}}
        {{--                         'class' =>'form-control '.($errors->has('total') ? ' is-invalid' : null),--}}
        {{--                         'placeholder'=> 'اجمالى الفاتورة' ,'readonly',--}}
        {{--                         'x-model'=>'total'--}}
        {{--                         ]) !!}--}}
        @error('total')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
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
