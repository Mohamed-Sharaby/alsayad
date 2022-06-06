@extends('dashboard.layouts.layout')
@section('title','بنود المصروفات ')

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
                            @can('Create ExpensesItems')
                                <a href="{{route('admin.expense-items.create')}}"
                                   class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة بند
                                    مصروفات
                                    جديد</a>
                            @endcan
                            <br>
                            <br>

                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th class="text-center">العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($expenses as $index => $item)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td class="text-center">
                                            @can('Edit ExpensesItems')
                                                <a href="{{route('admin.expense-items.edit',$item->id)}}"
                                                   class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                                                        class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('Delete ExpensesItems')
                                                <button data-url="{{route('admin.expense-items.destroy',$item->id)}}"
                                                        data-name="{{$item->name}}"
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
