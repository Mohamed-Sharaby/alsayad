@extends('dashboard.layouts.layout')
@section('title','تفاصيل الفاتورة رقم  '.' '.$sale->code)

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.sales.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        فواتير المبيعات </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">


                            <div class="portlet fadeIn">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        تفاصيل الفاتورة / {{$sale->code}}
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

                                            <tr>
                                                <th> اسم العميل</th>
                                                <td>  {{$sale->client->name ?? 'عميل نقدى'}} </td>

                                                <th>التاريخ</th>
                                                <td>  {{$sale->date->toDateString()}} </td>
                                            </tr>

                                            <tr>
                                                <th> استخدام نقاط العميل</th>
                                                <td>  {{ $sale->is_points == 1 ? 'نعم' : 'لا' }} </td>

                                                <th>المبلغ المخصوم مقابل النقاط</th>
                                                <td>  {{ $sale->is_points == 1 ? $sale->points_paid : 'لا يوجد' }} </td>
                                            </tr>


                                            <tr>
                                                <th> الاجمالى</th>
                                                <td>  {{number_format($sale->total,2)}} </td>

                                                <th> المسدد</th>
                                                <td>  {{number_format($sale->received,2)}} </td>
                                            </tr>
                                            <tr>
                                                <th> المتبقى</th>
                                                @if($sale->is_points == 1)
                                                    <td>
                                        {{$sale->status == 'paid' ? '-' : number_format($sale->remaining-$sale->points_paid,2) }}
                                                    </td>
                                                @else
                                                    <td>  {{$sale->status == 'paid' ? '-' : number_format($sale->remaining,2) }} </td>
                                                @endif
                                                <th> الحالة</th>
                                                <td>  {{ __($sale->status) }} </td>
                                            </tr>
                                            <tr>
                                                <th> ملاحظات</th>
                                                <td>  {{$sale->notes}} </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            @include('dashboard.sales.invoice_products')
                            @include('dashboard.sales.transactions')

                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection




