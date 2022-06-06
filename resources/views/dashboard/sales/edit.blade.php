@extends('dashboard.layouts.layout')
@section('title',' تعديل فاتورة  ')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.sales.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        فواتير المبيعات </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="header-title m-t-0 m-b-30">
                                تعديل فاتورة رقم
                                <span class="badge badge-info">{{$invoice->code}}</span>
                            </h4>
                            {!! Form::model($invoice,['route'=>['admin.sales.update',$invoice->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal',          'files'=>true,
                                'x-data'=>'invoiceForm',
                                ]) !!}
                            @include('dashboard.sales.form')
                            {!! Form::close() !!}
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div><!-- end col -->
    </div>

@endsection
@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('invoiceForm', () => ({
                product: {
                    product_id: null,
                    product_price: null,
                    quantity: null,
                    total_product_price: null,
                    cooking_id: null,
                    cooking_price: null,
                    total: null,
                },
                products: @json($products),
                cookings: @json($cookings),

                row_products: @json($invoice->items),

                setProduct(e, index, name) {
                    this.row_products[index][name] = e.target.value
                },
                deleteItem(i) {
                    this.row_products.splice(i, 1)
                },
                addItem() {
                    this.row_products.push(Object.assign({}, this.product))
                },

                get totalInvoice() {
                    return this.row_products.reduce(function (total, product) {
                        return total +  parseInt(product.total) ;
                    }, 0);
                }
            }))
        })
    </script>
@endpush
