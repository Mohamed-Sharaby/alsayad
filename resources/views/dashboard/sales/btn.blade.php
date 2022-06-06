<td class="text-center">
    @can('Edit SalesInvoices')
        @if($model->status == 'unpaid' or $model->status == 'partially' )
            <a href="{{route('admin.getSalesPaidView',$model->id)}}"
               title="تسديد"
               class="btn-icon waves-effect btn btn-success btn-sm ml-2 rounded-circle"> تسديد</a>
        @endif
    @endif

    <a href="{{route('admin.sales.show',$model->id)}}"
       title="التفاصيل"
       class="btn-icon waves-effect btn btn-info btn-sm ml-2 rounded-circle">
        <i class="fa fa-eye"></i>
    </a>

    <a href="{{route('printInvoice',$model->uuid)}}"
       title="طباعة" target="_blank"
       class="btn-icon waves-effect btn btn-purple btn-sm ml-2 rounded-circle">
        <i class="fa fa-print"></i>
    </a>

    {{--    @can('Edit SalesInvoices')--}}
    {{--        <a href="{{route('admin.sales.edit',$model->id)}}"--}}
    {{--           title="تعديل"--}}
    {{--           class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i--}}
    {{--                class="fa fa-edit"></i>--}}
    {{--        </a>--}}
    {{--    @endcan--}}

    {{--    @can('Delete SalesInvoices')--}}
    {{--        <button data-url="{{route('admin.sales.destroy',$model->id)}}"--}}
    {{--                data-name="{{$model->code}}"--}}
    {{--                class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete"--}}
    {{--                title="حذف">--}}
    {{--            <i class="fa fa-trash"></i>--}}
    {{--        </button>--}}
    {{--    @endcan--}}
</td>
