@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Permintaan Tiket Baru</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            ID_Tiket
                          </th>
                          <th>
                            Nama Aplikasi
                          </th>
                          <th>
                            Deskripsi Aplikasi
                          </th>
                          <th>
                            Status
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($aplikasi as $p)
                        <tr>
                          <td class="font-weight-medium">
                            1
                          </td>
                          <td>{{ $p->aplikasi }}</td>
                         <td>{{ $p->aktifitas }}</td>
                          <td>
                             <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $p->status }}
                          </button>
                          <div class="dropdown-menu">
                             <a class="dropdown-item" href="{{url('/pegawai/edit', $p->id_tiket)}}">
                              <i class="fa fa-envelope-open-o fa-fw"></i>Open</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-history fa-fw"></i>On Progress</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-check text-success fa-fw"></i>Done</a>
                          </div>
                        </div>
                            <!--<a href="{{url('/manager/eticket')}}"><button type="button" class="btn btn-outline-success">Detail</button></a>-->
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
                            <div class="progress">
                              <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $245.30
                          </td>
                          <td class="text-success"> 24.56%
                            <i class="mdi mdi-arrow-up"></i>
                          </td>
                          <td>
                            July 1, 2015
                          </td>
						  <td>
						   <a href="{{url('/manager/eticket')}}"><button type="button" class="btn btn-outline-success">Detail</button></a>
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