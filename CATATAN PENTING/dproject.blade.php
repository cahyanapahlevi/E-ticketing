@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="{{url('/programmer/project')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> BACK</button></a>
                  <br/><br/>
                  <h4 class="card-title">Detail Project</h4>
                  <p class="card-description">
                    Form Project Programmer
                  </p>
                  <form class="forms-sample">
				  <div class="form-group">
                      <label for="exampleInputName1">ID Proyek</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Id Proyek" name="id_proyek" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Nama Proyek</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Nama Proyek" name="nama_proyek">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Instansi</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Instansi" name="instansi" >
                    </div>
					<div class="form-group">
                      <label for="exampleTextarea1">Deskripsi Proyek</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="2" name="deskripsi" ></textarea>
                    </div>
					<div class="form-group">
                      <label for="exampleInputName1">Platform Proyek</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Platform Proyek" name="platform_proyek" >
                    </div>
					 <div class="form-group">
                      <label for="exampleInputCity1">Dedline</label>
                      <input type="date" class="form-control" id="exampleInputCity1" placeholder="Dedline" name="dedline" >
                    </div>
					<div class="form-group">
                      <label for="exampleInputCity1">Status</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="Status" name="status" >
                    </div>
					<div class="form-group">
                      <label for="exampleInputCity1">Aktifitas</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="To Do List" name="aktifitas_tiket" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Progress</label>
                      <input type="range" class="form-control" max="100" min="1" id="exampleInputCity1" placeholder="Progress" name="progress_tiket" >
                    </div>
                  <div class="form-group">
                      <label for="exampleInputCity1">Timeline Aktifitas</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="Timeline Aktifitas" name="timeline_tiket" >
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