@extends('manager.master')

@section('manager.content')
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
                      <a href="{{url('/manager/proyek')}}"><p class="mb-0 text-right">Project</p></a><!--Tambahan rita-->
                     <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{ $pm->count() }}</h3><!--Tambahan rita-->
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
                      <a href="{{url('/manager/onprogress')}}"><p class="mb-0 text-right">On Progress</p></a>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{ $op->count() }}</h3>
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
                  <h4 class="card-title">Data Programmer Dengan Progress Aplikasi Selesai</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Nama Proyek
                          </th>
						  <th>
                            Status
                          </th>
						  <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
            @foreach ($page as $t)
                          <td>
              {{ $t->NAMA_PROYEK}}
                          </td>
						  <td>
              {{ $t->STATUS_PROYEK}}
                          </td>
						  <td>
						  <a href="{{url('manager/ticket/detaildas', $t->ID_PROYEK)}}" class='btn btn-mini btn-warning tipsy-kiri-atas'>DETAIL</a>
						  </td>
                        </tr>
                        @endforeach
                     
                      </tbody>
                    </table>
					<a href="{{url('/manager/detaildone')}}"><button type="button" class="btn btn-success btn-dm">Lihat Semua Data >></button></a>
                  </div>
                </div>
				<p></p>
				<div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Programmer Dengan Progress Mendekati 100%</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                           Nama Programmer
                          </th>
                         <th>
                            ID Tiket
                          </th>
              <th>
                            Nama Proyek
                          </th>
                          <th>
                            Task
                          </th>
              <th>
                            Aktifitas (To Do List)
                          </th>
                          <th>
                            Progress 
                          </th>
                          <th>
                            Timeline
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($siswa as $s)
			<td>
                           {{ $s->ID_PROGRAMER}}
                          </td>
			
                          <td>
                            {{ $s->ID_TIKET}}
                          </td>
                          <td>
                            {{ $s->NAMA_PROYEK}}
                          </td>
							<td>
                            {{ $s->TASK}}
                          </td>
                          <td>
                            {{ $s->AKTIFITAS_TIKET}}
                          </td>
                         <td>
                            {{ $s->PROGRESS_TIKET}}
                          </td>
                          <td>
                            {{ $s->TIMELINE_TIKET}}
                          </td>
              
                        </tr>
            @endforeach
                      </tbody>
                    </table>
					
                  </div>
				  <a href="{{url('/manager/detailminseratus')}}"><button type="button" class="btn btn-success btn-dm">Lihat Semua Data >></button></a>
                </div>
				<p> </p>
				<div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Programmer Dengan Progress Aplikasi Sesuai Bidang (Overload)</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            No
                          </th>
                          <th>
                            Nama Programmer
                          </th>
						   <th>
                            Divisi
                          </th>
						  <th>
                            Bidang
                          </th>
                          <th>
                            Nama Aplikasi
                          </th>
                          <th>
                            Progress
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="font-weight-medium">
                            1
                          </td>
                          <td>
                            Herman Beck
                          </td>
						  <td>
						  </td>
						  <td>
						  </td>
                          <td>
                            Aplikasi TU
                          </td>
                          <td>
                            $ 77.99
                          </td>
                          <td class="text-danger"> 53.64%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                            <a href="{{url('/manager/dticket')}}"><button type="button" class="btn btn-outline-success">Detail</button></a>
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-medium">
                            2
                          </td>
                          <td>
                            Messsy Adam
                          </td>
						  <td>
						  </td>
						  <td>
						  </td>
                          <td>
                            Aplikasi RS
                          </td>
                          <td>
                            $245.30
                          </td>
                          <td class="text-success"> 24.56%
                            <i class="mdi mdi-arrow-up"></i>
                          </td>
                          <td>
                            <a href="{{url('/manager/dticket')}}"><button type="button" class="btn btn-outline-success">Detail</button></a>
                          </td>
                        </tr>
                      
                     
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection