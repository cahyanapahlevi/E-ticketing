@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Aktifitas</h4>
				  <a href="{{url('/programmer/dataaktifitas')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> BACK</button></a>
				 
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
						   
                          
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
						@foreach ($daktif as $s)
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
						  
						 
                         
						  
                        </tr>
            @endforeach
                      </tbody>
                    </table>
					<small>Jumlah Progress Aktifitas :{{ $sum }} %</small> <br/>
					<small>Progress Proyek :{{ $avg }} %</small> <br/>
					<small>Jumlah Data :{{ $daktif->total() }}</small> <br/>
				  <div class="pagination">
					{{ $daktif->links() }}
					</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection