<td class="text-center">
    @can('Edit Suppliers')
        <form
            action="{{ route('admin.active', ['id' => $model->id, 'type' => 'Supplier']) }}"
            style="display: inline;"
            method="post">@csrf
            <button type="submit"
                    class="btn-icon waves-effect {{ $model->is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $model->is_active ? 'مفعل ' : ' معطل' }}</button>
        </form>
    @endcan

    <a href="{{route('admin.suppliers.show',$model->id)}}"
       title="التفاصيل"
       class="btn-icon waves-effect btn btn-info btn-sm ml-2 rounded-circle"><i
            class="fa fa-eye"></i></a>

    @can('Edit Suppliers')
        <a href="{{route('admin.suppliers.edit',$model->id)}}"
           title="التفاصيل"
           class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                class="fa fa-edit"></i></a>
    @endcan

    @can('Delete Suppliers')
        <button data-url="{{route('admin.suppliers.destroy',$model->id)}}"
                data-name="{{$model->name}}"
                class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete"
                title="حذف">
            <i class="fa fa-trash"></i>
        </button>
    @endcan

</td>
