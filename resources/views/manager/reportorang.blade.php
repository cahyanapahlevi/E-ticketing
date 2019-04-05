@extends('manager.master')
<!--Tampilan baru menu aktifitas manager (rita)-->
@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar Programmer dan Tugas yang Sedang Dikerjakan</h4>
          
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
          <small>Jumlah Data : {{ $siswa->total() }}</small> <br/>
          <div class="pagination">
          {{ $siswa->links() }}
          </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection