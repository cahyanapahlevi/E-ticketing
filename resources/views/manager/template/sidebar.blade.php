<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="{{asset('source/images/faces/face1.jpg')}}" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{\Session::get('name')}}</p>
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
          <li class="nav-item">
            <a class="nav-link" href="{{url('/manager/ticket')}}">
              <i class="menu-icon mdi mdi-ticket"></i>
              <span class="menu-title">Ticket</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/manager/report')}}">
              <i class="menu-icon fa fa-archive"></i>
              <span class="menu-title">Report</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/manager/user')}}">
              <i class="menu-icon fa fa-user-o"></i>
              <span class="menu-title"> user</span>
            </a>
          </li>
        </ul>
      </nav>