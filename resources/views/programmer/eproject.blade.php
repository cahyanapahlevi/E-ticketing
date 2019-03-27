@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <!---->
                  <a href="{{url('/programmer/project')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> Kembali</button></a>
                  <br/><br/>
			
			   
                  <p class="card-description" style="font-size:20px;" >
                    Form Edit Proyek
                  </p>
				     	
				  <form action="{{url('/programmer/updateproject')}}" method="post">
				  {{ csrf_field() }}
				  @foreach($p as $t)
          <div class="form-group">
                      <label for="exampleInputName1">ID Proyek</label>
                      <input type="text" input type = "hidden" class="form-control" id="exampleInputName1" placeholder="Id Proyek" value="{{$t->ID_PROYEK}}" name="ID_PROYEK" readonly ><br/>
					   <input type="text" input type = "hidden" value="{{$t->ID_TIKET}}" name="ID_TIKET"readonly  >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Nama Proyek</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="NAMA_PROYEK" value = "{{$t->NAMA_PROYEK}}" required="required" placeholder="Nama Proyek" > 
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Instansi</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="INSTANSI_PROYEK" value = "{{$t->INSTANSI_PROYEK}}" required="required"  placeholder="Instansi" >
                    </div>
          <div class="form-group">
                      <label for="exampleTextarea1">Deskripsi Proyek</label>
                      <textarea class="form-control" id="exampleTextarea1" name="DESKRIPSI_PROYEK" equired="required"  rows="2" >{{$t->DESKRIPSI_PROYEK}}</textarea>
                    </div>
          <div class="form-group">
                      <label for="exampleInputName1">Platform Proyek</label>
                      <input type="text" class="form-control" id="exampleInputName1"  name="PLATFORM_PROYEK" value = "{{$t->PLATFORM_PROYEK}}" required="required" placeholder="Platform Proyek" >
                    </div>
           <div class="form-group">
                      <label for="exampleInputCity1">Dedline</label>
                      <input type="date" class="form-control" id="exampleInputCity1" placeholder="Dedline" name="DEADLINE_PROYEK" value = "{{$t->DEADLINE_PROYEK}}" required="required" >
                    </div>
          <div class="form-group">
                      <label for="exampleInputCity1">Status</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="Status" name="STATUS_PROYEK" value = "{{$t->STATUS_PROYEK}}" required="required" >
                    </div>
			<div class="form-group">
                      <label for="exampleInputCity1">Aktifitas</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="To Do List" name="AKTIFITAS_TIKET" value = "{{$t->AKTIFITAS_TIKET}}" required="required" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Progress</label>
                      <input type="range" class="form-control" min="0" max="100" value="0" step="1" oninput="updateTextInput(this.value);"  />
					  <input name="PROGRESS_TIKET" value = "{{$t->PROGRESS_TIKET}}" required="required" class="form-control" id="o1">
                    </div>
                  <div class="form-group">
                      <label for="exampleInputCity1">Timeline Tiket</label>
                      <input type="date" class="form-control" id="exampleInputCity1" placeholder="Timeline Aktifitas" name="TIMELINE_TIKET" value = "{{$t->TIMELINE_TIKET}}" required="required" >
                    </div>
         
                    
                  
					<button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
					@endforeach
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
  document.getElementById('o1').value=val + " %";
}
</script>