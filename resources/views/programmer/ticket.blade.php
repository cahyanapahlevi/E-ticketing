@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ticket Masuk</h4>
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
                            Instansi Proyek
                          </th>
                          <th>
                            Deskripsi Proyek
                          </th>
                          <th>
                            Platform Proyek
                          </th>
                          
              <th>
                            Deadline Proyek
                          </th>
              <th>
                            Status Proyek
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
                            <a class="dropdown-item" href="{{url('programmer/open',$t->ID_PROYEK)}}">
                              <i class="fa fa-check text-success fa-fw"></i>Open</a>
                            <a class="dropdown-item" href="{{url('programmer/progress',$t->ID_PROYEK)}}">
                              <i class="fa fa-history fa-fw"></i>On Progress</a>
                            <a class="dropdown-item" href="{{url('programmer/closed',$t->ID_PROYEK)}}" >
                              <i class="fa fa-times text-danger fa-fw"></i>Closed</a>
                          </div>
                        </div>
                      </div>
               
                          </td>
                          <td>
                             <a href="{{url('programmer/ticket/detail_tiket', $t->ID_PROYEK)}}" class='btn btn-mini btn-warning tipsy-kiri-atas'>DETAIL</a>
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