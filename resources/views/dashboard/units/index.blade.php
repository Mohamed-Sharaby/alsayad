@extends('dashboard.layouts.layout')
@section('title','الوحدات ')

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
                            @can('Create Units')
                                <a href="{{route('admin.units.create')}}"
                                   class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة وحدة
                                    جديدة</a>
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
                                @foreach($units as $index => $unit)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$unit->name}}</td>
                                        <td class="text-center">
                                            @can('Edit Units')
                                                <form
                                                    action="{{ route('admin.active', ['id' => $unit->id, 'type' => 'Unit']) }}"
                                                    style="display: inline;"
                                                    method="post">@csrf
                                                    <button type="submit"
                                                            class="btn-icon waves-effect {{ $unit->is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $unit->is_active ? 'مفعل ' : ' معطل' }}</button>
                                                </form>

                                                <a href="{{route('admin.units.edit',$unit->id)}}"
                                                   class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                                                        class="fa fa-edit"></i></a>
                                            @endcan

                                            @can('Delete Units')
                                                <button data-url="{{route('admin.units.destroy',$unit->id)}}"
                                                        data-name="{{$unit->name}}"
                                                        class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete"
                                                        title="Delete">
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
