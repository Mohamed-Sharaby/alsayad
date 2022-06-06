@extends('dashboard.layouts.layout')
@section('title','تفاصيل المورد  '.' '.$supplier->name)

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.suppliers.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        الموردين </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">


                            <div class="portlet fadeIn">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        تفاصيل المورد / {{$supplier->name}}
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

                                            <tr>
                                                <th> الاسم  </th>
                                                <td>  {{$supplier->name}} </td>

                                                <th>الجوال</th>
                                                <td>  {{$supplier->phone}} </td>
                                            </tr>
                                            <tr>
                                                <th> المنطقة  </th>
                                                <td>  {{$supplier->area}} </td>

                                                <th>العنوان</th>
                                                <td>  {{$supplier->address}} </td>
                                            </tr>

                                            <tr>
                                                <th> ملاحظات</th>
                                                <td>  {{$supplier->notes}} </td>
                                            </tr>
                                            <tr>
                                                <th> اجمالى فواتير المورد</th>
                                                <td>  {{number_format($supplier->total_sales,2)}} </td>

                                                <th> اجمالى   المسدد</th>
                                                <td>  {{number_format($supplier->paid_sales,2)}} </td>
                                            </tr>
                                            <tr>
                                                <th> اجمالى   المتبقى </th>
                                                <td>  {{number_format($supplier->remaining_sales,2)}} </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                           @include('dashboard.suppliers.supplier_products')

                            @include('dashboard.suppliers.supplier_invoices')

                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection




