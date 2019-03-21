@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Permintaan Proyek</h4>
				  <!--Penambahan untuk memilih bulan dan tahun-->
				  <a href="{{url('/manager/report')}}"><button type="button" class="btn btn-primary btn-sm">Semua Data</button></a>
				  <p></p>
				  <form method="POST" class="form-inline" action="{{url('/manager/showreport')}}">
				  {{ csrf_field() }}
					<select name="month" class="form-control" required="required">
					<option value="">Pilih Bulan</option>
					<option value="01">January</option>
					<option value="02">February</option>
					<option value="03">March</option>
					<option value="04">April</option>
					<option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
					</select> &nbsp
					<select name="year" class="form-control">
					<?php
					$mulai= date('Y') - 50;
					for($i = $mulai;$i<$mulai + 100;$i++){
					$sel = $i == date('Y') ? ' selected="selected"' : '';
					echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
					}
					?>
					</select>
					&nbsp
					<button class="btn btn-primary btn-sm" name="filter"><i class="fa fa-search"></i> Search</button>					
					</form>
					<script>
					<button class="btn btn-primary btn-sm" name="cetak"><i class="fa fa-print"></i> Cetak</button>
		window.print();
	</script>
					
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
                            Instansi Proyek
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
                            Deadline Proyek
                          </th>
						  
                          
                        </tr>
                      </thead>
                      <tbody>
					  
                        <tr>
						@foreach ($page as $t)
                          <td class="font-weight-medium">
						  {{ $t->id_permintaan}}
                          </td>
                          <td>
						  {{ $t->permintaan_app}}
                          </td>
						  <td>
						  {{ $t->instansi}}
                          </td>
                          <td>
						  {{ $t->deskripsi}}
                          </td>
                          <td>
                            {{ $t->jenis_aplikasi}}
                          </td>
                          <td> 
						  {{ $t->programmer1}}
                          </td>
						  <td> 
						  {{ $t->programmer2}}
                          </td>
						  <td> 
						  {{ $t->id_programmer}}
                          </td>
                          <td>
                            {{ $t->timeline}}
                          </td>
							
                        </tr>
                        @endforeach
                      </tbody>
                    </table>					
                  </div><br/>
				  <!--Penambahan untuk pagination-->
	<small>Jumlah Data : {{ $page->total() }}</small> <br/>
				  <div class="pagination">
    {{ $page->links() }}
  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		
		
@endsection