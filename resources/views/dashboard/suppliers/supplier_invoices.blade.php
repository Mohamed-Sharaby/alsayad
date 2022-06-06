<div class="portlet fadeIn">
    <div class="portlet-heading bg-purple">
        <h3 class="portlet-title">
            فواتير المورد / {{$supplier->name}}
        </h3>
        <div class="portlet-widgets">
            <a href="javascript:;" data-toggle="reload"><i
                    class="zmdi zmdi-refresh"></i></a>
            <a data-toggle="collapse" data-parent="#accordion1" href="#details2"><i
                    class="zmdi zmdi-minus"></i></a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="details2" class="panel-collapse collapse in">
        <div class="portlet-body">

            <table class="table table-bordered table-responsive table-striped">
                @if(count($supplier->storageInvoices) > 0)
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> رقم الفاتورة</th>
                        <th>التفاصيل</th>
                        <th>الحالة</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($supplier->storageInvoices as $index => $invoice)
                        <tr>
                            <td> {{$index+1}}  </td>
                            <td> {{$invoice->code}}  </td>
                            <td>
                                <a href="{{route('admin.storage-invoices.show',$invoice->id)}}"
                                   target="_blank">{{$invoice->code}}</a>
                            </td>
                            <td>
                                {{$invoice->status}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <p class="text-center">لا يوجد فواتير</p>
                @endif
            </table>
        </div>
    </div>
</div>
