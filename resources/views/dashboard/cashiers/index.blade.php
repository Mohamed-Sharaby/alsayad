@extends('dashboard.layouts.layout')
@section('title','اجهزة الكاشير ')

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

                                <a href="{{route('admin.cashiers.create')}}"
                                   class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة جهاز كاشير
                                     </a>

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
                                @foreach($cashiers as $index => $cashier)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$cashier->name}}</td>
                                        <td class="text-center">
                                                <a href="{{route('admin.cashiers.edit',$cashier->id)}}"
                                                   class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                                                        class="fa fa-edit"></i></a>

                                                <button data-url="{{route('admin.cashiers.destroy',$cashier->id)}}"
                                                        data-name="{{$cashier->name}}"
                                                        class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete"
                                                        title="حذف">
                                                    <i class="fa fa-trash"></i>
                                                </button>

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
