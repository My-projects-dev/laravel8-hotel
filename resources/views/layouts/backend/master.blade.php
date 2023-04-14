<!DOCTYPE html>
<html lang="az">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>
    <meta name="robots" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Innap : Hotel Admin Template"/>
    <meta property="og:title" content="Innap : Hotel Admin Template"/>
    <meta property="og:description" content="Innap : Hotel Admin Template"/>
    <meta property="og:image" content="https://innap.dexignzone.com/xhtml/social-image.png"/>
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Innap : Hotel Admin Template</title>

    <!-- FAVICONS ICON -->
    <link rel="stylesheet" media="all" href="{{asset('assets/frontend/css/linear-icons.css')}}"/>
    <link rel="stylesheet" media="all" href="{{asset('assets/frontend/css/hotel-icons.css')}}"/>
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/backend/images/favicon.png')}}"/>
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/chartist/css/chartist.min.css')}}">
    <link href="{{asset('assets/backend/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}"
          rel="stylesheet">
    <!-- Style css -->
    <link href="{{asset('assets/backend/css/style.css')}}" rel="stylesheet">
    <!-- Datatable -->
    <link href="{{asset('assets/backend/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">

    <!--Toggleable Tabs -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!--Ckeditor -->
    <script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>

</head>
<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="waviy">
        <span style="--i:1">L</span>
        <span style="--i:2">o</span>
        <span style="--i:3">a</span>
        <span style="--i:4">d</span>
        <span style="--i:5">i</span>
        <span style="--i:6">n</span>
        <span style="--i:7">g</span>
        <span style="--i:8">.</span>
        <span style="--i:9">.</span>
        <span style="--i:10">.</span>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    @include('layouts.backend.header')
    @include('layouts.backend.sidebar')
    @yield('content')
    @include('layouts.backend.footer')


</div>
<!--**********************************
     Main wrapper end
 ***********************************-->
@include('layouts.backend.scripts')
</body>
</html>

