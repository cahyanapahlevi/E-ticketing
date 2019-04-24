@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
		  <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
				<div id="demo" class="carousel slide" data-ride="carousel" data-interval="1000">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="3"></li>
    <li data-target="#demo" data-slide-to="4"></li>
	<li data-target="#demo" data-slide-to="5"></li>
	<li data-target="#demo" data-slide-to="6"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{asset('source/images/kominfo2.png')}}" alt="Los Angeles" width="1000" height="500">
      <div class="carousel-caption">
      </div>   
    </div>
    <div class="carousel-item">
      <img src="{{asset('source/images/kominfo3.png')}}" alt="Chicago" width="1000" height="500">
      <div class="carousel-caption">
      </div>   
    </div>
    <div class="carousel-item">
      <img src="{{asset('source/images/kominfo4.png')}}" alt="New York" width="1000" height="500">
      <div class="carousel-caption">
      </div>   
    </div>
	<div class="carousel-item">
      <img src="{{asset('source/images/kominfo5.png')}}" alt="New York" width="1000" height="500">
      <div class="carousel-caption">
      </div>   
    </div>
	<div class="carousel-item">
      <img src="{{asset('source/images/kominfo6.png')}}" alt="New York" width="1000" height="500">
      <div class="carousel-caption">
      </div>   
    </div>
	<div class="carousel-item">
      <img src="{{asset('source/images/kominfo8.png')}}" alt="New York" width="1000" height="500">
      <div class="carousel-caption">
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
                </div>
              </div>
            </div>
          </div>
		
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <a href="{{url('/programmer/proyek')}}"><p class="mb-0 text-right">Project</p></a><!--24-4-2019-->
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{ $pm->count() }}</h3><!--24-4-2019-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <a href="{{url('/programmer/onprogress')}}"><p class="mb-0 text-right">On Progress</p></a><!--24-4-2019-->
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{ $op->count() }}</h3><!--24-4-2019-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-location text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Waiting List</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">30</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tambahkan Project Yang Saat Ini Sedang Anada Kerjakan</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <a href="{{url('/programmer/dproject')}}"><button type="button" class="btn btn-outline-success">Tambah Project</button></a>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection