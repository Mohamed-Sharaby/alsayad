<td class="text-center">

    <button class="btn btn-primary waves-effect waves-light btn-sm" data-toggle="modal"
            data-target="#item{{$model->id}}">التفاصيل
    </button>
    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-lg" id="item{{$model->id}}"
         tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                    <h4 class="modal-title" id="myLargeModalLabel">
                        تفاصيل العميل {{$model->name}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-responsive table-striped">
                                <tr>
                                    <th> المنطقة</th>
                                    <td>  {{$model->area}} </td>
                                </tr>
                                <tr>
                                    <th> العنوان</th>
                                    <td>  {{$model->address}} </td>
                                </tr>
                                <tr>
                                    <th> ملاحظات</th>
                                    <td>  {{$model->notes}} </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @can('Edit Clients')
    <form
        action="{{ route('admin.active', ['id' => $model->id, 'type' => 'Client']) }}"
        style="display: inline;"
        method="post">@csrf
        <button type="submit"
                class="btn-icon waves-effect {{ $model->is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $model->is_active ? 'مفعل ' : ' معطل' }}
        </button>
    </form>
    @endcan

    @if(count($model->sales) > 0)
        <a href="{{route('admin.client.sales',$model->id)}}" title="عمليات البيع"
           class="btn-icon waves-effect btn btn-purple btn-sm ml-2 rounded-circle"> عرض عمليات البيع</a>
    @endif

    @can('Edit Clients')
    <a href="{{route('admin.clients.edit',$model->id)}}" title="تعديل"
       class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
            class="fa fa-edit"></i></a>
@endcan

    @can('Delete Clients')
    <button data-url="{{route('admin.clients.destroy',$model->id)}}" data-name="{{$model->name}}"
            class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete" title="حذف">
        <i class="fa fa-trash"></i>
    </button>
    @endcan
</td>
