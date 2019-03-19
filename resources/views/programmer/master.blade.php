<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Ticket Diskominfo</title>
  <link rel="stylesheet" href="{{asset('source/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('source/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('source/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('source/vendors/css/vendor.bundle.addons.css')}}">
  <link rel="stylesheet" href="{{asset('source/css/style.css')}}">
  <link rel="shortcut icon" href="{{asset('source/images/coco.png')}}" />
</head>

<body>
  <div class="container-scroller">

  	<!-- untuk memanggil header -->
  	@include('programmer.template.header')
    
    <div class="container-fluid page-body-wrapper">

    	<!-- untuk memanggil sidebar (menu samping) -->
      @include('programmer.template.sidebar')

      <div class="main-panel">

      	<!-- untuk memanggil isi halaman -->
        @yield('programmer.content')

        <!-- untuk memanggil footer -->
        @include('programmer.template.footer')

      </div>
    </div>
  </div>

  <script src="{{asset('source/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('source/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('source/vendors/js/vendor.bundle.addons.js')}}"></script>
  <script src="{{asset('source/js/off-canvas.js')}}"></script>
  <script src="{{asset('source/js/misc.js')}}"></script>
  <script src="{{asset('source/js/dashboard.js')}}"></script>
</body>

</html>