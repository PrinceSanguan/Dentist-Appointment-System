@include('admin.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('admin.layout.navbar')

    @include('admin.layout.sidebar')

    <!-------------------------------------- Main content ---------------------------------------->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Admin Dashboard</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="row">

        <!-- Total Patient Account -->
        <div class="col-lg-6 col-6">
          <!-- small card -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalPatients}}</h3>
              <p>Total Patient Account</p>
            </div>
            <div class="icon">
              <i class="fas fa-procedures"></i> <!-- Changed icon to reflect patients -->
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Total Dentist Account -->
        <div class="col-lg-6 col-6">
          <!-- small card -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>5</h3>
              <p>Total Dentist Account</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-md"></i> <!-- Changed to doctor icon -->
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Total Pending Account -->
        <div class="col-lg-6 col-6">
          <!-- small card -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>5</h3>
              <p>Total Pending Account</p>
            </div>
            <div class="icon">
              <i class="fas fa-hourglass-half"></i> <!-- Changed to hourglass for pending -->
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Total Assistant Account -->
        <div class="col-lg-6 col-6">
          <!-- small card -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>5</h3>
              <p>Total Assistant Account</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-nurse"></i> <!-- Changed to assistant/nurse icon -->
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

      </div>
    </div>
    <!-------------------------------------- Main content ---------------------------------------->

  @include('admin.layout.footer')
</body>
</html>
