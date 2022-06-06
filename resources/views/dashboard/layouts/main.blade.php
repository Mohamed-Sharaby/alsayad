@extends('dashboard.layouts.layout')
@section('title','مطعم الصياد')

@section('content')
    <div class="row" style="margin-top: 10px!important;">

        @can('Show Roles')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.roles.index')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white">الصلاحيات والمناصب</h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="fa fa-balance-scale fa-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\Spatie\Permission\Models\Role::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('Show Admins')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.admins.index')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white">المستخدمين </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="fa fa-life-ring fa-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Admin::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan


        @can('Show Clients')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.clients.index')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white">العملاء </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="fa fa-users fa-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Client::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('Show Categories')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.categories.index')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white">الاقسام </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="zmdi zmdi-input-composite zmdi-hc-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Category::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

        @can('Show Materials')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.materials.index')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white"> المواد الخام</h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="fa fa-recycle fa-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Product::materials()->count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

        @can('Show Products')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.products.index')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white"> الاصناف</h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="fa fa-recycle fa-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Product::isProduct()->count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

        @can('Show Suppliers')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.suppliers.index')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white">الموردين </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="fa fa-rotate-left fa-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Supplier::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

        @can('Show StorageInvoices')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.expenses.index')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white"> فواتير الموردين </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="fa fa-recycle fa-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\StorageInvoice::in()->whereNotNull('supplier_id')->count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan


        @can('Show RestaurantInvoices')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.restaurant-invoices.index')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white">اذونات الصرف </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="zmdi zmdi-collection-folder-image zmdi-hc-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\StorageInvoice::out()->count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

        @can('Show Settings')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.settings.index')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white">الاعدادات </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="zmdi zmdi-tune zmdi-hc-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Setting::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

        @can('Show SalesInvoices')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.sales.index')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white">فواتير البيع </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="zmdi zmdi-local-grocery-store zmdi-hc-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Sale::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan


        @can('Create SalesInvoices')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.sales.create')}}">
                    <div class="card-box home-card ">
                        <h4 class="header-title m-t-0 m-b-30 text-white"> اضافة فاتورة بيع </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="zmdi zmdi-plus zmdi-hc-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"></h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

    </div>
    <!-- end row -->


@endsection

