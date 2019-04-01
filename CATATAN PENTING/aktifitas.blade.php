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
                          @foreach ($siswa as $s)
                          <td>
                            {{ $s->id_tiket}}
                          </td>
                          <td>
                            {{ $s->permintaan_app}}
                          </td>
						  <td>
                            {{ $s->task}}
                          </td>
                          <td>
                            {{ $s->aktifitas}}
                          </td>
                         <td>
                            {{ $s->progress}}
                          </td>
                          <td>
                            {{ $s->timeline2}}
                          </td>
						  <td>
						  <a href="{{url('/programmer/editaktifitas', $s->id_tiket)}}"><button type="button" class="btn btn-danger btn-dm">Edit</button></a>
							 <a href="{{url('/programmer/hapustiket', $s->id_tiket)}}"><button type="button" class="btn btn-warning btn-dm">Delete</button></a>
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