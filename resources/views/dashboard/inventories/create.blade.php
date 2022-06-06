@extends('dashboard.layouts.layout')
@section('title',' اضافة عملية جرد جديدة')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.inventories.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        الجرد </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="header-title m-t-0 m-b-30"> اضافة عملية جرد جديدة</h4>

                            {!!Form::open( ['route' => 'admin.inventories.store', 'method' => 'Post','role'=>'form','class'=>'form-horizontal',
                                'files'=>true,
                               'x-data'=>'inventoryForm',
                                ]) !!}

                            @include('dashboard.inventories.form')
                            {!!Form::close() !!}
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
            Alpine.data('inventoryForm', () => ({
                product: {
                    product_id: null,
                    storage_quantity: null,
                    exists_quantity: null,
                    difference: null,
                },

                products:@json($products),

                row_products: [],

                setProduct(e, index, name) {
                    this.row_products[index][name] = e.target.value
                },
                deleteItem(i) {
                    this.row_products.splice(i, 1)
                },
                addItem() {
                    this.row_products.push(Object.assign({}, this.product))
                },
                setPrice(e, index) {
                    console.log('running');
                },
                get total() {
                    return this.row_products.reduce(function (total, product) {
                        return total + (product.quantity * product.buying_price);
                    }, 0);
                }
            }))
        })
    </script>
@endpush

