@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Data Aktifitas</h4>
				  <a href="{{url('/manager/dataaktifitas')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> BACK</button></a>
					<p></p>
					
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                         <!--th>
                            ID Tiket
                          </th-->
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
						  Action
						  </th>
                          
                          
                        </tr>
                      </thead>
					  @foreach ($eaktif as $s)
					  <form action="{{url('/manager/updateaktifitas')}}" method="post">
					{{ csrf_field() }}
                      <tbody><input type="hidden" required="required" name="ID_TIKET" value="{{ $s->ID_TIKET }}">
					  <input type="hidden" required="required" name="ID_PROYEK" value="{{ $s->ID_PROYEK }}">
                        <tr>
						
                          <!--td>
                             
                          </td-->
                          <td>
                            <input type="text" required="required" name="NAMA_PROYEK" value="{{ $s->NAMA_PROYEK }}">
                          </td>
						  <td>
                             <input type="text" required="required" name="TASK" value="{{ $s->TASK }}">
                          </td>
                          <td>
                             <input type="text" required="required" name="AKTIFITAS_TIKET" value="{{ $s->AKTIFITAS_TIKET }}">
                          </td>
                         <td>
						 <button type="submit" class="btn btn-primary btn-dm">Edit</button>
						 </td>
						  
                        </tr>
           
                      </tbody>
					  </form>
					   @endforeach
                    </table>
					<small>Jumlah Data :{{ $eaktif->total() }}</small> <br/>
				  <div class="pagination">
					{{ $eaktif->links() }}
					</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection