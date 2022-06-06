@extends('dashboard.layouts.layout')
@section('title','أمر تصنيع صنف')

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
                            <h4 class="header-title m-t-0 m-b-30"> أمر تصنيع صنف {{$product->name}}</h4>
                            @include('dashboard.layouts.status')
                            <table class="table table-bordered table-responsive table-striped">
                                <thead>
                                <tr>
                                    <th>اسم المادة الخام</th>
                                    <th>الوحدة</th>
                                    <th>كمية المادة الخام</th>
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
                            </table>

                            <h4 class="header-title m-t-0 m-b-30">     التصنيف : {{$product->category->name}}</h4>
                            <br>
                            <br>
                            {!! Form::model($product,['route'=>['admin.products.madeProduct',$product->id],
                                'method'=>'PUT', 'role'=>'form','class'=>'form-horizontal','files'=>true,    ]) !!}


                            <div class="form-group row">
                                <label class="col-md-2 control-label"> كمية الصنف </label>
                                <div class="col-md-4">
                                    {!! Form::number('required_quantity',null,[
                                                     'class' =>'form-control '.($errors->has('required_quantity') ? '                                                is-invalid' : null), 'placeholder'=> 'الكمية ' , 'required',
                                                       'oninvalid'=>"this.setCustomValidity(' كمية الصنف مطلوبة')",
                               'onchange'=>"this.setCustomValidity('')",
                                                       ]) !!}
                                    @error('required_quantity')
                                    <div class="invalid-feedback" style="color: #ef1010">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center form-group row">
                                <button type="submit"
                                        class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md">
                                    حفظ
                                </button>
                            </div>

                            {!!Form::close() !!}
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div><!-- end col -->
    </div>

@endsection
