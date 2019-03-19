@extends('manager.master')

@section('manager.content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Lihat Data</h4>
                  <form action="" method="post">  
 <input type="radio" name="buah" value="Apel" checked>Semua Data<br/>    
</form> 
<br>
 <form action="" method="post">  
 <input type="radio" name="buah" value="Apel" checked>Dari Bulan<br/>    
</form> 
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection