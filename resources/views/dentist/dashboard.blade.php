@include('dentist.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('dentist.layout.navbar')

    @include('dentist.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dentist Dashboard</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
    
            <!-- Welcome Message Card -->
            <div class="card">
              <div class="card-body text-center">
                <h2>Welcome!</h2>
                <h1 class="display-4">{{ $dentistName }}</h1>
                <p>We are always striving to provide you with comprehensive service. You can view your daily schedule, Reach Patients Appointment at home!</p>
                <button class="btn btn-primary">View My Appointments</button>
              </div>
            </div>
            <!-- End of Welcome Message Card -->

            <!-- Status -->
            <div class="row mt-3">
              <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-info"><i class="fas fa-user-md"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Dentists</span>
                    <span class="info-box-number">{{$totalDentists}}</span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Patients</span>
                    <span class="info-box-number">{{$totalPatients}}</span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-warning"><i class="fas fa-calendar-plus"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">New Bookings</span>
                    <span class="info-box-number"></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of Status -->

            <!-- Upcoming Schedule -->
            <div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title">Today's Session</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped" id="sessionsTable">
                  <thead>
                    <tr>
                      <th>Session Title</th>
                      <th>Schedule Date</th>
                      <th>Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Loop through sessions data -->
                    
                      <tr>
                        <td></td>
                        <td></td>
                        <td>{</td>
                      </tr>
                  
                  </tbody>
                </table>
              </div>
            </div>
            <!-- End of Upcoming Schedule -->

        </div><!-- /.container-fluid -->
      </section>

      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    @include('dentist.layout.footer')
  </div>
</body>
</html>
