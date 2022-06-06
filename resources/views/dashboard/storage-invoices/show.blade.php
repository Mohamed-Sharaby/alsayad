@extends('dashboard.layouts.layout')
@section('title','تفاصيل الفاتورة رقم  '.' '.$storageInvoice->code)

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.storage-invoices.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        فواتير الشراء </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">


                            <div class="portlet fadeIn">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        تفاصيل الفاتورة / {{$storageInvoice->code}}
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
                                                <th> اسم المورد</th>
                                                <td>  {{$storageInvoice->supplier->name ?? ''}} </td>

                                                <th>رقم الفاتورة لدى المورد</th>
                                                <td>  {{$storageInvoice->supplier_invoice_code}} </td>
                                            </tr>

                                            <tr>
                                                <th>التاريخ</th>
                                                <td>  {{$storageInvoice->date->toDateString()}} </td>

                                                <th> الاجمالى</th>
                                                <td>  {{number_format($storageInvoice->total,2)}} </td>
                                            </tr>
                                            <tr>
                                                <th> المسدد</th>
                                                <td>  {{number_format($storageInvoice->received,2)}} </td>

                                                <th> المتبقى</th>
                                                <td>  {{number_format($storageInvoice->remaining,2)}} </td>
                                            </tr>
                                            <tr>
                                                <th> الحالة</th>
                                                <td>  {{ $storageInvoice->status }} </td>

                                                <th> ملاحظات</th>
                                                <td>  {{$storageInvoice->notes}} </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            @include('dashboard.storage-invoices.invoice_products')
                            @include('dashboard.storage-invoices.transactions')


                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection




