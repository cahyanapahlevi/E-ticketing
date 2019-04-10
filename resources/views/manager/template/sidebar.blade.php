<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                 @foreach($foto as $f)
                  <img src="{{url('public/source/images/manager/'.$f->foto)}}" alt="profile image">
                  @endforeach
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{\Session::get('NAMA_MANAGER')}}</p>
                  <div>
                    <small class="designation text-muted">Manager</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
        <a class="nav-link" href="{{url('/manager/dticket')}}">
               <button class="btn btn-success btn-block">New Project
                <i class="mdi mdi-plus"></i>
              </button></a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/manager/home')}}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
      <!--Penambahan dropdown untuk tiket(rita)-->
         <li class="nav-item">
            <a class="nav-link"  data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-ticket"></i>
              <span class="menu-title">Ticket</span>
        <i class="menu-arrow"></i>
            </a>
      <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/manager/ticket')}}">Proyek Baru</a>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="{{url('/manager/dataaktifitas')}}">Data Aktifitas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/manager/aktifitas')}}">Aktivitas (To Do List)</a>
                </li>
              </ul>
            </div>
          </li>
            <!--Tambahan sidebar report rita-->
		   <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon fa fa-archive"></i>
              <span class="menu-title">Report</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/manager/report')}}"> Report Bulanan </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/manager/reportproyek')}}"> Report Per-Proyek </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/manager/reportorang')}}"> Report Per-Orang </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/manager/user')}}">
              <i class="menu-icon fa fa-user-o"></i>
              <span class="menu-title"> user</span>
            </a>
          </li>
        </ul>
      </nav>