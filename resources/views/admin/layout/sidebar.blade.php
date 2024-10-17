<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="{{route('admin.dashboard')}}" class="d-block">Admin Dashboard</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  
        {{--  <li class="nav-header" style="font-size: 1.2em; color: yellow;">FOR ACTIVATION</li> --}}

        <!-- Dashboard -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                  Dashboard
              </p>
          </a>
        </li>
  
        <!-- Dentist -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
            <a href="{{ route('admin.dentist') }}" class="nav-link {{ Route::is('admin.dentist') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-md"></i>
                <p>
                    Dentist
                </p>
            </a>
        </li>

        <!-- Patients -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
            <a href="{{ route('admin.patient') }}" class="nav-link {{ Route::is('admin.patient') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Patients
                </p>
            </a>
        </li>

        <!-- Assistant -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
            <a href="{{ route('admin.assistant') }}" class="nav-link {{ Route::is('admin.assistant') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-nurse"></i>
                <p>
                    Assistant
                </p>
            </a>
        </li>

        <!-- Audit Logs -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
            <a href="{{ route('admin.audit-logs') }}" class="nav-link {{ Route::is('admin.audit-logs') ? 'active' : '' }}">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                    Audit Logs
                </p>
            </a>
        </li>

        <!-- Concern -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
            <a href="{{ route('admin.concern') }}" class="nav-link {{ Route::is('admin.concern') ? 'active' : '' }}">
                <i class="nav-icon fas fa-exclamation-triangle"></i> <!-- Updated icon -->
                <p>
                    Concern
                </p>
            </a>
        </li>

        <!-- Appointment -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
            <a href="{{ route('admin.appointment') }}" class="nav-link {{ Route::is('admin.appointment') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-check"></i>
                <p>
                    Appointment
                </p>
            </a>
        </li>

        <!-- Settings -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
            <a href="{{ route('admin.settings') }}" class="nav-link {{ Route::is('admin.settings') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>Settings</p>
            </a>
        </li>

        <!-- Logout -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
            <a href="{{ route('logout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    LOGOUT
                </p>
            </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>
