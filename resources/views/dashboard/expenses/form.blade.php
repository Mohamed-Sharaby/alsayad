<div class="form-group row">
    <label class="col-md-2 control-label">التاريخ  </label>
    <div class="col-md-4">
        {!! Form::date('date', isset($expense) ?  $expense->date : now(),[
                       'class' =>'form-control '.($errors->has('date') ? ' is-invalid' : null),
                       'placeholder'=> 'التاريخ ' ,
                       ]) !!}
        @error('date')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
    <label class="col-md-2 control-label">بند المصروفات  </label>
    <div class="col-md-4">
        {!! Form::select('expense_item_id',$expenseItems,isset($expense) ? $expense->expense_item_id : null,
['class' =>'form-control '.($errors->has('expense_item_id') ? ' is-invalid' : null)  ]) !!}
        @error('expense_item_id')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 control-label">المبلغ  </label>
    <div class="col-md-4">
        {!! Form::number('amount', isset($expense) ?  $expense->amount : null,[
                       'class' =>'form-control '.($errors->has('amount') ? ' is-invalid' : null),
                       'placeholder'=> 'المبلغ ' ,'step'=>'0.01'
                       ]) !!}
        @error('amount')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
    <label class="col-md-2 control-label">ملاحظات</label>
    <div class="col-md-4">
        {!! Form::textarea('notes',null,['cols'=> '30','rows'=>3,
           'class' =>'form-control'.($errors->has('notes') ? ' is-invalid' : null),
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
