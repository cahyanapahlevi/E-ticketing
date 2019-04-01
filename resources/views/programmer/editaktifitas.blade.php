@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Data Aktifitas</h4>
				  <a href="{{url('/programmer/aktifitas')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> BACK</button></a>
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
					  @foreach ($eaktif as $s)
					  <form action="{{url('/programmer/updateaktifitas')}}" method="post">
					{{ csrf_field() }}
                      <tbody><input type="hidden"  name="ID_TIKET" value="{{ $s->ID_TIKET }}">
					 
                        <tr>
						
                          <!--td>
                             
                          </td-->
                          <td>
                            <input type="text"  name="NAMA_PROYEK" value="{{ $s->NAMA_PROYEK }}">
                          </td>
						  <td>
                             <input type="text"  name="TASK" value="{{ $s->TASK }}">
                          </td>
						 
                          <td>
                             <input type="text"  name="AKTIFITAS_TIKET" value="{{ $s->AKTIFITAS_TIKET }}">
                          </td>
						   <td>
                             <label for="exampleInputPassword4">Progress Aktifitas</label>
					         <input type="range" class="form-control" min="0" max="100" value="{{ $s->PROGRESS_TIKET }}" step="1" oninput="updateTextInput(this.value);" />
                             <input class="form-control" id="o1" placeholder=""  value="{{ $s->PROGRESS_TIKET }}" name="PROGRESS_TIKET">
                          </td>
						  <td>
                             <input type="date"  name="TIMELINE_TIKET" value="{{ $s->TIMELINE_TIKET }}">
                          </td>
                         <td>
						 <button type="submit" class="btn btn-primary btn-dm">Simpan</button>
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
<script>
function updateTextInput(val) {
	document.getElementById('o1').value=val + "%";
}
</script>