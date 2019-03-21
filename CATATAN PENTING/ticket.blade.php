@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ticket Masuk</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                         <th>
                            ID Proyek
                          </th>
                          <th>
                            Nama Proyek
                          </th>
						  <th>
                            Instansi Proyek
                          </th>
                          <th>
                            Deskripsi Proyek
                          </th>
                          <th>
                            Platform Proyek
                          </th>
                          <th>
                            Programmer1
                          </th>
                          <th>
                            Programmer2
                          </th>
						  <th>
                            Programmer3
                          </th>
						  <th>
                            Deadline Proyek
                          </th>
						  <th>
                            Status Proyek
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
                            Aplikasi Mencari Jodoh
                          </td>
                          <td>
                            0%
                          </td>
                          <td class="text-danger"> 53.64%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                          <td>
                            
                          </td>
						  <td>
						  </td>
						  <td>
						  </td>
						  <td>
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