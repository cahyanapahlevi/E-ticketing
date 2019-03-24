@extends('manager.master')
<!--Tampilan baru menu aktifitas manager (rita)-->
@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar AKtifitas (To Do List) Yang Sedang Dikerjakan Programmer</h4>
				  <a href="{{url('/manager/aktifitas')}}"><button type="button" class="btn btn-primary btn-sm">Semua Data</button></a>
				  
				   <p></p>
					<form action="{{url('/manager/cari')}}" method="GET" class="form-inline" >
					<input type="text" class="form-control" id="exampleInputName1" name="cari" placeholder="Cari Proyek" value="{{ old('cari') }}">
					<button class="btn btn-primary btn-sm" name="filter"><i class="fa fa-search"></i> Search</button>
					</form>
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