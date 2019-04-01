@extends('manager.master')

@section('manager.content')
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
                      <tbody><input type="hidden" required="required" name="id_tiket" value="{{ $s->id_tiket }}">
					 
                        <tr>
						
                          <!--td>
                             
                          </td-->
                          <td>
                            <input type="text" required="required" name="permintaan_app" value="{{ $s->permintaan_app }}">
                          </td>
						  <td>
                             <input type="text" required="required" name="task" value="{{ $s->task }}">
                          </td>
						 
                          <td>
                             <input type="text" required="required" name="aktifitas" value="{{ $s->aktifitas }}">
                          </td>
						   <td>
                             <label for="exampleInputPassword4">Progress Aktifitas</label>
					         <input type="range" class="form-control" min="0" max="100" value="{{ $s->progress }}" step="1" oninput="updateTextInput(this.value);" />
                             <input class="form-control" id="o1" placeholder=""  value="{{ $s->progress }}" name="progress">
                          </td>
						  <td>
                             <input type="date" required="required" name="timeline2" value="{{ $s->timeline2 }}">
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
<script>
function updateTextInput(val) {
	document.getElementById('o1').value=val + "%";
}
</script>