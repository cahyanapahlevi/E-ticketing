@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Proyek Dan Programmer Yang Mengerjakan</h4>
          
          <br/>
          <a href="{{ url('/manager/cetak') }}" target="_blank"><button class="btn btn-primary btn-sm "  name="cetak"><i class="fa fa-print"></i> Cetak</button></a>
          
  <p></p>
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
                            Programmer1
                          </th>
                          <th>
                            Programmer2
                          </th>
              <th>
                            Programmer3
                          </th>
                        </tr>
                      </thead>
                      <tbody>
            
                        <tr>
            @foreach ($page as $t)
                          <td class="font-weight-medium">
              {{ $t->ID_PROYEK}}
                          </td>
                          <td>
              {{ $t->NAMA_PROYEK}}
                          </td>
              <td>
              {{ $t->INSTANSI_PROYEK}}
                          </td>
                          <td> 
              {{ $t->PROGRAMER1}}
                          </td>
              <td> 
              {{ $t->PROGRAMER2}}
                          </td>
              <td> 
              {{ $t->ID_PROGRAMER}}
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>          
                  </div><br/>
          <!--Penambahan untuk pagination-->
  <small>Jumlah Data : {{ $page->total() }}</small> <br/>
          <div class="pagination">
    {{ $page->links() }}
  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
    
@endsection