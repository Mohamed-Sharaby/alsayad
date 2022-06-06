@extends('dashboard.layouts.layout')
@section('title','مرتب الموظف' . ' '.$admin->name)

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /

                    <a href="{{route('admin.admins.index')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الموظفين</a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            @include('dashboard.layouts.status')
                            @can('Create Salaries')
                                <a href="{{route('admin.payrolls.create',['admin'=>$admin->id])}}"
                                   class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة عملية
                                    جديدة</a>
                                <br>
                                <br>
                            @endcan
                            <br>
                            <br>
                            @include('dashboard.payrolls.current_month_payroll',['admin'=>$admin])
                            <br>
                            <br>
                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>التاريخ  </th>
                                    <th>النوع</th>
                                    <th>المبلغ  </th>
                                    <th>ملاحظات</th>
                                    <th>التفاصيل</th>
{{--                                    <th class="text-center">العمليات</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payrolls as $index => $payroll)

                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$payroll->date}}</td>
                                        <td>{{__($payroll->type)}}</td>
                                        <td>{{number_format($payroll->monthly_total,2)}}</td>
                                        <td>{{$payroll->notes}}</td>
                                        <td>
                                            @include('dashboard.payrolls.details')
                                        </td>
{{--                                        <td class="text-center">--}}
{{--                                            @can('Edit Salaries')--}}
{{--                                            <a href="{{route('admin.payrolls.edit',['payroll'=>$payroll->id])}}"--}}
{{--                                               class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle">--}}
{{--                                                <i class="fa fa-edit"></i></a>--}}
{{--                                            @endcan--}}

{{--                                            @can('Delete Salaries')--}}
{{--                                            <button data-url="{{route('admin.payrolls.destroy',$payroll->id)}}"--}}
{{--                                                    data-name="{{$payroll->name}}"--}}
{{--                                                    class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2--}}
{{--                                                     delete" title="حذف">--}}
{{--                                                <i class="fa fa-trash"></i>--}}
{{--                                            </button>--}}
{{--                                            @endcan--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection
@include('dashboard.layouts.datatables_scripts')
