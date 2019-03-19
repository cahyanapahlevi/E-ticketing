@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                 <h4>DATA PROGRAMMER</H4>
				 <a href="{{url('/manager/tambah')}}"><button type="button" class="btn btn-outline-success">Tambah Programmer</button></a>
				 <p></p>
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
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
					  @php $no = 1; @endphp
					  @foreach($programer as $tp)
                  
						<tr>
						<td>
						{{$no++ }}
						
						</td>
						<td>
						{{$tp->USERNAME_PROGRAMER}}
						</td>
						<td>
						{{$tp->DIVISI_PROGRAMER}}
						</td>
						<td>
						{{$tp->BIDANG_PROGRAMER}}
						</td>
						<td>
						<a href="{{url('manager/user/edit', $tp->id_programer)}}" class='btn btn-mini btn-warning tipsy-kiri-atas'>Edit</a> 
						|
						<a href= "{{url('manager/user/hapus', $tp->id_programer)}}"class='btn btn-mini btn-danger tipsy-kiri-atas'>Hapus</a></td>
                          
                        </tr>
						@endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection