@extends('dashboard.layouts.layout')
@section('title','تفاصيل الصنف  '.' '.$product->name)

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.products.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        الاصناف </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">


                            <div class="portlet fadeIn">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        تفاصيل الصنف / {{$product->name}}
                                    </h3>
                                    <div class="portlet-widgets">
                                        <a href="javascript:;" data-toggle="reload"><i
                                                class="zmdi zmdi-refresh"></i></a>
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#details"><i
                                                class="zmdi zmdi-minus"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="details" class="panel-collapse collapse in">
                                    <div class="portlet-body">
                                        <table class="table table-bordered table-responsive table-striped">

                                            @if($product->type == 'made')
                                                <thead>
                                                <tr>
                                                    <th>اسم المادة الخام</th>
                                                    <th>الوحدة</th>
                                                    <th>كمية المادة الخام المستخدمة فى تصنيعه</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($product->productMaterials  as $material)

                                                    <tr>
                                                        <td>  {{$material->name}} </td>
                                                        <td>  {{$material->unit->name}} </td>
                                                        <td>  {{$material->pivot->quantity}} </td>
                                                    </tr>

                                                @endforeach
                                                </tbody>

                                                <tr>
                                                    <th> حالة التصنيع</th>
                                                    <td>
                                                        @if($product->made_in_order == 1)
                                                            يتم تصنيعه مع فاتورة البيع
                                                        @else
                                                            {{$product->productFactory ? 'تم التصنيع':'لم يتم التصنيع'}}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th> تكلفة التصنيع</th>
                                                    <td>  {{number_format($product->made_cost,2)}} </td>
                                                </tr>
                                                <tr>
                                                    <th> سعر البيع</th>
                                                    <td>  {{number_format($product->selling_price,2)}} </td>

                                                </tr>

                                                <tr>
                                                    <th> التكلفة النهائية</th>
                                                    <td>  {{number_format($product->cost,2)}} </td>

                                                </tr>
                                            @else

                                                <tr>
                                                    <th> الوحدة</th>
                                                    <td>  {{$product->unit->name}} </td>
                                                </tr>
                                                <tr>
                                                    <th> سعر الشراء</th>
                                                    <td>  {{number_format($product->buying_price,2)}} </td>
                                                </tr>

                                                <tr>
                                                    <th> سعر البيع</th>
                                                    <td>  {{number_format($product->selling_price,2)}} </td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th> الصورة</th>
                                                    <td>
                                                        @if($product->image)
                                                            <a data-fancybox="gallery" href="{{$product->image}}">
                                                                <img src="{{$product->image}}" width="70" height="70"
                                                                     class="img-thumbnail" alt="product_img">
                                                            </a>
                                                        @else {{__('No Image')}} @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th> ملاحظات</th>
                                                    <td>  {{$product->notes}} </td>
                                                </tr>

                                                <tr>
                                                    <th> كمية الصنف فى المخزن</th>
                                                    <td>
                                                        @if($product->made_in_order == 1)
                                                            لا يوجد مخزون
                                                        @else
                                                            {{$product->quantity}}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th> كمية الصنف فى المحل</th>
                                                    <td>
{{--                                                        {{$product->quantity_in_restaurant - $product->sales_restaurant_quantity}} --}}
                                                        {{$product->bill_quantity}}
                                                    </td>
                                                </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection




