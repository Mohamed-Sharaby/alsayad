@extends('dashboard.layouts.layout')
@section('title','سجل عمليات راتب الموظف   '.' '.$sallary->admin->name)

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.payrolls.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        الرواتب </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">


                            <div class="portlet fadeIn">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                          سجل عمليات راتب الموظف / {{$sallary->admin->name}}
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
                                                    <th>التاريخ</th>
                                                    <th>النوع</th>
                                                    <th>المبلغ</th>
{{--                                                    <th>صافى المرتب</th>--}}
                                                    <th>الملاحظات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($sallary->admin->bonuses  as $item)

                                                    <tr>
                                                        <td>  {{$item->date->toDateString()}} </td>
                                                        <td>  {{__($item->type)}} </td>
                                                        <td>  {{number_format($item->amount,2)}} </td>
{{--                                                        <td>  {{ $sallary->main_salary + $item->amount}} </td>--}}
                                                        <td>  {{$item->notes}} </td>
                                                    </tr>

                                                @endforeach


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




