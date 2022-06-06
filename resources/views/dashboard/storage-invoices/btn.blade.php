<td class="text-center">
    @can('Edit StorageInvoices')
        @if($model->is_finished == false or $model->remaining != 0 )
            {{--        @include('dashboard.storage-invoices.paid_modal')--}}
            <a href="{{route('admin.getPaidView',$model->id)}}"
               title="تسديد"
               class="btn-icon waves-effect btn btn-success btn-sm ml-2 rounded-circle"> تسديد</a>
        @endif
    @endcan

    <a href="{{route('admin.storage-invoices.show',$model->id)}}"
       title="التفاصيل"
       class="btn-icon waves-effect btn btn-info btn-sm ml-2 rounded-circle"><i
            class="fa fa-eye"></i></a>

    @can('Edit StorageInvoices')
        @if(!is_null($model->supplier_id))
            <a href="{{route('admin.storage-invoices.edit',$model->id)}}"
               title="تعديل"
               class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                    class="fa fa-edit"></i>
            </a>
        @endif
    @endcan

    @can('Delete StorageInvoices')
        <button data-url="{{route('admin.storage-invoices.destroy',$model->id)}}"
                data-name="{{$model->code}}"
                class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete"
                title="حذف">
            <i class="fa fa-trash"></i>
        </button>
    @endcan

</td>
