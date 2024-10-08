@include('patient.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('patient.layout.navbar')

    @include('patient.layout.sidebar')

    <!-------------------------------------- Main content ---------------------------------------->

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="font-size: 2em">Appointment List</h3>
              <!-- Add New Account Button -->
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addAccountModal">
                Add Appointment
              </button>
            </div>
            <div class="card-body">
              <table id="dentistTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Appointment Date</th>
                    <th>Doctor</th>
                    <th>Event</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>July 5, 2024</td>
                      <td>Doctor Yappy</td>
                      <td>Dermatology</td>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('patient.layout.footer')
  </div>

  <!-- Include DataTables CSS and JS -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

  <!-- Include Bootstrap JS for Modal -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $(function () {
      $("#dentistTable").DataTable({
        responsive: true,
        autoWidth: false,
      });
    });
  </script>

  <!----Sweet Alert---->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      @if (session('success'))
          Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: '{{ session('success') }}',
              confirmButtonText: 'OK'
          });
      @endif

      @if (session('error'))
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: '{{ session('error') }}',
              confirmButtonText: 'Try Again'
          });
      @endif
  });
</script>
</body>
</html>
