<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="{{asset('source/images/faces/face1.jpg')}}" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">Richard V.Welsh</p>
                  <div>
                    <small class="designation text-muted">Programmer</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/programmer/home')}}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Ticket</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/programmer/ticket')}}">Proyek Baru</a>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="{{url('/programmer/dataaktifitas')}}">Data Aktifitas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/programmer/aktifitas')}}">Aktivitas (To Do List)</a>
                </li>
              </ul>
            </div>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link" href="{{url('/programmer/ticket')}}">
              <i class="menu-icon mdi mdi-ticket"></i>
              <span class="menu-title">Ticket</span>
            </a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="{{url('/programmer/project')}}">
              <i class="menu-icon mdi mdi-cube"></i>
              <span class="menu-title">Project</span>
            </a>
          </li>
        </ul>
      </nav>