<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed; top: 0; height: 100vh; overflow-y: auto;">
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="{{ route('admin.dashboard') }}" class="d-block">Assistant Dashboard</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('assistant.dashboard') }}" class="nav-link {{ Route::is('assistant.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
          </a>
        </li>

        <!-- Appointment Request -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('assistant.appointment-request') }}" class="nav-link {{ Route::is('assistant.appointment-request') ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-check"></i> <!-- Changed to calendar-check -->
              <p>Appointment Requests</p>
          </a>
        </li>

        <!-- Pending Account -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('assistant.pending-account') }}" class="nav-link {{ Route::is('assistant.pending-account') ? 'active' : '' }}">
              <i class="nav-icon fas fa-clock"></i> <!-- Changed to clock -->
              <p>Pending Accounts</p>
          </a>
        </li>

        <!-- Add Session -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('assistant.session') }}" class="nav-link {{ Route::is('assistant.session') ? 'active' : '' }}">
            <i class="nav-icon fas fa-plus"></i>
              <p>Add Session</p>
          </a>
        </li>

        <!-- Service -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('assistant.service') }}" class="nav-link {{ Route::is('assistant.service') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cogs"></i>
              <p>Add Service</p>
          </a>
        </li>

        <!-- Patient -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('assistant.patient') }}" class="nav-link {{ Route::is('assistant.patient') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Patient</p>
          </a>
      </li>

        <!-- Settings -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('assistant.settings') }}" class="nav-link {{ Route::is('assistant.settings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i> <!-- Changed to cog -->
              <p>Settings</p>
          </a>
        </li>

        <!-- Logout -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('assistant.logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>LOGOUT</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>
