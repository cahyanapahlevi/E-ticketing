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
				  
				 

                  
				  @foreach($tabel_programer as $tp)
				  <form action="{{url('/manager/user/update')}}" method="post">
				  {{ csrf_field() }}
                    <div class="form-group">
                      
                      <input type="hidden" class="form-control" name="id_software}}"   value ="{{$tp->id_software}}" required="required" placeholder="ID Software" readonly>
                    </div> 
                <!--   <div class="form-group">
                      <label for="exampleTextarea1">ID Aplikasi</label>
                       <input type="text" class="form-control" name="id_aplikasi"  value ="{{$tp->id_aplikasi}}" required="required" placeholder="ID Aplikasi">
                    </div> -->
                    <div class="form-group">
                      <label for="exampleInputPassword4">User Name</label>
                      <input type="text" class="form-control" name="username_software" value ="{{$tp->username_software}}" required="required" placeholder="UserName Software">
                    </div>
                 <div class="form-group">
                      <label for="exampleInputCity1">Password</label>
                      <input type="password" class="form-control" name="password_software" value ="{{$tp->password_software}}" required="required" placeholder="Password">
                    </div>
					<div class="form-group">
                      <label for="exampleInputCity1">Divisi</label>
                      <input type="text" class="form-control" name="divisi_software" value ="{{$tp->divisi_software}}"  required="required" placeholder="Divisi">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Bidang</label>
                      <input type="text" class="form-control" name="bidang_software" value ="{{$tp->bidang_software}}"  required="required" placeholder="Bidang">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Kirim</button>
                    <button class="btn btn-light">Batal</button>
                  </form>
				  @endforeach
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
@endsection