@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Permintaan Proyek Baru</h4>
          <a href="{{url('/manager/dticket')}}"><button type="button" class="btn btn-outline-success">Tambah Proyek</button></a>
          <p></p>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            ID Proyek
                          </th>
                          <th>
                            Nama Proyek
                          </th>
               <th>
                            Instansi
                          </th>
                          <th>
                            Deskripsi Proyek
                          </th>
                          <th>
                            Platform Proyek
                          </th>
                          <th>
                            Programmer1
                          </th>
                          <th>
                            Programmer2
                          </th>
              <th>
                            Programmer3
                          </th>
              <th>
                            Dedline
                          </th>
              <th>
                            Status
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
            
                        <tr>
            @foreach ($lihat as $t)
                          <td class="font-weight-medium">
              {{ $t->ID_PROYEK}}
                          </td>
                          <td>
              {{ $t->NAMA_PROYEK}}
                          </td>
              <td>
              {{ $t->INSTANSI_PROYEK}}
                          </td>
                          <td>
              {{ $t->DESKRIPSI_PROYEK}}
                          </td>
                          <td>
                            {{ $t->PLATFORM_PROYEK}}
                          </td>
                          <td> 
              {{ $t->PROGRAMMER1}}
                          </td>
              <td> 
              {{ $t->PROGRAMMER2}}
                          </td>
              <td> 
              {{ $t->ID_PROGRAMMER}}
                          </td>
                          <td>
                            {{ $t->DEADLINE_PROYEK}}
                          </td>
              <td>
                            {{ $t->STATUS_PROYEK}}
              <button type="button" class="btn btn-icons btn-inverse-primary" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-refresh"></i></button>
  
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <form action="{{url('manager/update')}}" method="post">
       {{ csrf_field() }}
       <input type="hidden" name="ID_PROYEK" value="{{$t->ID_PROYEK}}" >
        <input type="text" class="form-control" id="exampleInputCity1" placeholder="Status" name="STATUS_PROYEK" value="{{ $t->STATUS_PROYEK}}" readonly></input>
        
        <input type="radio" class="flat" name="STATUS_PROYEK"  value="$t->STATUS_PROYEK" checked>Open
                          
<br>
<input type="radio" value="progress" class="flat" name="STATUS_PROYEK" value="Progress">Progress
                         
<br>
<input type="radio" value="done" class="flat" name="STATUS_PROYEK" value="Done">Done
          <br>                 
      <input type="submit" class="btn btn-primary btn-fw" data-dismiss="modal" name="submit">  
    </form> 
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          
        </div>
        
      </div>
    </div>
  </div>
                          </td>
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
          <br/>
          <!--Penambahan untuk pagination (rita)-->
  <small>Jumlah Data : {{ $lihat->total() }}</small> <br/>
          <div class="pagination">
          {{ $lihat->links() }}
          </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
    
@endsection