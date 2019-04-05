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
                  <form class="forms-sample" action="{{url ('programmer/tticket')}}" method="post">
				   {{ csrf_field() }}
                   
					<div class="form-group">
                      <label for="exampleInputCity1">Nama Proyek</label>
                      <select class="form-control" name="NAMA_PROYEK" id="NAMA_PROYEK">
					<option value="option_select" disabled selected>Nama Proyek</option>
					 @foreach ($proyek as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
					
                    </select>
                    </div>

					<div class="form-group">
                      <label for="exampleInputEmail3">Task</label>
                      <select name="TASK" id="TASK"  class="form-control input-lg">
					  <option value="">pilih task</option>
					</select>
					 </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Aktifitas (To Do List)</label>
                       <select name="AKTIFITAS_TIKET" id="AKTIFITAS_TIKET" class="form-control input-lg ">
					  <option value="">pilih  aktifitas</option>
					</select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Progress Aktifitas</label>
					  <input type="range" class="form-control" min="0" max="100" value="0" step="1" oninput="updateTextInput(this.value);" />
                      <input class="form-control" id="o1" placeholder="" name="PROGRESS_TIKET">
                    </div>
                   <div class="form-group">
                      <label for="exampleInputPassword4">Timeline</label>
                      <input type="date" class="form-control" id="exampleInputEmail3" placeholder="" name="TIMELINE_TIKET">
                    </div>
                    
                   
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
          
          
          
                </div>
              </div>
            </div>
            </div>
          </div>  
                </div>
             
    
    
@endsection
<script>
function updateTextInput(val) {
	document.getElementById('o1').value=val + "%";
}
</script>

<!--<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="proyek"]').on('change', function() {
            var id_proyek = $(this).val();
            if(id_proyek) {
                $.ajax({
                    url: '/programmer/dticket/myform/ajax/'+id_proyek,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('select[name="TASK"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="TASK"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
						$('select[name="AKTIFITAS"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="AKTIFITAS"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });


                    }
                });
            }else{
                $('select[name="TASK"]').empty();
				$('select[name="AKTIFITAS"]').empty();
            }
        });
    });
</script>

-->

<script type="text/javascript">
    $('#NAMA_PROYEK').change(function(){
    var NAMA_PROYEK = $(this).val();    
    if(NAMA_PROYEK){
        $.ajax({
           type:"GET",
           url:"{{url('programmer/get-Task')}}?NAMA_PROYEK="+NAMA_PROYEK,
           success:function(res){               
            if(res){
                $("#TASK").empty();
                $("#TASK").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#TASK").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#TASK").empty();
            }
           }
        });
    }else{
        $("#TASK").empty();
        $("#AKTIFITAS_TIKET").empty();
    }      
   });
    $('#TASK').on('change',function(){
    var TASK = $(this).val();    
    if(TASK){
        $.ajax({
           type:"GET",
           url:"{{url('programmer/get-Aktifitas_Tiket')}}?TASK="+TASKID,
           success:function(res){               
            if(res){
                $("#AKTIFITAS_TIKET").empty();
                $.each(res,function(key,value){
                    $("#AKTIFITAS_TIKET").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#AKTIFITAS_TIKET").empty();
            }
           }
        });
    }else{
        $("#AKTIFITAS_TIKET").empty();
    }
        
   });
</script>



