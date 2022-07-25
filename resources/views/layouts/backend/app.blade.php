<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{asset('assets/images/logo/favicon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logo/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    {{-- CSS --}}
      @include('layouts.backend.css')
    {{-- END CSS --}}

</head>
<!-- END: Head-->


<!-- BEGIN: Body-->
<body class="{{auth::user()->role == 'Pemilik' ? 'vertical' : 'horizontal'}}-layout {{auth::user()->role == 'Pemilik' ? 'vertical' : 'horizontal'}}-menu-modern 2-columns  navbar-sticky footer-static  " data-open="hover" data-menu="{{auth::user()->role == 'Pemilik' ? 'vertical' : 'horizontal'}}-menu{{auth::user()->role == 'Pemilik' ? '-modern' : ''}}" data-col="2-columns" data-layout="dark-layout">

    <!-- BEGIN: Header-->
      @include('layouts.backend.header')
    <!-- END: Header-->


    <!-- BEGIN: Sidebar Menu-->
      @include('layouts.backend.sidebar')
    <!-- END: Sidebar Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
        <div class="content-body">
          @if (cekPromo()) {{-- Cek promo jika sudah ada yg berakhir --}}
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <div class="alert-body">
                Ada Promo yang sudah berakhir, <a href=" {{route('kamar.promo')}} ">cek disini</a>
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          @if(cekPemesanan()) {{-- cek pemesanan jika belum terbayar --}}
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="alert-body">
              Segera selesaikan pembayaran kamar kamu yuk, <a href=" {{url('user/tagihan')}} ">lihat disini</a>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          @if(getNotifikasiEndSewa())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="alert-body">
             Ada kamar yang sudah habis sewa, <a href=" {{url('pemilik/booking-list')}} ">lihat disini</a>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          @yield('content')
        </div>
      </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0">
          <span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{date('Y')}} <a class="text-bold-800 grey darken-2" href="/" target="_blank">Qos Kos,</a>All rights Reserved</span>
          <span class="float-md-right d-none d-md-block">Made with<i class="feather icon-heart pink"></i> &nbsp;in Makassar</span>
          <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->


    {{-- Javascript --}}
      @include('layouts.backend.scripts')
      @yield('scripts')
    {{-- END Javascript --}}

</body>
<!-- END: Body-->

</html>
