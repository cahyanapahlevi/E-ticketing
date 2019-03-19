@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Project Yang Sedang Dikerjakan</h4>
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
                            Nama Aplikasi
                          </th>
                          <th>
                            Progress
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Dedline
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
                            <a href="{{url('/programmer/dproject')}}"><button type="button" class="btn btn-outline-success">Detail</button></a>
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
                           Aplikasi Manajemen
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
						  <a href="{{url('/programmer/dproject')}}"><button type="button" class="btn btn-outline-success">Detail</button></a>
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