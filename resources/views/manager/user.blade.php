@extends('manager.master')

@section('manager.content')


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
                            Password
                          </th>
                          <th>
                            Level
                          </th>
                         <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="font-weight-medium">
                            
                          </td>
                          <td>
                            Herman Beck
                          </td>
						   <td>
                            
                          </td>
						   <td>
                            
                          </td>
                          <td>
                            Aplikasi Mencari Jodoh
                          </td>
                          <td>
                            0%
                          </td>
						  <td>
                          <button type="button" class="btn btn-outline-success">Edit</button> || <button type="button" class="btn btn-outline-success">Hapus</button></td>
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
                            Aplikasi Absensi
                          </td>
                          <td>
                            0%
                          </td>
						  <td>
                          <button type="button" class="btn btn-outline-success">Edit</button> || <button type="button" class="btn btn-outline-success">Hapus</button>
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

