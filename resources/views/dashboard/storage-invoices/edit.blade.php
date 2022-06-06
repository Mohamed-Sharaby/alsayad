@extends('dashboard.layouts.layout')
@section('title',' تعديل فاتورة  ')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.storage-invoices.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        فواتير المخزن </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="header-title m-t-0 m-b-30">
                                تعديل فاتورة رقم
                                <span class="badge badge-info">{{$invoice->code}}</span>
                            </h4>
                            {!! Form::model($invoice,['route'=>['admin.storage-invoices.update',$invoice->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal',          'files'=>true,
                                'x-data'=>'invoiceForm',
                                ]) !!}
                            @include('dashboard.storage-invoices.form')
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
                supplier_id: '{{$invoice->supplier_id}}',
                product:{
                    product_id:null,
                    buying_price:null,
                    quantity:null,
                    unit_id:null,
                },
                products: @json($invoice->storageInvoiceItems),

                supplier_products: @json($invoice->supplier->products->load('storage_quantity')),
                init() {
                    this.$watch('supplier_id', supplier_id => this.get_products())
                },
                get_products() {
                    fetch('{{route('admin.suppliers.products')}}?supplier_id=' + this.supplier_id,
                    ).then(res => res.json())
                        .then(data => this.supplier_products = data);
                },
                setProduct(e,index,name){
                    this.products[index][name]=e.target.value
                },
                deleteItem(i){
                    this.products.splice(i,1)
                },
                addItem(){
                    this.products.push(Object.assign({},this.product))
                },

                get total(){
                    return      this.products.reduce(function (total, product) {
                        return total + (product.quantity * product.buying_price);
                    }, 0);
                }
            }))
        })
    </script>
@endpush
