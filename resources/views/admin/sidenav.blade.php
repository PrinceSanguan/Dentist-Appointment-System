<table class="menu-container" border="0">
  <tr>
      <td style="padding:10px" colspan="2">
          <table border="0" class="profile-container">
              <tr>
                  <td width="30%" style="padding-left:20px" >
                      <img src="../img/admin1.png" alt="" width="100%" style="border-radius:50%">
                  </td>
                  <td style="padding:0px;margin:0px;">
                      
                      <p class="profile-title">Administrator</p>
                      <p class="profile-subtitle">admin@smileslot.com</p>
                  </td>
              </tr>
              <tr>
                  <td colspan="2">
                      <a href="{{route('logout')}}" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                  </td>
              </tr>
      </table>
      </td>
  </tr>

        <tr class="menu-row">
            <td class="menu-btn menu-icon-dashbord
                @if(Route::currentRouteName() === 'admin.dashboard') menu-active menu-icon-dashbord-active @endif">
                <a href="{{ route('admin.dashboard') }}" class="non-style-link-menu 
                    @if(Route::currentRouteName() === 'admin.dashboard') non-style-link-menu-active @endif">
                    <div><p class="menu-text">Dashboard</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor 
                @if(Route::currentRouteName() === 'admin.dentist') menu-active @endif">
                <a href="{{ route('admin.dentist') }}" class="non-style-link-menu 
                    @if(Route::currentRouteName() === 'admin.dentist') non-style-link-menu-active @endif">
                    <div><p class="menu-text">Dentists</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-schedule
                @if(Route::currentRouteName() === 'admin.schedule') menu-active @endif">
                <a href="{{ route('admin.schedule') }}" class="non-style-link-menu 
                    @if(Route::currentRouteName() === 'admin.schedule') non-style-link-menu-active @endif">
                    <div><p class="menu-text">Schedule</p></div>
                </a>
            </td>
        </tr>

        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment
                @if(Route::currentRouteName() === 'admin.appointment') menu-active @endif">
                <a href="{{ route('admin.appointment') }}" class="non-style-link-menu 
                    @if(Route::currentRouteName() === 'admin.appointment') non-style-link-menu-active @endif">
                    <div><p class="menu-text">Appointment</p></div>
                </a>
            </td>
        </tr>

        <tr class="menu-row">
            <td class="menu-btn menu-icon-patient
                @if(Route::currentRouteName() === 'admin.patient') menu-active @endif">
                <a href="{{ route('admin.patient') }}" class="non-style-link-menu 
                    @if(Route::currentRouteName() === 'admin.patient') non-style-link-menu-active @endif">
                    <div><p class="menu-text">Patients</p></div>
                </a>
            </td>
        </tr>
</table>