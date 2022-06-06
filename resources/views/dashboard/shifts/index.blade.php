<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.ico')}}">

    <!-- App title -->
    <title>بداية الشفت</title>

    <!-- App CSS -->
    <link href="{{asset('admin/assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/core.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/components.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/pages.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/menu.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/responsive.css')}}" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{asset('admin/assets/js/modernizr.min.js')}}"></script>

</head>
<body>


<div class="container-fluid" style="margin-top: 100px!important;">

    <div class="row text-center mt-3">
        @foreach($cashiers as $cashier)

            <form action="{{route('admin.shifts.store')}}" method="post">
                @csrf
                <div class="col-12 col-md-4">
                    <div class="m-t-40 card-box">
                        <div class="text-center">
                            <h4 class="text-uppercase font-bold m-b-0">{{$cashier->name}}  </h4>
                        </div>
                        <input type="hidden" name="cashier_id" value="{{$cashier->id}}">
                        <br>

                        <p class="text-danger font-bold">الرصيد الموجود بالخزنة : </p>
                        <span class="font-bold">{{number_format(optional($cashier->last_receive)->remaining,2)  }}</span>
                        <div class="panel-body text-center">
                            <button class="btn btn-info" type="submit">  بدأ الشفت</button>
                        </div>
                    </div>

                </div>
            </form>
        @endforeach

    </div>


    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/bootstrap-rtl.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/detect.js')}}"></script>
    <script src="{{asset('admin/assets/js/fastclick.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('admin/assets/js/waves.js')}}"></script>
    <script src="{{asset('admin/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.scrollTo.min.js')}}"></script>


    <script src="{{asset('admin/assets/js/jquery.core.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.app.js')}}"></script>

</body>
</html>
