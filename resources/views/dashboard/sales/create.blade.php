<!doctype html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="{{asset('bill/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bill.css')}}" >
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>فاتورة البيع</title>
    <style>
        @media print{
            .no-print{
                display: none;
            }
        }
    </style>
</head>
<body>
<div id="app">
    <app/>
</div>
<br>
<br>
<br>

<div class="no-print" style="text-align: center!important;">
    <a href="{{route('admin.shifts.edit',['shift'=>\App\Models\Shift::whereAdminId(auth()->id())->whereIsOpen(1)->first()->id])}}"
       style="background-color: #de1250 !important;    border-radius: 2px;
    padding: 6px 14px;text-decoration: none;text-align: center!important;
    border: 1px solid #de1250 !important;color: #ffffff !important;">إنهاء الشفت</a>
</div>

<script src="{{asset('js/bill.js')}}"></script>

</body>
</html>

