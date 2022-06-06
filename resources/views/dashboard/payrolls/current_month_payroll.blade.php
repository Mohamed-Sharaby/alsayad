<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
        data-target="#current_payroll">
    عرض الراتب المستحق لهذا الشهر
</button>
<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" id="current_payroll"
     tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">
                    تفاصيل راتب الموظف  <span
                        class="badge badge-success"> {{$admin->name}}</span>
                </h4>
            </div>
                <p class="">المرتب الاساسى : {{$admin->salary}}</p>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 ">
                        <table   class="table table-striped table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>التاريخ</th>
                                <th>النوع</th>
                                <th>المبلغ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Payroll::whereAdminId($admin->id)
                                            ->whereMonth('date', now()->month)->get() as $index => $item)
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
