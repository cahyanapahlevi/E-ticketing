@extends('programmer.master')

@section('programmer.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Project Yang Sedang Dikerjakan</h4>
          <a href="{{url('/programmer/dproject')}}"><button type="button" class="btn btn-outline-success">Tambah Project</button></a>
          <p></p>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
						<th>
                            No
                          </th>
                       
                          <th>
                            Nama Project
                          </th>
                          <th>
                            Instansi
                          </th>
                          <th>
                            Deskripsi
                          </th>
                          <th>
                            Platforn
                          </th>
                          <th>
                            Dedline
                          </th>
                          <th>
                            Status
                          </th>
						  <th>
                            Aktifitas Tiket
                          </th>
						   <th>
                            Progress
                          </th>
						  <th>
                            Timeline
                          </th>
						   <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
					  @php $no = 1; @endphp
					  @foreach ($proyek as $p)
                        <tr>
                          <td>
                          {{$no++}}
                          </td>
                        
                          <td>
						  {{$p->NAMA_PROYEK}}
                          </td>
                          <td>
						  {{$p->INSTANSI_PROYEK}}
                          </td>
                          <td > 
                           {{$p->DESKRIPSI_PROYEK}}
                          </td>
                          <td>
                            {{$p->PLATFORM_PROYEK}}
                          </td>
						  <td>
						  {{$p->DEADLINE_PROYEK}}
						  </td>
						  <td>
						  {{$p->STATUS_PROYEK}}
						  </td>
						  <td>
						  {{$p->AKTIFITAS_TIKET}}
						  </td>
						  <td>
						  {{$p->PROGRESS_TIKET}}
						  </td>
						  <td>
						  {{$p->TIMELINE_TIKET}}
						  </td>
                          <td>
						<a href="{{url('programmer/project/edit', $p->ID_PROYEK)}}" class='btn btn-mini btn-warning tipsy-kiri-atas'>Edit</a> 
						|
						<a href= "{{url('programmer/project/hapus', $p->ID_PROYEK)}}"class='btn btn-mini btn-danger tipsy-kiri-atas'>Hapus</a></td>
			  @endforeach
             
             
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
<script>
$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}
</script>