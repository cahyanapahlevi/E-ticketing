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
                            Dedline
                          </th>
              <th>
                            Status
                          </th>
                          <th>
                            Detail
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
                            {{ $t->DEADLINE_PROYEK}}
                          </td>
              <td>
              <div class="ticket-actions col-md-2">
                        <div class="btn-group dropdown">
            @if ($t->STATUS_PROYEK === 'Open')
    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fa fa-check fa-fw"></i> {{ $t->STATUS_PROYEK}}
                          </button>
@elseif ($t->STATUS_PROYEK === 'On Progress')
    <button type="button" class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-history fa-fw"></i> {{ $t->STATUS_PROYEK}}
                          </button>
@elseif ($t->STATUS_PROYEK === 'Closed')
    <button type="button" class="btn btn-danger dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-times  fa-fw"></i> {{ $t->STATUS_PROYEK}}
                          </button>
@else
   <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fa fa-check fa-fw"></i> {{ $t->STATUS_PROYEK}}
                          </button>
@endif
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('manager/open',$t->ID_PROYEK)}}">
                              <i class="fa fa-check text-success fa-fw"></i>Open</a>
                            <a class="dropdown-item" href="{{url('manager/progress',$t->ID_PROYEK)}}">
                              <i class="fa fa-history fa-fw"></i>On Progress</a>
                            <a class="dropdown-item" href="{{url('manager/closed',$t->ID_PROYEK)}}" >
                              <i class="fa fa-times text-danger fa-fw"></i>Closed</a>
                          </div>
                        </div>
                      </div>
               
                          </td>
                          <td>
                             <a href="{{url('manager/ticket/detail_tiket', $t->ID_PROYEK)}}" class='btn btn-mini btn-warning tipsy-kiri-atas'>DETAIL</a>
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