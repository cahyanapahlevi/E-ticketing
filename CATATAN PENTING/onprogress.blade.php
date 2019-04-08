@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar Aktifitas (To Do List) yang Dalam Progress</h4>
				   <p></p>
					
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                         <th>
                            ID Tiket
                          </th>
						  <th>
                            Task
                          </th>
                          <th>
                            Aktifitas
                          </th>
						  <th>
                            Progress
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
						@foreach ($op as $s)
                           <td>
                            {{ $s->ID_TIKET}}
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
					<small>Jumlah Data : {{ $op->total() }}</small> <br/>
				  <div class="pagination">
					{{ $op->links() }}
					</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection