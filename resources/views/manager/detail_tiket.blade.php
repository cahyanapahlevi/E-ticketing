@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                 <h4>DATA PROYEK</h4>
				 <a href="{{url('/manager/ticket')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> Kembali</button></a>
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
                         </table>
                    </div>
                    @endforeach
                </div>
              </div>
            </div>
              
              
              
<!-------------------Comment Section------->
<div class="col-lg-12 grid-margin">
    
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
<div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
                
              <div class="card">
                  <strong><h4>COMMENT BOX</h4></strong>
                    <table class="table table-bordered">
              @foreach($komentar as $k)
             
<tr>
               <td>
    <form>
 
		<div class="media">
			<div class="media-body">
				
                    <input type="hidden" name="ID_KOMENTAR" value="{{$k->ID_KOMENTAR}}">
				@if ($k->ID_PROGRAMER == NULL)
                    <strong>{{$k->USERNAME_MANAGER}}</strong><br>
                    @elseif ($k->ID_MANAGER == NULL)
                    <strong>{{$k->USERNAME_PROGRAMER}}</strong><br>
                    @else
                    <strong>NULL</strong><br>
                    @endif
					<small>
						{{$k->TGL_KOMENTAR}} 
					</small>
			 <p>{{$k->ISI_KOMENTAR}}</p>
			</div>
		</div>    
     
    </form>
                   </td>
     </tr>
             
              @endforeach
                        </table>
                     
                </div>
              </div>
                   </div>
                  </div>
              </div>
                </div>
             
             
            @foreach($proyek as $tpr)
              <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
            <form action="{{url('manager/ticket/tambah_komen')}}" method="POST">
                
                 {{ csrf_field() }}
                
         
                <input hidden type = "text" name = "ID_PROYEK" value="{{$tpr->ID_PROYEK}}">
               
                    <textarea name ="ISI_KOMENTAR" placeholder = "Message" cols="100" rows="5"></textarea>
               <br>
                 <div class="form-group">
                            <input type="submit" class="btn btn-warning" name="submit" value="Add Comment" />
                        </div>
            </form>
                    </div>
   </div>
              </div>
                 </div>
              </div>
           
            @endforeach
           
            </div>
              <br>
    </div>
    
<!------------Form Start---------->


<br>    

    
@endsection