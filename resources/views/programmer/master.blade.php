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
  <link rel="stylesheet" href="{{asset('source/dist/css/smart_wizard_theme_arrows.css')}}" rel="stylesheet" >
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
  <script type="text/javascript">
        $(document).ready(function(){

            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
               //alert("You are on step "+stepNumber+" now");
               if(stepPosition === 'first'){
                   $("#prev-btn").addClass('disabled');
               }else if(stepPosition === 'final'){
                   $("#next-btn").addClass('disabled');
               }else{
                   $("#prev-btn").removeClass('disabled');
                   $("#next-btn").removeClass('disabled');
               }
            });

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                                             .addClass('btn btn-info')
                                             .on('click', function(){ alert('Finish Clicked'); });
            var btnCancel = $('<button></button>').text('Cancel')
                                             .addClass('btn btn-danger')
                                             .on('click', function(){ $('#smartwizard').smartWizard("reset"); });

            // Please note enabling option "showStepURLhash" will make navigation conflict for multiple wizard in a page.
            // so that option is disabling => showStepURLhash: false

            // Smart Wizard 1
            $('#smartwizard').smartWizard({
                    selected: 0,
                    theme: 'arrows',
                    transitionEffect:'fade',
                    showStepURLhash: false,
                    toolbarSettings: {toolbarPosition: 'both',
                                      toolbarExtraButtons: [btnFinish, btnCancel]
                                    }
            });

            // Smart Wizard 2
            $('#smartwizard2').smartWizard({
                    selected: 0,
                    theme: 'default',
                    transitionEffect:'fade',
                    showStepURLhash: false
            });

        });
    </script>
    <script
      src="{{asset('source/js/jquery.min.js')}}"></script>

    <script
      src="{{asset('source/dist/js/jquery.smartWizard.min.js')}}"></script>
  <script src="{{asset('source/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('source/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('source/vendors/js/vendor.bundle.addons.js')}}"></script>
  <script src="{{asset('source/js/off-canvas.js')}}"></script>
  <script src="{{asset('source/js/misc.js')}}"></script>
  <script src="{{asset('source/js/dashboard.js')}}"></script>
   
</body>

</html>