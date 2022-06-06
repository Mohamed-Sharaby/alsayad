<td class="text-center">
    @can('Edit Products')
        <form
            action="{{ route('admin.active', ['id' => $model->id, 'type' => 'Product']) }}"
            style="display: inline;"
            method="post">@csrf
            <button type="submit"
                    class="btn-icon waves-effect {{ $model->is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $model->is_active ? 'مفعل ' : ' معطل' }}</button>
        </form>
        @if($model->is_made)
            @if($model->made_in_order == 0)
            @if(is_null($model->productFactory))
                <a href="{{route('admin.products.getMadeView',$model->id)}}" title="تصنيع"
                   class="btn-icon waves-effect btn btn-purple btn-sm ml-2 rounded-circle">تصنيع</a>
            @endif
            @endif
        @endif
    @endcan

    <a href="{{route('admin.products.show',$model->id)}}" title="التفاصيل"
       class="btn-icon waves-effect btn btn-info btn-sm ml-2 rounded-circle"><i
            class="fa fa-eye"></i></a>


    @can('Edit Products')
        <a href="{{route('admin.products.edit',$model->id)}}" title="تعديل"
           class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                class="fa fa-edit"></i></a>
    @endcan


    @can('Delete Products')
        <button data-url="{{route('admin.products.destroy',$model->id)}}" data-name="{{$model->name}}"
                class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete" title="حذف">
            <i class="fa fa-trash"></i>
        </button>
    @endcan

</td>
