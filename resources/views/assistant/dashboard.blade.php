@include('assistant.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('assistant.layout.navbar')

    @include('assistant.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Assistant Dashboard</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- Total Pending Account -->
          <div class="col-lg-12 col-12">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner" style="padding: 20px;"> <!-- Added padding -->
                <h3>{{$pendingAccount}}</h3>
                <p>Total Pending Account</p>
              </div>
              <div class="icon">
                <i class="fas fa-hourglass-half"></i> <!-- Hourglass for pending -->
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- end of Total Pending Account -->

          <!-- Total Appointment Request -->
          <div class="col-lg-12 col-12">
            <!-- small card -->
            <div class="small-box bg-info"> <!-- Changed background color -->
              <div class="inner" style="padding: 20px;"> <!-- Added padding -->
                <h3>{{$pendingAppointment}}</h3>
                <p>Total Appointment Requests</p> <!-- Fixed typo -->
              </div>
              <div class="icon">
                <i class="fas fa-calendar-alt"></i> <!-- Changed to calendar icon -->
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- end of Total Appointment Request -->

        </div><!-- /.container-fluid -->
      </section>

      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    @include('assistant.layout.footer')
  </div>
</body>
</html>
