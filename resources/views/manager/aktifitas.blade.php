@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar AKtifitas (To Do List) Yang Sedang Dikerjakan Programmer</h4>
				  
				  <p></p>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                         <th>
                            ID Tiket
                          </th>
						  <th>
                            Nama Proyek
                          </th>
                          <th>
                            Task
                          </th>
						  <th>
                            Aktifitas (To Do List)
                          </th>
                          <th>
                            Progress 
                          </th>
                          <th>
                            Timeline
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="font-weight-medium">
                            1
                          </td>
                          <td>
                            Herman Beck
                          </td>
                          <td>
                            Aplikasi Mencari Jodoh
                          </td>
                          <td>
                            0%
                          </td>
                          <td class="text-danger"> 53.64%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
						  <td>
						  </td>
                    </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

<hr><br>
<hr>
<strong><h3>COMMENT BOX</h3></strong>

<!-------------------Comment Section------->
<div id='form'>
<div class="content-wrapper">
          <div class="row">
             
              @foreach($tabel_komen as $tk)

            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
    <form>
         
        <li class="comment even thread-even depth-1 media mb-4">
		<div class="media">
			<div class="media-body">
				
                    <input type="hidden" name="id_komen" value="{{$tk->ID_KOMENTAR}}">
					@if ($tk->USERNAME_MANAGER == NULL)
                <h4><strong>{{$tk->USERNAME_PROGRAMER}}</strong></h4>
                @elseif($tk->USERNAME_PROGRAMER == NULL)
                <h4><strong>{{$tk->USERNAME_MANAGER}}</strong></h4>
                @endif
					<small>
						{{$tk->TGL_KOMENTAR}} 
					</small><br><br>
			<p>{{$tk->ISI_KOMENTAR}}    </p>
					    
				
			</div>
		</div>    
	</li>
        
         
    </form>
      </div>
                   </div>
                </div>
                
            </div>
           @endforeach

              <br>
            
              <div class="row">
        <div class="col-md-12">
            
            @foreach($tabel_proyek as $tpr)
            <li class="comment even thread-even depth-1 media mb-4">
		<div class="media">
			<div class="media-body">
            <form action="{{url('manager/aktifitas/tambah_komen')}}" method="POST">
                
                 {{ csrf_field() }}
                
                    <input hidden type = "text" name = "id_manager" value="{{Session::get('ID')}}">
                 <input hidden type = "text" name = "id_proyek" value="{{$tpr->ID_PROYEK}}">
               
                    <textarea name ="komentar" class="comment-body" placeholder = "Message" cols="100" rows="5"></textarea>
               <br>
                 <div class="form-group">
                            <input type="submit" class="btn btn-warning" name="submit" value="Add Comment" />
                        </div>
            </form>
                </div>
		</div>    
	</li>
        
            @endforeach
        </div>
    </div>
   
           
    </div>
    
<!------------Form Start---------->


<br>    
    </div>

</div>
              </div>        
              </div>
               </div>
@endsection