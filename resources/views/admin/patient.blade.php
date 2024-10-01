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
              <h3 class="card-title" style="font-size: 2em">Patient List</h3>
            </div>
            <div class="card-body">
              <table id="patientTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Patient Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($patients as $patient)
                    <tr>
                      <td>{{ $patient->full_name }}</td>
                      <td>{{ $patient->email }}</td>
                      <td>{{ $patient->status }}</td>
                      <td>
                        <a href="{{-- {{ route('patients.view', $patient->id) }} --}}" class="btn btn-success">View</a>
                        <form action="{{ route('admin.patient-delete', $patient->id) }}" method="post" style="display:inline;">
                          @csrf
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this patient?');">Delete</button>
                        </form>
                      </td>
                        <td>
                          <form action="{{ route('admin.update-status', ['id' => $patient->id]) }}" method="post">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn {{ $patient->status == 'active' ? 'btn-success' : 'btn-danger' }}">
                                {{ $patient->status == 'active' ? 'Active' : 'Inactive' }}
                            </button>
                          </form>
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
    <!-------------------------------------- Main content ---------------------------------------->

    @include('admin.layout.footer')
  </div>

  <!-- Include DataTables CSS and JS -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

  <script>
    $(function () {
      $("#patientTable").DataTable({
        responsive: true,
        autoWidth: false,
      });
    });
  </script>
</body>
</html>
