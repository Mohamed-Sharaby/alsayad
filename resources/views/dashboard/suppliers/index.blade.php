@extends('dashboard.layouts.layout')
@section('title','الموردين ')

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
                            @can('Create Suppliers')
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <a href="{{route('admin.suppliers.create')}}"
                                       class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة مورد
                                        جديد</a>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            @endcan

                            {{$dataTable->table(['class'=>'table table-striped table-bordered text-center'])}}
                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection
@include('dashboard.layouts.datatables_scripts',['yajra'=>true])
