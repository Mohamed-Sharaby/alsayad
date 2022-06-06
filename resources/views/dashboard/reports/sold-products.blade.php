@extends('dashboard.layouts.layout')
@section('title','تقرير الأصناف ')

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
                                          action="{{route('admin.getSoldProductsReport')}}">
                                        <div class="form-group row ">
                                            <div class="col-12 col-md-3">
                                                <label class="  control-label">اختر الصنف   </label>
                                                {!! Form::select('product_id',products(), request('product_id'),['class' =>'form-control select2'  ]) !!}
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="control-label" for="example-email"> تاريخ من</label>
                                                <input type="date" class="form-control"
                                                       placeholder="mm/dd/yyyy" name="from" value="{{request('from')}}">
                                                @error('date')
                                                <div class="invalid-feedback" style="color: #ef1010">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <label class="control-label" for="example-email"> الى تاريخ </label>
                                                <input type="date" class="form-control"
                                                       placeholder="mm/dd/yyyy" name="to" value="{{request('to')}}">
                                                @error('to')
                                                <div class="invalid-feedback" style="color: #ef1010">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="control-label" > الغاء </label>
                                                <a href="{{route('admin.getSoldProductsReport')}}"
                                                   class="form-control btn btn-purple"> الغاء الفلتر</a>
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
                                        <th>#</th>
                                        <th>اسم الصنف</th>
                                        <th>التاريخ</th>
                                        <th>الكمية</th>
                                        <th>سعر الصنف</th>
                                        <th>الإجمالى</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($items as $index => $item)
                                        <tr>
                                            <td> {{$index+1}}  </td>
                                            <td>
                                                <a href="{{route('admin.products.show',$item->product->id)}}"
                                                   target="_blank">{{$item->product->name}}
                                                </a>
                                            </td>
                                            <td>{{$item->created_at->toDateString()}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{number_format($item->product_price,2)}}</td>
                                            <td>{{number_format($item->product_price * $item->quantity,2)}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="font-bold">الاجمالى</td>
                                        <td></td>
                                        <td></td>
                                        <td class="font-bold">{{$totalQuantity}}</td>
                                        <td></td>
                                        <td class="font-bold">{{number_format($totalPrice,2)}}</td>
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

