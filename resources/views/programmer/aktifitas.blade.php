@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar AKtifitas (To Do List) Yang Sedang Dikerjakan</h4>
				  <a href="{{url('/programmer/dticket')}}"><button type="button" class="btn btn-outline-success">Tambah Aktifitas</button></a>
				  <p></p>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
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
						  </td>
                          <td>
                            Herman Beck
                          </td>
                          <td>
                            Aplikasi Mencari Jodoh
                          </td>
                          <td>
                            0%
                          </td>
                          <td class="text-danger"> 53.64%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                           <a href="{{url('/programmer/dticket')}}"><button type="button" class="btn btn-primary btn-fw">Edit</button></a>
						   <a href="{{url('/programmer/dticket')}}"><button type="button" class="btn btn-danger btn-fw">Hapus</button></a>
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