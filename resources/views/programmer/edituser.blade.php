@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="{{url('/programmer/home')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> Kembali</button></a>
                  <br/><br/>
               
			   <p></p>
			   
                  <p class="card-description" style="font-size:20px;" >
                    Form Edit Profile
                  </p>
				  
				 

                  
				  @foreach($tabel_programmer as $p)
				  <form action="{{url('/programmer/profile/update_profile')}}" method="post">
				  {{ csrf_field() }}
                    <div class="form-group">
                      
                      <input type="hidden" class="form-control" name="ID_PROGRAMER"   value ="{{$p->ID_PROGRAMER}}" required="required" placeholder="ID PROGRAMMER" readonly>
                    </div> 
               
                    <div class="form-group">
                      <label for="exampleInputPassword4">User Name</label>
                      <input type="text" class="form-control" name="USERNAME_PROGRAMER" value ="{{$p->USERNAME_PROGRAMER}}" required="required" placeholder="USERNAME PROGRAMMER">
                    </div>
                 <div class="form-group">
                      <label for="exampleInputCity1">Password</label>
                      <input type="password" class="form-control" name="PASSWORD_PROGRAMER" value ="{{$p->PASSWORD_PROGRAMER}}" required="required" placeholder="PASSWORD PROGRAMMER">
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