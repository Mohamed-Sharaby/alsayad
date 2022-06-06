@extends('dashboard.layouts.layout')
@section('title',' عمليات الصرف ')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            @include('dashboard.layouts.status')
                            @can('Create Expenses')
                                <a href="{{route('admin.expenses.create')}}"
                                   class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة عملية
                                    صرف
                                    جديدة</a>
                            @endcan
                            <br>
                            <br>
                            @include('dashboard.expenses.filter_expenses')
                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>التاريخ</th>
                                    <th>بند المصروفات</th>
                                    <th>المبلغ</th>
                                    <th>ملاحظات</th>
                                    <th class="text-center">العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($expenses as $index => $expense)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$expense->date->format('Y-m-d')}}</td>
                                        <td>{{$expense->expenseItem->name}}</td>
                                        <td>{{number_format($expense->amount,2)}}</td>
                                        <td>{{$expense->notes}}</td>
                                        <td class="text-center">
                                            @can('Edit Expenses')
                                                <a href="{{route('admin.expenses.edit',$expense->id)}}"
                                                   class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                                                        class="fa fa-edit"></i></a>
                                            @endcan

                                            @can('Delete Expenses')
                                                <button data-url="{{route('admin.expenses.destroy',$expense->id)}}"
                                                        data-name="{{$expense->name}}"
                                                        class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete"
                                                        title="حذف">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endcan
                                        </td>
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
