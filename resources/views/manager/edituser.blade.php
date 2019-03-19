@extends('manager.master')

@section('manager.content')



        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="{{url('/manager/home')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> BACK</button></a>
                  <br/><br/>
                  <h4 class="card-title">Basic form</h4>
                  <p class="card-description">
                    Basic form elements
                  </p>
                  <form class="forms-sample" action="{{url('/manager/tambah')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputName1">ID</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{ $cetak }}" name="id_manager">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">nama manager</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="nama" name="nama_manager">
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail3">pass manager</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="pass" name="pass">
                    </div>
                   <div class="form-group">
                      <label for="exampleInputEmail3">alamat manager</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="alamat" name="alamat">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
@endsection