@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="{{url('/manager/ticket')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> BACK</button></a>
                  <br/><br/>
                  <h4 class="card-title">Tiket</h4>
                  <p class="card-description">
                    Form Prmintaan Tiket
                  </p>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputName1">Nama aplikasi</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                    </div>
                   <div class="form-group">
                      <label for="exampleTextarea1">Deskripsi Aplikasi</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Jenis Aplikasi</label>
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                    </div>
                 <div class="form-group">
                      <label for="exampleInputCity1">Programmer 1</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                    </div>
					<div class="form-group">
                      <label for="exampleInputCity1">Programmer 2</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Programmer 3</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
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