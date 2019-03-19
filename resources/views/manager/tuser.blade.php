@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="{{url('/manager/user')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> Kembali</button></a>
                  <br/><br/>
               
			   <p></p>
			   
                  <p class="card-description" style="font-size:20px;" >
                    Form Tambah Programmer
                  </p>
				  
				 

                  <form class="forms-sample" action="{{url('manager/tambahuser')}}" method="post">
				  {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputName1">ID Programmer</label>
                      <input type="text" class="form-control" name="ID_PROGRAMER" value="{{$cetak}}" required="required" placeholder="ID_PROGRAMER">
                    </div>
                  <!-- <div class="form-group">
                      <label for="exampleTextarea1">ID Aplikasi</label>
                       <input type="text" class="form-control" name="id_aplikasi" required="required" placeholder="ID Aplikasi">
                    </div> -->
                    <div class="form-group">
                      <label for="exampleInputPassword4">User Name</label>
                      <input type="text" class="form-control" name="USERNAME_PROGRAMER" required="required" placeholder="USERNAME_PROGRAMER">
                    </div>
                 <div class="form-group">
                      <label for="exampleInputCity1">Password</label>
                      <input type="password" class="form-control" name="PASSWORD_PROGRAMER" required="required" placeholder="PASSWORD_PROGRAMER">
                    </div>
					<div class="form-group">
                      <label for="exampleInputCity1">Divisi</label>
                      <input type="text" class="form-control" name="DIVISI_PROGRAMER" required="required" placeholder="DIVISI_PROGRAMER">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Bidang</label>
                      <input type="text" class="form-control" name="BIDANG_PROGRAMER" required="required" placeholder="BIDANG_PROGRAMER">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Kirim</button>
                    <button class="btn btn-light">Batal</button>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
@endsection