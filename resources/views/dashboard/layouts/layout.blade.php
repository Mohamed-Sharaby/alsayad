<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Panorama Alqassim">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.ico')}}">
    <{{--script type="module">
        import hotwiredTurbo from 'https://cdn.skypack.dev/@hotwired/turbo';
    </script>--}}

    <title>@yield('title')</title>

   @include('dashboard.layouts.styles')
    @stack('styles')
    @yield('styles')

</head>

<body class="fixed-left">
<!-- Begin page -->
<div id="wrapper">
   @include('dashboard.layouts.top-bar')
   @include('dashboard.layouts.right-side-menu')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

             @yield('content')

            </div> <!-- container -->

        </div> <!-- content -->
        <footer class="footer text-right">
            Panorama Alqassim © {{date('Y')}}
        </footer>
    </div>

    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->
</div>
<!-- END wrapper -->

@include('dashboard.layouts.scripts')
@stack('scripts')

</body>
</html>
