@extends('dashboard.layouts.layout')
@section('title',' تسديد فاتورة  ')

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
                                تسديد فاتورة رقم
                                <span class="badge badge-info">{{$invoice->code}}</span>
                            </h4>
                            {!! Form::model($invoice,['route'=>['admin.paidSalesInvoice',$invoice->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal', 'files'=>true,
                                'x-data'=>'invoiceForm',
                                ]) !!}

                            <div class="form-group row">
                                <label class="col-md-2 control-label">اسم العميل</label>
                                <div class="col-md-4">
                                    {!! Form::text('client_id',$invoice->client->name,['class' =>'form-control','disabled']) !!}
                                </div>

                                <label class="col-md-2 control-label">تاريخ انشاء الفاتورة </label>
                                <div class="col-md-4">
                                    {!! Form::text('date',$invoice->date->toDateString(),['class' =>'form-control','disabled']) !!}
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-2  control-label">قيمة الفاتورة</label>
                                <div class="col-md-4">
                                    {!! Form::text('total',number_format($invoice->total,2),['class' =>'form-control','disabled']) !!}
                                </div>

                                <label class="col-md-2 control-label">المتبقى </label>
                                <div class="col-md-4">
                                    {!! Form::text('total',$remaining,['class' =>'form-control','disabled']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">تاريخ السداد </label>
                                <div class="col-md-4">
                                    {!! Form::date('paid_date',now(),['class' =>'form-control']) !!}
                                </div>

                                <label class="col-md-2 control-label text-center">المطلوب سداده
                                    <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="number" name="received" class="form-control" min="1"
                                           step="0.01"
                                           max="{{$remaining}}" value="{{old('received')}}"
                                           placeholder="اقصى مبلغ يجب ادخاله هو : {{$remaining}}" >
                                    @error('received')
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


                            {!! Form::close() !!}
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div><!-- end col -->
    </div>

@endsection
