<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed; top: 0; height: 100vh; overflow-y: auto;">
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="{{route('admin.dashboard')}}" class="d-block">Dentist Dashboard</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('dentist.dashboard') }}" class="nav-link {{ Route::is('dentist.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Home</p>
          </a>
        </li>

        <!-- My Appointment -->
{{--         <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="" class="nav-link ">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>My Appointment</p>
          </a>
        </li> --}}

        <!-- My Session -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('dentist.session') }}" class="nav-link {{ Route::is('dentist.session') ? 'active' : '' }}">
              <i class="nav-icon fas fa-clock"></i>
              <p>My Session</p>
          </a>
        </li>

        <!-- My Patient -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('dentist.patient') }}" class="nav-link {{ Route::is('dentist.patient') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>My Patient</p>
          </a>
        </li>

        <!-- Settings -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('dentist.settings') }}" class="nav-link {{ Route::is('dentist.settings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>Settings</p>
          </a>
        </li>
        
        <!-- Logout -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
            <a href="{{ route('dentist.logout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>LOGOUT</p>
            </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
