<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{route('admin.main')}}" class="waves-effect"><i class="zmdi zmdi-home"></i>
                        <span> الرئيسية </span> </a>
                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-tasks"></i>
                        <span> الادارة </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('admin.roles.*')
                                                                || request()->routeIs('admin.admins.*')
                                                                || request()->routeIs('admin.sallaries.*')
                                                                ?  "display: block;" : '' }}">
                        @can('Show Roles')
                            <li>
                                <a href="{{route('admin.roles.index')}}"> الصلاحيات
                                    والمناصب</a>
                            </li>
                        @endcan

                        @can('Show Admins')
                            <li><a href="{{route('admin.admins.index')}}"> الموظفين</a></li>
                            <li><a href="{{route('admin.cashiers.index')}}"> أجهزة الكاشير</a></li>
                            <li><a href="{{route('admin.receiving.index')}}"> سجل عمليات تسليم الخزنة </a></li>
                        @endcan
                    </ul>
                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-reorder"></i>
                        <span> النظام </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('admin.clients.*')
                                                                || request()->routeIs('admin.units.*')
                                                                || request()->routeIs('admin.cookings.*')
                                                                || request()->routeIs('admin.categories.*')
                                                                || request()->routeIs('admin.expense-items.*')
                                                                || request()->routeIs('admin.expenses.*')
                                                                || request()->routeIs('admin.materials.*')
                                                                || request()->routeIs('admin.products.*')
                                                                ?  "display: block;" : '' }}">
                        @can('Show Clients')
                            <li><a href="{{route('admin.clients.index')}}">
                                    <i class="fa fa-users"></i>
                                    العملاء</a></li>
                        @endcan

                        @can('Show Units')
                            <li><a href="{{route('admin.units.index')}}">
                                    <i class="zmdi zmdi-camera-alt"></i>
                                    الوحدات</a></li>
                        @endcan
                        @can('Show Cooking')
                            <li><a href="{{route('admin.cookings.index')}}">
                                    <i class="zmdi zmdi-equalizer"></i>
                                    أنواع الطبخ</a></li>
                        @endcan
                        @can('Show Categories')
                            <li><a href="{{route('admin.categories.index')}}">
                                    <i class="zmdi zmdi-grid"></i> الاقسام </a></li>
                        @endcan

                        @can('Show ExpensesItems')
                            <li><a href="{{route('admin.expense-items.index')}}">
                                    <i class="zmdi zmdi-money-box"></i> بنود المصروفات </a></li>
                        @endcan

                        @can('Show Expenses')
                            <li><a href="{{route('admin.expenses.index')}}">
                                    <i class="zmdi zmdi-money-box"></i> عمليات الصرف </a></li>
                        @endcan

                        @can('Show Materials')
                            <li>
                                <a href="{{route('admin.materials.index')}}">
                                    <i class="zmdi zmdi-plus-box"></i> المواد الخام </a>
                            </li>
                        @endcan

                        @can('Show Products')
                            <li>
                                <a href="{{route('admin.products.index')}}">
                                    <i class="zmdi zmdi-plus-box"></i> الاصناف </a>
                            </li>
                        @endcan

                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-settings-square"></i>
                        <span> الموردين </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('admin.suppliers.*')
                                                                || request()->routeIs('admin.storage-invoices.*')
                                                                ?  "display: block;" : '' }}">
                        @can('Show Suppliers')
                            <li><a href="{{route('admin.suppliers.index')}}">
                                    <i class="fa fa-users"></i>
                                    الموردين</a></li>
                        @endcan

                        @can('Show StorageInvoices')
                            <li>
                                <a href="{{route('admin.storage-invoices.index')}}" class="waves-effect"><i
                                        class="zmdi zmdi-settings"></i> <span> فواتير الشراء </span> </a>
                            </li>
                        @endcan
                    </ul>
                </li>


                @can('Show RestaurantInvoices')
                    <li>
                        <a href="{{route('admin.restaurant-invoices.index')}}" class="waves-effect"><i
                                class="fa fa-recycle"></i> <span>   التوريد ( اذونات الصرف ) </span> </a>
                    </li>
                @endcan

                @can('Show Inventory')
                    <li>
                        <a href="{{route('admin.inventories.index')}}" class="waves-effect"><i
                                class="fa fa-calculator"></i> <span>الجرد</span> </a>
                    </li>
                @endcan

                @can('Show SalesInvoices')
                    <li>
                        <a href="{{route('admin.sales.index')}}" class="waves-effect"><i
                                class="fa fa-cart-plus"></i> <span>فواتير المبيعات</span> </a>
                    </li>
                @endcan


                @can('Show Settings')
                    <li>
                        <a href="{{route('admin.settings.index')}}" class="waves-effect"><i
                                class="zmdi zmdi-tune"></i> <span> الاعدادات </span> </a>
                    </li>
                @endcan

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-repeat"></i>
                        <span> التقارير </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="{{ request()->routeIs('admin.suppliers.*')
                                                                || request()->routeIs('admin.storage-invoices.*')
                                                                ?  "display: block;" : '' }}">

                        <li>
                            <a href="{{route('admin.getSalesReport')}}">
                                <i class="fa fa-users"></i>
                                تقرير المبيعات</a>
                        </li>

                        <li>
                            <a href="{{route('admin.getExpensesReport')}}" class="waves-effect"><i
                                    class="zmdi zmdi-money"></i> <span>  تقرير المصروفات   </span> </a>
                        </li>
                        <li>
                            <a href="{{route('admin.inventories.index')}}" class="waves-effect"><i
                                    class="fa fa-calculator"></i> <span>تقارير الجرد</span> </a>
                        </li>
                        <li>
                            <a href="{{route('admin.getTaxReport')}}" class="waves-effect"><i
                                    class="fa fa-calculator"></i> <span>تقرير القيمة المضافة</span> </a>
                        </li>

                        <li>
                            <a href="{{route('admin.getSoldProductsReport')}}" class="waves-effect"><i
                                    class="zmdi zmdi-money"></i> <span>  تقرير الأصناف   </span> </a>
                        </li>

                        <li>
                            <a href="{{route('admin.getDailyReport')}}" class="waves-effect"><i
                                    class="zmdi zmdi-money"></i> <span>  تقرير صافى الدخل ليوم معين </span> </a>
                        </li>
                        <li>
                            <a href="{{route('admin.getClientReport')}}" class="waves-effect"><i
                                    class="fa fa-user-circle"></i> <span>  تقرير حساب عميل  </span> </a>
                        </li>


                    </ul>
                </li>


            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->
