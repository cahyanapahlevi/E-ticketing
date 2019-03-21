@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar AKtifitas (To Do List) Yang Sedang Dikerjakan Programmer</h4>
				  
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