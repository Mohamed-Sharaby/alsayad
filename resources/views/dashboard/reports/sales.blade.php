@extends('dashboard.layouts.layout')
@section('title','تقرير المبيعات ')

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
                                          action="{{route('admin.getSalesReport')}}">
                                        <div class="form-group row ">
                                            <div class="col-12 col-md-4">
                                                <label class="control-label" for="example-email">من تاريخ </label>
                                                <input type="date" class="form-control"
                                                       placeholder="mm/dd/yyyy" name="from" value="{{request('from')}}">
                                                @error('from')
                                                <div class="invalid-feedback" style="color: #ef1010">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="control-label" for="example-email"> الى تاريخ </label>
                                                <input type="date" class="form-control"
                                                       placeholder="mm/dd/yyyy" name="to" value="{{request('to')}}">
                                                @error('to')
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

                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>التاريخ</th>
                                    <th>مسلسل الفاتورة</th>
                                    <th>العميل</th>
                                    <th>المبلغ</th>
                                    <th>التفاصيل</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach($invoices as $index => $invoice)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$invoice->date->toDateString()}}</td>
                                        <td>{{$invoice->code}}</td>
                                        <td>{{$invoice->client->name ?? 'عميل نقدى'}}</td>
                                        <td>{{number_format($invoice->total,2)}}</td>
                                        <td>
                                            <a href="{{route('admin.sales.show',$invoice->id)}}"
                                               class="btn-icon waves-effect btn btn-purple btn-sm ml-3 rounded-circle">
                                                التفاصيل </a>
                                        </td>

                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="font-bold">الاجمالى</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="font-bold">{{number_format($total,2)}}</td>
                                    <td></td>
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

