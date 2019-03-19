@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Project</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">5</h3>
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
                      <p class="mb-0 text-right">On Progress</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">10</h3>
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