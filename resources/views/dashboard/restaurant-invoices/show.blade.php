@extends('dashboard.layouts.layout')
@section('title','تفاصيل الفاتورة رقم  '.' '.$restaurantInvoice->code)

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.restaurant-invoices.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        اذونات الصرف   للمطعم </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">


                            <div class="portlet fadeIn">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        تفاصيل الفاتورة / {{$restaurantInvoice->code}}
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
                                                <th>التاريخ</th>
                                                <td>  {{$restaurantInvoice->date->toDateString()}} </td>

                                                <th> الاجمالى</th>
                                                <td>  {{number_format($restaurantInvoice->total,2)}} </td>
                                            </tr>
                                            <tr>
                                                <th>عدد الاصناف</th>
                                                <td>  {{count($restaurantInvoice->storageInvoiceItems)}} </td>
                                            </tr>
                                            <tr>
                                                <th>ملاحظات</th>
                                                <td>  {{$restaurantInvoice->notes}} </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                           @include('dashboard.restaurant-invoices.invoice_products')


                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection




