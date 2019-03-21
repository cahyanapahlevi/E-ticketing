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
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputName1">ID Aktifitas</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="ID AKtifitas">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail3">Task</label>
                      <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Pilih To Do List yang akan dikerjakan">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Aktifitas (To Do List)</label>
                      <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Pilih To Do List yang akan dikerjakan">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Progress Aktifitas</label>
                      <input type="range" class="form-control" id="exampleInputPassword4" placeholder="">
                    </div>
                   <div class="form-group">
                      <label for="exampleInputPassword4">Timeline</label>
                      <input type="date" class="form-control" id="exampleInputPassword4" placeholder="">
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