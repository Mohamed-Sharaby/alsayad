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


<button class="btn btn-success" type="button" x-on:click="addItem">اضافة صنف
</button>
<table class="table table-responsive table-hover table-stripe">
    <thead>
    <tr>
        <th>#</th>
        <th>اسم الصنف</th>
        <th>سعر الشراء</th>
        <th>الكمية</th>
        {{--        <th>الاجمالى</th>--}}
        <th>العمليات</th>
    </tr>
    </thead>
    <tbody>
    <template x-for="(row_product,i) in row_products" :key="i">
        <tr x-data=""
            x-init="$watch('row_product.product_id', product_id =>{
             let selected_product= products.find((product)=>product.id==product_id)
             row_product.buying_price=selected_product.buying_price;
            })">

            <td x-text="i+1"></td>
            <td>
                <select :name="`products[${i}][product_id]`" class="form-control"
                        x-model="row_product.product_id"
                >
{{--                    <option selected>اختر الصنف</option>--}}
{{--                    @foreach($products as$product)--}}
{{--                        <option value="{{$product->id}}">{{$product->name}}</option>--}}
{{--                    @endforeach--}}
                    <template x-for="product in products" :key="product.id">
                        <option x-bind:value="product.id" x-text="product.name"
                                :selected="row_product.product_id==product.id" >
                        </option>
                    </template>
                </select>
            </td>
            <td>
                <input type="number" class="form-control" x-bind:name="`products[${i}][buying_price]`"
                       placeholder="سعر الشراء" required step="0.01"
                       x-model="row_product.buying_price"
                >
            </td>
            <td>
                <input type="number" class="form-control" x-bind:name="`products[${i}][quantity]`"
                       placeholder="ادخل الكمية" x-on:change="setProduct($event,i,'quantity')"
                       x-model="row_product.quantity" min="1" required
                >
            </td>
            {{--                <td>--}}
            {{--                    <input type="number" class="form-control"--}}
            {{--                           placeholder="الاجمالى" readonly--}}
            {{--                           x-model="total"--}}
            {{--                    >--}}
            {{--                </td>--}}

            <td>
                <button class="btn btn-danger" type="button" x-on:click="deleteItem(i)">حذف</button>
            </td>
        </tr>
    </template>
    </tbody>
</table>

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
