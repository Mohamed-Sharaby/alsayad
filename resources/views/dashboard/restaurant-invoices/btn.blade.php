<td class="text-center">

    <a href="{{route('admin.restaurant-invoices.show',$model->id)}}"
       title="التفاصيل"
       class="btn-icon waves-effect btn btn-info btn-sm ml-2 rounded-circle"><i
            class="fa fa-eye"></i></a>

    @can('Edit RestaurantInvoices')
        <a href="{{route('admin.restaurant-invoices.edit',$model->id)}}"
           title="تعديل"
           class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                class="fa fa-edit"></i>
        </a>
    @endcan

    @can('Delete RestaurantInvoices')
        <button data-url="{{route('admin.restaurant-invoices.destroy',$model->id)}}"
                data-name="{{$model->code}}"
                class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete"
                title="حذف">
            <i class="fa fa-trash"></i>
        </button>
    @endcan
</td>
