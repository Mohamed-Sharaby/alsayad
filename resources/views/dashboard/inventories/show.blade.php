@extends('dashboard.layouts.layout')
@section('title','تفاصيل الجرد    '.' '.$inventory->code)

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.inventories.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                          الجرد </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <div class="portlet fadeIn">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        تفاصيل الجرد / {{$inventory->code}}
                                    </h3>
                                    <div class="portlet-widgets">
                                        <a href="javascript:;" data-toggle="reload"><i
                                                class="zmdi zmdi-refresh"></i></a>
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#details7"><i
                                                class="zmdi zmdi-minus"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="details7" class="panel-collapse collapse in">
                                    <div class="portlet-body">
                                        <table class="table table-bordered table-responsive table-striped">

                                            <tr>
                                                <th> تاريخ الجرد  </th>
                                                <td>  {{$inventory->date->toDateString()}}  </td>

                                                <th>القائم بالجرد</th>
                                                <td>  {{$inventory->createdBy->name}}  </td>
                                            </tr>
                                            <tr>
                                                <th>   ملاحظات</th>
                                                <td>  {{$inventory->notes}}  </td>
                                            </tr>




                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="portlet fadeIn">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        أصناف الجرد / {{$inventory->code}}
                                    </h3>
                                    <div class="portlet-widgets">
                                        <a href="javascript:;" data-toggle="reload"><i
                                                class="zmdi zmdi-refresh"></i></a>
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#details"><i
                                                class="zmdi zmdi-minus"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="details" class="panel-collapse collapse in">
                                    <div class="portlet-body">

                                        <table class="table table-bordered table-responsive table-striped">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>الصنف</th>
                                                    <th>الكمية بالبرنامج</th>
                                                    <th>الكمية الفعلية</th>
                                                    <th>الزيادة /  العجز  </th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($inventory->inventoryItems as $index => $item)
                                                    <tr>
                                                        <td>{{$index +1}}</td>
                                                        <td>
                                                            <a href="{{route('admin.products.show',$item->product->id)}}" target="_blank">{{$item->product->name}}</a>
                                                        </td>
                                                        <td>{{$item->storage_quantity}}</td>
                                                        <td>{{$item->exists_quantity}}</td>
                                                        <td>{{$item->storage_quantity - $item->exists_quantity}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection




