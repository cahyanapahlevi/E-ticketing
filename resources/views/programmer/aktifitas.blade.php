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
                            WARNING
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
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($siswa as $s)
                            @if($s->selisih >= '3')
                            <td>
                          <div class="btn btn-success">
                              <strong>lebih dari 3 hari</strong>
                            </div></td>
                            @elseif($s->selisih >= '2')
                          <td><div class="btn btn-warning">
                              <strong>kurang dari 3 hari</strong>
                            </div></td>
                            @elseif($s->selisih >= '1')
                          <td><div class="btn btn-warning">
                              <strong>kurang dari 1 hari</strong>
                            </div></td>
                            @elseif('0' >= $s->selisih)
                          <td><div class="btn btn-danger">
                              <strong>lebih dari deadline</strong>
                            </div></td>
                            @endif
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
						  <td>
						  <a href="{{url('/programmer/editaktifitas', $s->ID_TIKET)}}"><button type="button" class="btn btn-danger btn-dm">Edit</button></a>
							 <a href="{{url('/programmer/hapustiket', $s->ID_TIKET)}}"><button type="button" class="btn btn-warning btn-dm">Delete</button></a>
						  </td>
                          
						  
                        </tr>
            @endforeach
                      </tbody>
                    </table>
					<small>Jumlah Data :{{ $siswa->total() }}</small> <br/>
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