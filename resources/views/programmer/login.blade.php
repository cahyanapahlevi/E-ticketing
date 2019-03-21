<!DOCTYPE html>
<html lang="en">
 
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Welcome</title>
  <link rel="stylesheet" href="{{asset('source/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('source/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('source/vendors/css/vendor.bundle.addons.css')}}">

  <link rel="stylesheet" href="{{asset('source/css/style.css')}}">
 <link rel="shortcut icon" href="{{asset('source/images/coco.png')}}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              @if(Session::has('alert'))
                <div class="alert alert-danger">
                    <div>{{Session::get('alert')}}</div>
                </div>
            @endif
             @if(Session::has('alert-warning'))
                <div class="alert alert-warning">
                    <div>{{Session::get('alert-warning')}}</div>
                </div>
            @endif
            @if(Session::has('alert-success'))
                <div class="alert alert-success">
                    <div><h4>{{Session::get('alert-success')}}</h4></div>
                </div>
            @endif
              <form action="{{url('/programmer/masuk')}}" method="post">
                {{ @csrf_field() }}
                <div class="form-group">
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Username" name="username_programer">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="*********" name="password">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block">Login</button>
                </div>
              </form>
            </div>
            <p class="footer-text text-center">copyright &copy; 2019. All rights reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
<<<<<<< HEAD
=======

>>>>>>> 12e31c9eb52579c8c113c469cf6f69f46073c6f1
  <script src="{{asset('source/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('source/vendors/js/vendor.bundle.addons.js')}}"></script>
  <script src="{{asset('source/js/off-canvas.js')}}"></script>
  <script src="{{asset('source/js/misc.js')}}"></script>
</body>

</html>