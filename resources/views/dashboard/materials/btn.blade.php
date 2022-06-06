<td class="text-center">
    @can('Edit Materials')
        <form
            action="{{ route('admin.active', ['id' => $model->id, 'type' => 'Product']) }}"
            style="display: inline;"
            method="post">@csrf
            <button type="submit"
                    class="btn-icon waves-effect {{ $model->is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $model->is_active ? 'مفعل ' : ' معطل' }}</button>
        </form>

        <a href="{{route('admin.materials.edit',$model->id)}}"
           class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                class="fa fa-edit"></i></a>
    @endcan

    @can('Delete Materials')
        <button data-url="{{route('admin.materials.destroy',$model->id)}}" data-name="{{$model->name}}"
                class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete" title="Delete">
            <i class="fa fa-trash"></i>
        </button>
    @endcan

</td>
