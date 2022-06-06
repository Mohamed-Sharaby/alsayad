@extends('dashboard.layouts.layout')
@section('title',' تعديل بند مرتب  ')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.payrolls.index',['admin'=>$payroll->admin_id])}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                          مرتب الموظف {{$payroll->admin->name}}   </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="header-title m-t-0 m-b-30">
                                تعديل بند مرتب
                                <span class="badge badge-info">{{$payroll->admin->name}}</span>
                            </h4>

                            {!! Form::model($payroll,['route'=>['admin.payrolls.update',$payroll->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                            @include('dashboard.payrolls.form')
                            {!! Form::close() !!}
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div><!-- end col -->
    </div>

@endsection
