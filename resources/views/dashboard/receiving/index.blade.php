@extends('dashboard.layouts.layout')
@section('title',' سجل عمليات تسليم الخزنة  ')

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

                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>رقم العملية</th>
                                    <th>التاريخ</th>
                                    <th>الساعة</th>
                                    <th>القائم بالعملية</th>
                                    <th>الرصيد قبل العملية</th>
                                    <th>الرصيد المسلم</th>
                                    <th>الرصيد المتبقى </th>
                                    {{--                                    <th>العمليات</th>--}}
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($records as $index => $record)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$record->created_at->toDateString()}}</td>
                                        <td>{{$record->created_at->format('h:i:s')}}</td>
                                        <td>{{$record->shift->admin->name}}</td>
                                        <td>{{number_format($record->total,2)}}</td>
                                        <td>{{number_format($record->delivered,2)}}</td>
                                        <td>{{number_format($record->remaining,2)}}</td>
                                        <td> </td>

{{--                                        <td class="text-center">--}}
{{--                                            <button data-url="{{route('admin.receiving.destroy',$record->id)}}"--}}
{{--                                                    data-name="{{ $record->name }}"--}}
{{--                                                    class="btn btn-danger rounded-circle btn-sm ml-2 delete"--}}
{{--                                                    title="Delete">--}}
{{--                                                <i class="fa fa-trash"></i>--}}
{{--                                            </button>--}}
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
