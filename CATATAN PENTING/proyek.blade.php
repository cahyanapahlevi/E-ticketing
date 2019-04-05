@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar AKtifitas (To Do List) Yang Sedang Dikerjakan Programmer</h4>
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
                            Instansi
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
						@foreach ($pm as $s)
                           <td>
                            {{ $s->ID_PROYEK}}
                          </td>
                          <td>
                            {{ $s->NAMA_PROYEK}}
                          </td>
							<td>
                            {{ $s->INSTANSI_PROYEK}}
                          </td>						  
						  
                        </tr>
            @endforeach
                      </tbody>
                    </table>
					<small>Jumlah Data : {{ $pm->total() }}</small> <br/>
				  <div class="pagination">
					{{ $pm->links() }}
					</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection