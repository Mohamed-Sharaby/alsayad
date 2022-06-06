@extends('dashboard.layouts.layout')
@section('title','تقرير صافى الدخل ليوم معين')

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
                            <div class="row">
                                <div class="col-12 ">
                                    <form class="form-horizontal" method="get"
                                          action="{{route('admin.getDailyReport')}}">
                                        <div class="form-group row ">
                                            <div class="col-12 col-md-4">
                                                <label class="control-label" for="example-email">  التاريخ </label>
                                                <input type="date" class="form-control"
                                                       placeholder="mm/dd/yyyy" name="date" value="{{request('date')}}">
                                                @error('date')
                                                <div class="invalid-feedback" style="color: #ef1010">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="form-group row text-center">
                                            <button type="submit"
                                                    class="btn btn-success btn-block col-12 waves-effect waves-light ">
                                                بحث
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                            <table id="datatable-buttons" class="table table-bordered table-responsive table-striped">


                                <thead>
                                <tr>

                                    <th>اليوم</th>
                                    <th>المشتريات</th>
                                    <th>المصروفات</th>
                                    <th>المرتبات</th>
                                    <th>المبيعات</th>
                                    <th>صافى دخل اليوم</th>
                                </tr>
                                </thead>

                                <tbody>


                                <tr>
                                    <td>{{request('date')}}</td>
                                    <td>{{number_format($storage_invoices,2)}}</td>
                                    <td>{{number_format($expenses,2)}}</td>
                                    <td>{{number_format($payrolls,2)}}</td>
                                    <td>{{number_format($sales,2)}}</td>
                                    <td>{{number_format($sales - ($storage_invoices+$expenses+$payrolls),2)}}</td>
                                </tr>

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

