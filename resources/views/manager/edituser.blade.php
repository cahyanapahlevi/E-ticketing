@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="{{url('/manager/home')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> Kembali</button></a>
                  <br/><br/>
               
			   <p></p>
			   
                  <p class="card-description" style="font-size:20px;" >
                    Form Edit Profile
                  </p>
				  
				 

                  
				  @foreach($tabel_manager as $m)
				  <form action="{{url('/manager/profile/update_profile')}}" method="post">
				  {{ csrf_field() }}
                    <div class="form-group">
                      
                      <input type="hidden" class="form-control" name="ID_MANAGER"   value ="{{$m->ID_MANAGER}}" required="required" placeholder="ID MANAGER" readonly>
                    </div> 
               
                    <div class="form-group">
                      <label for="exampleInputPassword4">User Name</label>
                      <input type="text" class="form-control" name="USERNAME_MANAGER" value ="{{$m->USERNAME_MANAGER}}" required="required" placeholder="USERNAME MANAGER">
                    </div>
                 <div class="form-group">
                      <label for="exampleInputCity1">Password</label>
                      <input type="password" class="form-control" name="PASSWORD_MANAGER" value ="{{$m->PASSWORD_MANAGER}}" required="required" placeholder="PASSWORD MANAGER">
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