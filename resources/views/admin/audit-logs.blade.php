@include('admin.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('admin.layout.navbar')

    @include('admin.layout.sidebar')

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
              <h3 class="card-title" style="font-size: 2em">Dentist's List</h3>
              <!-- Add New Account Button -->
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>Full Name</th>
                          <th>Time of Login</th>
                          <th>Time of Logout</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($logs as $log)
                          <tr>
                              <td>{{ $log->user->full_name }}</td> <!-- Access to user relationship -->
                              <td>{{ \Carbon\Carbon::parse($log->created_at)->format('F j, Y - g:ia') }}</td>
                              <td>
                                  @if ($log->created_at->ne($log->updated_at)) <!-- Check if created_at and updated_at are different -->
                                      {{ \Carbon\Carbon::parse($log->updated_at)->format('F j, Y - g:ia') }}
                                  @else
                                      <!-- Show a placeholder or nothing if they are the same -->
                                      -
                                  @endif
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('admin.layout.footer')
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
