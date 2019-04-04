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
              {{ $t->ID_PROGRAMER}}
                          </td>
              <td> 
              {{ $t->PROGRAMER1}}
                          </td>
              <td> 
              {{ $t->PROGRAMER2}}
                          </td>
                          <td>
                            {{ $t->DEADLINE_PROYEK}}
                          </td>
              
                        </tr>
                        @endforeach
                      </tbody>
                    </table><br/>
          <!--Penambahan untuk pagination-->
  <small>Jumlah Data : {{ $page1->count() }}</small> <br/>
    {{ $page1->links() }}
      <script>
    window.print();
  </script>
  
    </body>
</html>