<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed; top: 0; height: 100vh; overflow-y: auto;">
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="{{route('admin.dashboard')}}" class="d-block">Patient Dashboard</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('patient.dashboard') }}" class="nav-link {{ Route::is('patient.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
          </a>
        </li>

        <!-- My Appointment -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('patient.appointment') }}" class="nav-link {{ Route::is('patient.appointment') ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>Book an Appointment</p>
          </a>
        </li>

        {{-- <!-- My Session -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('patient.session') }}" class="nav-link {{ Route::is('patient.session') ? 'active' : '' }}">
              <i class="nav-icon fas fa-clock"></i>
              <p>My Session</p>
          </a>
        </li> --}}

        <!-- Concern -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('patient.concern') }}" class="nav-link {{ Route::is('patient.concern') ? 'active' : '' }}">
              <i class="nav-icon fas fa-comment-medical"></i>
              <p>Concern</p>
          </a>
        </li>

        <!-- Dentist -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('patient.dentist') }}" class="nav-link {{ Route::is('patient.dentist') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-md"></i>
              <p>Dentist</p>
          </a>
        </li>

        <!-- Settings -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('patient.settings') }}" class="nav-link {{ Route::is('patient.settings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>Settings</p>
          </a>
        </li>
        
        <!-- Logout -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
            <a href="{{ route('patient.logout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>LOGOUT</p>
            </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>