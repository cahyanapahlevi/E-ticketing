@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar AKtifitas (To Do List) Yang Sedang Dikerjakan Programmer</h4>
				  <a href="{{url('/manager/taktifitas')}}"><button type="button" class="btn btn-primary btn-sm">Tambah Deskripsi Aktifitas</button></a>
				  <a href="{{url('/manager/dataaktifitas')}}"><button type="button" class="btn btn-primary btn-sm">Semua Data</button></a>
				  
				   <p></p>
					<form action="{{url('/manager/cariaktifitas')}}" method="GET" class="form-inline" >
					<input type="text" class="form-control" id="exampleInputName1" name="cari" placeholder="Cari Proyek" value="{{ old('cari') }}">
					<button class="btn btn-primary btn-sm" name="filter"><i class="fa fa-search"></i> Search</button>
					</form>
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
                            Action
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
						@foreach ($dataak as $s)
                           <td>
                            {{ $s->ID_PROYEK}}
                          </td>
                          <td>
                            {{ $s->NAMA_PROYEK}}
                          </td> 
						  <td>
						   <a href="{{url('/manager/detailaktifitas', $s->ID_PROYEK)}}"><button type="button" class="btn btn-success btn-dm">Detail</button></a>
						   <a href="{{url('/manager/taktifitas2')}}"><button type="button" class="btn btn-primary btn-sm">Tambah Aktifitas</button></a><!--11-4-2019*/-->
                             <a href="{{url('/manager/editaktifitas', $s->ID_PROYEK)}}"><button type="button" class="btn btn-danger btn-dm">Edit</button></a>
							 <a href="{{url('/manager/hapusproyek', $s->ID_PROYEK)}}"><button type="button" class="btn btn-warning btn-dm">Delete</button></a>
                          </td> 
                        </tr>
            @endforeach
                      </tbody>
                    </table>
					<small>Jumlah Data : {{ $dataak->total() }}</small> <br/>
				  <div class="pagination">
					{{ $dataak->links() }}
					</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection