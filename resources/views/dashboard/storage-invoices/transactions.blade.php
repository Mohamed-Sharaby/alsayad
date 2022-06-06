<div class="portlet fadeIn">
    <div class="portlet-heading bg-purple">
        <h3 class="portlet-title">
            سجل معاملات الفاتورة / {{$storageInvoice->code}}
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
                @if(count($storageInvoice->transactions) > 0)
                <thead>
                <tr>
                    <th>#</th>
                    <th>المبلغ المسدد</th>
                    <th>تاريخ السداد</th>
                </tr>
                </thead>

                <tbody>
                @foreach($storageInvoice->transactions as $index => $item)
                    <tr>
                        <td> {{$index+1}}  </td>
                        <td>{{number_format($item->amount,2)}}</td>
                        <td>{{$item->paid_date->toDateString()}}</td>
                    </tr>
                @endforeach
                </tbody>
                @else
                <p class="text-center">لا يوجد </p>
                    @endif
            </table>
        </div>
    </div>
</div>
