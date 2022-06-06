<div class="form-group row">
    <label class="col-md-2 control-label"> التاريخ</label>
    <div class="col-md-4">
        <div class="input-group">
            {{--            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose">--}}
            {!! Form::text('date', now()->toDateString(),[
                       'class' =>'form-control '.($errors->has('date') ? ' is-invalid' : null),
                       'placeholder'=> 'mm/dd/yyyy' ,'id'=>'datepicker-autoclose'
                       ]) !!}
            <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
        </div><!-- input-group -->
    </div>
</div>


<div>
    <button class="btn btn-success" type="button" x-on:click="addItem">اضافة صنف</button>
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
            <th>الكمية بالبرنامج</th>
            <th>الكمية الفعلية</th>
            <th>الزيادة / العجز</th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody>
        <template x-for="(row_product,i) in row_products">

            <tr x-data=""
                x-init="()=>{
            $watch('row_product.product_id', product_id =>{
             let selected_product= products.find((product)=>product.id==product_id)

             row_product.storage_quantity=selected_product.quantity;
            })
            $watch('row_product.exists_quantity', exists_quantity =>{
             row_product.difference=  exists_quantity - row_product.storage_quantity ;
            })

            }">

                {{--            <tr x-data=""--}}
                {{--                x-init="$watch('row_product.product_id', product_id =>{--}}
                {{--             let selected_product= products.find((product)=>product.id==product_id)--}}
                {{--             row_product.buying_price=selected_product.buying_price;--}}
                {{--            })">--}}
                <td x-text="i+1"></td>
                <td>
                    <select :name="`products[${i}][product_id]`" class="form-control "
                            x-model="row_product.product_id"
                    >
                        <option selected>اختر الصنف</option>
                        <template x-for="product in products" :key="product.id">

                            <option x-bind:value="product.id" x-text="product.name"
                                    :selected="row_product.product_id==product.id">
                            </option>
                        </template>
                    </select>
                </td>

                <td>
                    <input type="number" class="form-control" placeholder="الكمية بالبرنامج"
                           :name="`products[${i}][storage_quantity]`" readonly
                           x-model="row_product.storage_quantity"
                    >
                </td>

                <td>
                    <input type="number" class="form-control" placeholder="الكمية الفعلية"
                           :name="`products[${i}][exists_quantity]`"
                           x-model="row_product.exists_quantity"
                    >
                </td>
                <td>
                    <input type="number" class="form-control" placeholder="الزيادة / العجز"
                           x-bind:name="`products[${i}][difference]`"
                           x-model="row_product.difference"
                              readonly
                    >
                </td>
                <td>
                    <button class="btn btn-danger" type="button" x-on:click="deleteItem(i)">حذف</button>
                </td>
            </tr>

        </template>
        </tbody>
    </table>
</div>

<br>
<br>
<br>
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
