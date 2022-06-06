@php($payroll= $payroll
    ??
[
'admin' =>$admin,
'date'=>null,
'type'=>null,
'amount'=>null,
'notes'=>null,
]
)
<div x-data='form' x-init="
$watch('type',value=>{
getAdds()
if(value=='salary'){amount=admin.salary}
});
$watch('date',value=>getAdds())
">

    <div class="form-group row text-center">
        <div class="alert alert-danger" x-show="has_paid_salary">
            تم تسديد الراتب مسبقا
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">التاريخ </label>
        <div class="col-md-4">
            {!! Form::date('date', null,[
                           'class' =>'form-control '.($errors->has('date') ? ' is-invalid' : null),
                           'placeholder'=> 'التاريخ ' , 'x-model'=>'date'
                           ]) !!}
            @error('date')
            <div class="invalid-feedback" style="color: #ef1010">
                {{ $message }}
            </div>
            @enderror
        </div>


        <div class="form-group row">
            <label class="col-md-2 control-label">النوع </label>
            <div class="col-md-4">
                {!! Form::select('type',bonusTypes(), null,
        ['class' =>'form-control '.($errors->has('type') ? ' is-invalid' : null),'placeholder'=>'اختر' , 'x-model'=>'type' ]) !!}
                @error('type')
                <div class="invalid-feedback" style="color: #ef1010">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <input type="hidden" name="admin_id" value="{{$payroll['admin']['id']}}">

    <div class="form-group row">
        <label class="col-md-2 control-label">المبلغ </label>
        <div class="col-md-4">
            {!! Form::number('amount',  null,[
                           'class' =>'form-control '.($errors->has('amount') ? ' is-invalid' : null),
                           'placeholder'=> 'المبلغ ' ,'step'=>'0.01',
                            'x-model'=>'amount',
                            ":readonly"=>"type=='salary'"
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
               'placeholder'=> 'ملاحظات' ,  'x-model'=>'notes'
               ]) !!}
            @error('notes')
            <div class="invalid-feedback" style="color: #ef1010">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="badge badge-primary w-100 " style="width: 100%;display: flex;justify-content: center;color: white;">
        <h5 style="margin: 1rem 1rem;color:inherit;">اجمالى الراتب المستحق  : </h5>
        <h5 style="margin: 1rem 1rem;color:  inherit;" x-text="TotalPaid"></h5>
    </div>

    <div>
        <table class="table table-responsive table-hover table-stripe">
            <thead>
            <tr>
                <th>#</th>
                <th>المبلغ</th>
                <th> النوع</th>
                <th>التاريخ</th>
            </tr>
            </thead>
            <tbody>
            <template x-for="(item,i) in adds">
                <tr>
                    <td x-text="i+1"></td>
                    <td>
                        <p x-text="item.amount"></p>
                    </td>
                    <td>
                        <p x-text=" item.type === 'increase' ? 'مكافأة' : item.type === 'deduction' ? 'خصم' : 'مرنب' "></p>
                    </td>
                    <td>
                        <p x-text="item.date"></p>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>

    </div>

    <div class="text-center form-group row">
        <button type="submit"
                class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md"
                :disabled="has_paid_salary">
            حفظ
        </button>
    </div>


</div>
@push('scripts')

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('form', () => {
                    return {
                        ...@json($payroll),
                        adds: [],
                        has_paid_salary: false,
                        total_increases: 0,
                        total_deduction: 0,
                        getAdds() {
                            if (this.date != null && this.type != null) {
                                axios.get(`/get/adds?date=${this.date}&admin_id=${this.admin.id}`
                                ).then(({data}) => {
                                    this.adds = data.details
                                    this.has_paid_salary = data.has_paid_salary
                                    this.total_increases = parseFloat(data.total_increases)
                                    this.total_deduction = parseFloat(data.total_deduction)
                                })
                            }
                        },
                        get TotalPaid() {
                            return parseFloat(this.admin.salary) + this.total_increases - this.total_deduction
                        }
                    }
                }
            )
        })
    </script>
@endpush
