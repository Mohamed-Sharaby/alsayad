@extends('dashboard.layouts.layout')
@section('title','تفاصيل  فواتير العميل  '.' '.$client->name)

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.clients.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        العملاء </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <div class="portlet fadeIn">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        تفاصيل اجماليات بيع العميل -{{$client->name}}
                                    </h3>
                                    <div class="portlet-widgets">
                                        <a href="javascript:;" data-toggle="reload"><i
                                                class="zmdi zmdi-refresh"></i></a>
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#detailss"><i
                                                class="zmdi zmdi-minus"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="detailss" class="panel-collapse collapse in">
                                    <div class="portlet-body">
                                        <table class="table table-bordered table-responsive table-striped">
                                            <tr>
                                                <th> إجمالى الفواتير  </th>
                                                <td>  {{number_format($client->total_sales,2)}} </td>
                                            </tr>
                                            <tr>
                                                <th> إجمالى المسدد  </th>
                                                <td>  {{number_format($client->paid_sales,2)}} </td>
                                            </tr>
                                            <tr>
                                                <th> إجمالى المتبقى  </th>
                                                <td>  {{number_format($client->remaining_sales,2)}} </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet fadeIn">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        تفاصيل عمليات بيع العميل -{{$client->name}}
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
                                            @if(count($sales) > 0)
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>التاريخ</th>
                                                    <th>التفاصيل</th>
                                                    <th>الحالة</th>
                                                    <th>الاجمالى</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($sales as $index => $sale)
                                                    <tr>
                                                        <td> {{$index+1}}  </td>
                                                        <td> {{$sale->date->toDateString()}}  </td>
                                                        <td>
                                                            <a href="{{route('admin.sales.show',$sale->id)}}"
                                                               target="_blank">عرض تفاصيل الفاتورة
                                                            </a>
                                                        </td>
                                                        <td>{{__($sale->status)}}</td>
                                                        <td>{{number_format($sale->total,2)}}</td>
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
                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection




