<div class="portlet fadeIn">
    <div class="portlet-heading bg-purple">
        <h3 class="portlet-title">
            أصناف المورد / {{$supplier->name}}
        </h3>
        <div class="portlet-widgets">
            <a href="javascript:;" data-toggle="reload"><i
                    class="zmdi zmdi-refresh"></i></a>
            <a data-toggle="collapse" data-parent="#accordion1" href="#details3"><i
                    class="zmdi zmdi-minus"></i></a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="details3" class="panel-collapse collapse in">
        <div class="portlet-body">
            <table class="table table-bordered table-responsive table-striped">
                @foreach($supplier->products as $index => $product)
                    <tr>
                        <th> {{$index+1}}  </th>
                        <td>
                            <a href="{{route('admin.products.show',$product->id)}}" target="_blank">{{$product->name}}</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
