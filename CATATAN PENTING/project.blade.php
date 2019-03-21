@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Project Yang Sedang Dikerjakan</h4>
				  <a href="{{url('/programmer/dproject')}}"><button type="button" class="btn btn-outline-success">Tambah Project</button></a>
				  <p></p>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                         <th>
                           Id Project
                          </th>
                          <th>
                            Nama Project
                          </th>
                          <th>
                            Instansi
                          </th>
                          <th>
                            Deskripsi
                          </th>
                          <th>
                            Platforn
                          </th>
                          <th>
                            Dedline
                          </th>
                          <th>
                            Status
                          </th>
						  <th>
                            Aktifitas Tiket
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
                            Herman Beck
                          </td>
                          <td>
                            Aplikasi Ternak
                          </td>
                          <td>
                            $ 77.99
                          </td>
                          <td class="text-danger"> 53.64%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                          <td>
                            <button type="button" class="btn btn-icons btn-inverse-primary" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-refresh"></i></button>
                          </td>
						  <td>
						  </td>
						  <td>
						  </td>
						  <td>
						  </td>
						  <td>
						  <button type="button" class="btn btn-primary btn-info">Edit</button>
						  <button type="button" class="btn btn-danger btn-info">Delete</button>
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