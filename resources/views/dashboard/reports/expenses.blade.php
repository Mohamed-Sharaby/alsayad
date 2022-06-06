@extends('dashboard.layouts.layout')
@section('title','تقرير المصروفات ')

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
                                          action="{{route('admin.getExpensesReport')}}">
                                        <div class="form-group row ">
                                            <div class="col-12 col-md-3">
                                                <label class="  control-label">  بند المصروفات</label>

                                                {!! Form::select('item',$expenseItems, request('item'),['class' =>'form-control '.($errors->has('item') ? ' is-invalid' : null)
                                                        ,'placeholder'=>'اختر البند'  ]) !!}
                                                @error('item')
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
                                    <th>بند المصروفات</th>
                                    <th>المبلغ</th>
                                    <th>ملاحظات</th>
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

