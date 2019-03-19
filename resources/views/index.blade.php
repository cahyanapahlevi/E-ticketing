<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Ticketing</title>
  <link rel="stylesheet" href="{{asset('source/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('source/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('source/vendors/css/vendor.bundle.addons.css')}}">
  <link rel="stylesheet" href="{{asset('source/css/style.css')}}">
  <link rel="shortcut icon" href="{{asset('source/images/coco.png')}}" />
</head>

<body>
  <div class="container-scroller" >
 <!-- <img src="{{asset('source/images/kominfo.png')}}" alt="logo" />-->
  <!--<div align="center" >
			 <img src="{{asset('source/images/kominfo.png')}}" alt="logo" />
            </div>-->
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
       <img src="{{asset('source/images/kominfo.png')}}" />
	   <br>
	   <div class="row w-100">
		<table>
		<tr>
          <div class="col-lg-5">
            <h2 class="text-center mb-4">Manajer</h2>
            <div align="center" >
			 <a href="{{url('/manager')}}"><img src="{{asset('source/images/manager4.png')}}" alt="logo" /></a>
            </div>
          </div></tr>
           <div class="col-lg-2">
          </div>
		  <tr>
           <div class="col-lg-5">
            <h2 class="text-center mb-4">Programmer</h2>
            <div align="center" >
			 <a href="{{url('/programmer')}}"><img src="{{asset('source/images/programmer3.png')}}" alt="logo" /></a>
            </div>
          </div>
		  
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('source/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('source/vendors/js/vendor.bundle.addons.js')}}"></script>
  <script src="{{asset('source/js/off-canvas.js')}}"></script>
  <script src="{{asset('source/js/misc.js')}}"></script>
</body>

</html>