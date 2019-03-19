@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="{{url('/programmer/ticket')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> BACK</button></a>
                  <br/><br/>
                  <h4 class="card-title">Detail Ticket</h4>
                  <p class="card-description">
                    Form Detail Ticket
                  </p>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputName1">Id_Tiket</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Nama Aplikasi</label>
                      <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Progress</label>
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
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