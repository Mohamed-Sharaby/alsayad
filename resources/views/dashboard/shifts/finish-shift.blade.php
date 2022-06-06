<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{asset('admin/assets/images/logo.png')}}">

    <!-- App title -->
    <title> مطعم الصياد </title>

    <!-- App CSS -->
    <link href="{{asset('admin/assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/core.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/components.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/pages.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/menu.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/responsive.css')}}" rel="stylesheet" type="text/css"/>

    <!--Custom-Dashboard-->
    <link href="{{asset('admin/assets/css/custom-dashboard.css')}}" rel="stylesheet" type="text/css"/>
    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{asset('admin/assets/js/modernizr.min.js')}}"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Cairo:300,400,600,700&display=swap&subset=arabic"
          rel="stylesheet">

    <style>
        body,
        html {
            font-family: 'Cairo', sans-serif;
            /*font-size: 16px;*/
        }
    </style>
</head>

<body>


<div class="clearfix"></div>
<div class="wrapper-page text-center" style="width: 700px!important;">

    <div class="m-t-40 card-box login-card" style="width: 700px!important;">

        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0"> إنهاء الشفت وتسليم الخزنة </h4>
        </div>
        <div class="panel-body">
{{--            @include('dashboard.layouts.status')--}}


            {!! Form::model($shift,['route'=>['admin.shifts.update',$shift->id],'method'=>'PUT',
                                                'role'=>'form','class'=>'form-horizontal','x-data'=>'Form']) !!}

            <div x-data=""
                 x-init="()=>{
            $watch('delivered', delivered =>{
             remaining = total - delivered;
            })
            }">

                <div class="form-group row">
                    <label class="col-md-2 control-label">الرصيد الحالى</label>
                    <div class="col-md-10">
                        {!! Form::number('total', $total ,[
                                        'class' =>'form-control '.($errors->has('total') ? ' is-invalid' : null),
                                        'placeholder'=> 'الرصيد الحالى' ,'readonly','x-model'=>'total'
                                        ]) !!}
                        @error('total')
                        <div class="invalid-feedback" style="color: #ef1010">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label">الرصيد المسلم</label>
                    <div class="col-md-10">
                        {!! Form::number('delivered',null,[
                                        'class' =>'form-control '.($errors->has('delivered') ? ' is-invalid' : null),
                                        'placeholder'=> 'المسلم' ,'step'=>0.01,'min'=>'1','max'=>$total,'required'=>'required',
                                         'x-model'=>'delivered'
                                        ]) !!}
                        @error('delivered')
                        <div class="invalid-feedback" style="color: #ef1010">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label">الرصيد المتبقى</label>
                    <div class="col-md-10">
                        {!! Form::number('remaining',null,[
                                        'class' =>'form-control '.($errors->has('remaining') ? ' is-invalid' : null),
                                        'placeholder'=> 'المتبقى' , 'disabled'
                                        ,'x-model'=>'remaining'
                                        ]) !!}
                    </div>
                </div>
            </div>
            <div class="form-group text-center m-t-30">
                <div class="col-xs-12">
                    <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                         حفظ
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <!-- end card-box-->


</div>
@include('dashboard.layouts.scripts')
<!-- end wrapper page -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('Form', () => ({
            total: {{$total}},
            delivered: 0,
            remaining: 0,
        }))
    })
</script>

</body>

</html>


