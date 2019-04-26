@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                 <h4>DATA PROYEK</h4>
				 <a href="{{url('/manager/home')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> Kembali</button></a>
				 <p></p>
                    @foreach($proyek as $p)
                     <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td>ID Proyek</td><td>:</td><td>{{$p -> ID_PROYEK}}</td>
                        </tr>
                        <tr>
                            <td>Nama Proyek</td><td>:</td><td>{{$p -> NAMA_PROYEK}}</td>
                        </tr>
                        <tr>
                            <td>Instansi</td><td>:</td><td>{{$p -> INSTANSI_PROYEK}}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi Proyek</td><td>:</td><td>{{$p -> DESKRIPSI_PROYEK}}</td>
                        </tr>
                        <tr>
                            <td>Platform Proyek</td><td>:</td><td>{{$p -> PLATFORM_PROYEK}}</td>
                        </tr>
                        <tr>
                            <td>Deadline Proyek</td><td>:</td><td>{{$p -> DEADLINE_PROYEK}}</td>
                        </tr>
                        <tr>
                            <td>Status Proyek</td><td>:</td><td>{{$p -> STATUS_PROYEK}}</td>
                        </tr>
						<tr>
                            <td>Team</td><td>:</td><td>
@foreach($u3 as $z)
              {{ $z->USERNAME_MANAGER}}<br/>
                        @endforeach							
							
            @foreach($u2 as $v)
              {{ $v->USERNAME_PROGRAMER}}<br/>
                        @endforeach
				  
				  </td>
                        </tr>
                         </table>
                    </div>
                    @endforeach
                </div>
              </div>
            </div>

<br>    

    
@endsection