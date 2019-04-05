
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{url('/manager/home')}}">
          <img src="{{asset('source/images/kominfo.png')}}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <img src="{{asset('source/images/coco.png')}}" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-file-document-box"></i>
                
                <span class="count">{{$cek_project->count()}}</span>
            </a>
              <!------NOTIFIKASI---->
              
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <a class="dropdown-item" href="{{url('manager/ticket')}}">
                <p class="mb-0 font-weight-normal float-left">Anda mempunyai {{$cek_project->count()}} proyek terbaru
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
                
                 @foreach($cek_project as $cp)
                <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item" href="{{url('manager/baca',$cp->ID_PROYEK)}}">
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">{{$cp->NAMA_PROYEK}}</h6>
                    <span class="float-right font-weight-light small-text">Di, {{$cp->INSTANSI_PROYEK}}</span>
                  <br><br>
                  <p class="font-weight-light small-text">
                    {{$cp->DESKRIPSI_PROYEK}}
                  </p><br>
                </div>
              </a>
                 @endforeach
            </div>
               <!-----BATAS AKHIR----->
          </li>
          <li class="nav-item dropdown">
               
             <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                 <i class="mdi mdi-comment"></i>   
                
              <span class="count">!</span> 
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdow">
             
                <p class="mb-0 dropdown-item font-weight-normal float-left">5 komentar terbaru proyek saat ini
                </p>
             
                <p class="mb-0 font-weight-large float-left text-black">
                </p>
                @foreach($cek_komentar as $cek)
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item" href="{{url('manager/ticket/detail_tiket',$cek->ID_PROYEK)}}">
                <div class="preview-item-content flex-grow">
                    @if ($cek->USERNAME_PROGRAMER == NULL)
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">{{$cek->USERNAME_MANAGER}}</h6>
                    @elseif ($cek->USERNAME_MANAGER == NULL)
                    <h6 class="preview-subject ellipsis font-weight-medium text-dark">{{$cek->USERNAME_PROGRAMER}}</h6>
                    @else
                    <h6 class="preview-subject ellipsis font-weight-medium text-dark">NULL</h6>
                    @endif
                    <span class="float-right ellipsis font-weight-light mall-text">Di, {{$cek->NAMA_PROYEK}}</span><br>
                  <h4><p>
                     {{$cek->ISI_KOMENTAR}}
                  </p></h4>
                </div>
              </a>
                @endforeach
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">welcome, {{\Session::get('NAMA_MANAGER')}}</span>
              <img class="img-xs rounded-circle" src="{{asset('source/images/faces/face1.jpg')}}" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item mt-2" href="{{url('/manager/editprofil')}}">
                My Profile
              </a>
              <a class="dropdown-item" href="{{url('/manager/logout')}}">
                Sign Out
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>