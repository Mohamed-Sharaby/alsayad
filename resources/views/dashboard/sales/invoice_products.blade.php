<div class="portlet fadeIn">
    <div class="portlet-heading bg-purple">
        <h3 class="portlet-title">
            أصناف الفاتورة / {{$sale->code}}
        </h3>
        <div class="portlet-widgets">
            <a href="javascript:;" data-toggle="reload"><i
                    class="zmdi zmdi-refresh"></i></a>
            <a data-toggle="collapse" data-parent="#accordion1" href="#details1"><i
                    class="zmdi zmdi-minus"></i></a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="details1" class="panel-collapse collapse in">
        <div class="portlet-body">
            <table class="table table-bordered table-responsive table-striped">
                @if(count($sale->items) > 0)
                <thead>
                <tr>
                    <th>#</th>
                    <th>اسم الصنف</th>
                    <th>الكمية</th>
                    <th>سعر الصنف فى الفاتورة</th>
                    <th>اجمالى الصنف</th>
                </tr>
                </thead>

                <tbody>
                @foreach($sale->items as $index => $item)
                    <tr>
                        <td> {{$index+1}}  </td>
                        <td>
                            <a href="{{route('admin.products.show',$item->product->id)}}"
                               target="_blank">{{$item->product->name}}
                            </a>
                        </td>
                        <td>{{$item->quantity}}</td>
                        <td>{{number_format($item->product_price,2)}}</td>
                        <td>{{number_format($item->product_price * $item->quantity,2)}}</td>
                    </tr>
                @endforeach
                </tbody>
                @else
                <p class="text-center">لا يوجد اصناف</p>
                    @endif
            </table>
        </div>
    </div>
</div>
