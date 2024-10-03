@include('patient.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('patient.layout.navbar')

    @include('patient.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Patient Dashboard</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- Row for info boxes -->
          <div class="row">
            <!-- Appointment Info -->
            <div class="col-lg-4 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>Next Appointment</h3>
                  <p>You have no appointment</p>
                </div>
                <div class="icon">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <a href="#" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <!-- Recent Medical History -->
            <div class="col-lg-4 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>Medical History</h3>
                  <p>Last Visit: Sept 2024</p>
                </div>
                <div class="icon">
                  <i class="fas fa-file-medical"></i>
                </div>
                <a href="#" class="small-box-footer">View History <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <!-- Profile Info -->
            <div class="col-lg-4 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>Your Profile</h3>
                  <p>Update your information</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-edit"></i>
                </div>
                <a href="#" class="small-box-footer">Edit Profile <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <!-- End of row for info boxes -->

          <!-- Welcome Message Card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Welcome, {{$patientName}}!</h3>
            </div>
            <div class="card-body">
              <p>
                Welcome to <strong>R.L Dental Clinic</strong>! Here, we believe in the power of a confident smile. Our state-of-the-art 
                facilities, combined with a warm and welcoming atmosphere, ensure that your visit is as pleasant as it is effective.
                We're not just about fixing teeth; we're about creating lasting relationships and empowering you with a smile that lights up the room.
              </p>
              <p>
                On this dashboard, you can:
                <ul>
                  <li>View your next appointment details</li>
                  <li>Access your medical history</li>
                  <li>Update your personal information</li>
                  <li>Contact your dentist or clinic staff for any assistance</li>
                </ul>
              </p>
            </div>
          </div>
          <!-- End of Welcome Message Card -->

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    @include('patient.layout.footer')
  </div>
</body>
</html>
