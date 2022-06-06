<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
        data-target="#item{{$payroll->id}}">عرض التفاصيل
</button>
<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" id="item{{$payroll->id}}"
     tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">
                    تفاصيل المرتب <span
                        class="badge badge-success">{{$payroll->date }}</span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 ">
                        <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>التاريخ</th>
                                <th>النوع</th>
                                <th>المبلغ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $date = Carbon\Carbon::parse($payroll->date);
                            @endphp
                            @foreach(\App\Models\Payroll::whereAdminId($payroll->admin_id)->whereMonth('date', $date->month)->get() as $index => $item)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$item->date}}</td>
                                    <td>{{__($item->type)}}</td>
                                    <td>{{$item->amount}}</td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
