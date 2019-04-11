@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="{{url('/manager/dataaktifitas')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> BACK</button></a>
                  <br/><br/>
                  <h4 class="card-title">Deskripsi Aktifitas Tentang Proyek</h4>
                  
                  <form class="forms-sample" action="{{url ('manager/tambahaktifitas2')}}" method="post">
				  {{ csrf_field() }}
				  <div class="form-group">
                      <label for="exampleInputCity1">Nama Proyek</label>
                      <select class="form-control" id="exampleFormControlSelect2" name="ID_PROYEK">
					<option value="option_select" disabled selected>Proyek</option>
					@foreach($aktif as $a)
					<option value="{{ $a->ID_PROYEK}}">{{ $a->NAMA_PROYEK}}</option>
					@endforeach
					</select>
                    </div>
				  <div class="form-group">
                      <label for="exampleInputName1">ID Tiket</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Id Tiker" name="ID_TIKET" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Task</label>
					  <select placeholder="Nama Aplikasi" name="Task" class="form-control">

<?php 
for($i=1; $i<=10; $i++)
{
	//$sel = 'Task';
    echo '<option value="Task '.$i.'">Task '.$i.'</option>';
}
?>    
</select> 
                      
                    </div>
					<div class="form-group">
                      <label for="exampleInputName1">Aktifitas (To Do List)</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="INSTANSI PROYEK" name="AKTIFITAS_TIKET" >
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                    
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
@endsection