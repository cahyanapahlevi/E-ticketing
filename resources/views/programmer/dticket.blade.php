@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="{{url('/programmer/aktifitas')}}"><button type="button" class="btn btn-outline-warning"> <i class="menu-icon mdi mdi-reply"></i> BACK</button></a>
                  <br/><br/>
                  <h4 class="card-title">Detail Ticket</h4>
                  <p class="card-description">
                    Pilihlah To Do List Yang Akan Dikerjakan
                  </p>
                  
                   
					<div class="form-group">
                      <label for="exampleInputCity1">Nama Proyek</label>
		<form class="forms-sample" action="{{url ('/programmer/dticket/caritiket')}}" method="get">
                      <select class="form-control" name="NAMA_PROYEK" id="NAMA_PROYEK">
					<option value="option_select" disabled selected>Nama Proyek</option>
					 @foreach ($tiket as $t)
                        <option value="{{ $t->NAMA_PROYEK }}">{{ $t->NAMA_PROYEK }}</option>
                    @endforeach
					
                    </select>
                    </div>

                    <button type="submit" class="btn btn-success mr-2"><i class="fa fa-search"></i> Cari</button>
                  </form>
          
                </div>
              </div>
            </div>
			@if(isset($details))
			<div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                         <th>
                            ID Tiket
                          </th>
						   <th>
                            Task
                          </th>
                          <th>
                            Aktifitas
                          </th>
						  <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
            @foreach($tiket2 as $u)
                          <td class="font-weight-medium">
              {{ $u->ID_TIKET}}
                          </td>
						  <td>
              {{ $u->TASK}}
                          </td>
                          <td>
              {{ $u->AKTIFITAS_TIKET}}
                          </td>
              <td> <a href="{{url('/programmer/ambiltiket',$u->ID_TIKET)}}">
                              <button class="btn btn-success mr-2"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i>Take it !!</button></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
					@elseif(isset($message))
			<p>{{ $message }}</p>
			@endif
                  </div>
                </div>
              </div>
            </div>
          </div>  
                </div>
@endsection