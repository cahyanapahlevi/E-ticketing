<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <title>laporan</title>
</head>

<body>
  <center>
 
    <h2>Data Permintaan Proyek</h2>
  </center>
                    <table  border="1" style="width: 100%">
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
            @foreach ($page1 as $t)
                          <td >
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
                    </table><br/>
          <!--Penambahan untuk pagination-->
  <small>Jumlah Data : {{ $page1->total() }}</small> <br/>
    {{ $page1->links() }}
      <script>
    window.print();
  </script>
  
    </body>
</html>