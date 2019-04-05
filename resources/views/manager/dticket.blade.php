@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="{{url('/manager/ticket')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> BACK</button></a>
                  <br/><br/>
                  <h4 class="card-title">Tiket</h4>
                  <p class="card-description">
                    Form Permintaan Tiket
                  </p>
                  <form class="forms-sample" action="{{url ('manager/tticket')}}" method="post">
          {{ csrf_field() }}
          <div class="form-group">
                      <label for="exampleInputName1">ID Proyek</label>
                      <input type="text" class="form-control" id="exampleInputName1"  value="{{$cetak}}" placeholder="ID PROYEK" name="ID_PROYEK" readonly >
                      
                      <input type="hidden" class="form-control" id="exampleInputName1"  value="{{\Session::get('ID_MANAGER')}}" name="ID_MANAGER">
                      
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Nama Proyek</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="NAMA PROYEK" name="NAMA_PROYEK" >
                    </div>
          <div class="form-group">
                      <label for="exampleInputName1">Instansi</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="INSTANSI PROYEK" name="INSTANSI_PROYEK" >
                    </div>
                   <div class="form-group">
                      <label for="exampleTextarea1">Deskripsi Proyek</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="2" name="DESKRIPSI_PROYEK" ></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Platform Proyek</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="PLATFORM_PROYEK" name="PLATFORM_PROYEK" >
                    </div>
          <div class="form-group">
                      <label for="exampleInputCity1">Programer</label>          
          <select class="form-control js-example-basic-multiple" name="ID_PROGRAMER[]" multiple="multiple">
            
                  @foreach($users as $user)
          <option value="{{ $user->ID_PROGRAMER}}">{{ $user->USERNAME_PROGRAMER}}</option>
          @endforeach
                </select>
                    </div>
           <div class="form-group">
                      <label for="exampleInputCity1">Deadline</label>
                      <input type="date" class="form-control" id="exampleInputCity1" placeholder="DEADLINE_PROYEK" name="DEADLINE_PROYEK" >
                    </div>
          <div class="form-group">
                      <label for="exampleInputCity1">Status</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="STATUS PROYEK" name="STATUS_PROYEK" >
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Kirim</button>
                    
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
@endsection
