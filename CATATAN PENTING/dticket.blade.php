@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="{{url('/programmer/aktifitas')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> BACK</button></a>
                  <br/><br/>
                  <h4 class="card-title">Detail Ticket</h4>
                  <p class="card-description">
                    Pilihlah To Do List Yang Akan Dikerjakan
                  </p>
                  <form class="forms-sample" action="{{url ('programmer/tticket')}}" method="post">
				   {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputName1">ID Aktifitas</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="ID Aktifitas" name="id_tiket">
                    </div>
					<div class="form-group">
                      <label for="exampleInputCity1">Nama Proyek</label>
                      <select class="form-control" id="exampleFormControlSelect2" name="id_permintaan">
					<option value="option_select" disabled selected>Nama Proyek</option>
					@foreach($users as $user)
					<option value="{{ $user->id_permintaan}}">{{ $user->permintaan_app}}</option>
					@endforeach
					
                    </select>
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail3">Task</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Task" name="task">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Aktifitas (To Do List)</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Pilih To Do List yang akan dikerjakan" name="aktifitas">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Progress Aktifitas</label>
					  <input type="range" class="form-control" min="0" max="100" value="0" step="1" oninput="updateTextInput(this.value);" />
                      <input class="form-control" id="o1" placeholder="" name="progress">
                    </div>
                   <div class="form-group">
                      <label for="exampleInputPassword4">Timeline</label>
                      <input type="date" class="form-control" id="exampleInputEmail3" placeholder="" name="timeline2">
                    </div>
                    
                   
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
				  
				  
				  
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