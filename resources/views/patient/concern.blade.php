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
            <div class="col-sm-6">
              <h1 class="m-0">Concern Box</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Raise a Concern</h5>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('patient.concern-input')}}" id="concernForm">
                  @csrf
                  <div class="form-group">
                    <label for="title">Concern Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit Concern</button>
                </form>
                <div id="responseMessage" class="mt-3"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Previous Concerns</h5>
              </div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Admin Reply</th>
                    </tr>
                  </thead>
                  <tbody id="concernsList">
                    @foreach ($concerns as $concern)
                        <tr>
                            <td>{{ $concern->title }}</td>
                            <td>{{ $concern->description }}</td>
                            <td>
                                @if ($concern->status === 'open')
                                    <span style="color: green; font-weight: bold;">OPEN</span>
                                @elseif ($concern->status === 'close')
                                    <span style="color: red; font-weight: bold;">CLOSED</span>
                                @else
                                    {{ strtoupper($concern->status) }} <!-- Fallback for other statuses -->
                                @endif
                            </td>
                            <td>{{ $concern->created_at->format('F j, Y \a\t g:ia') }}</td>
                            <td>{{ $concern->reply }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-------------------------------------- Main content ---------------------------------------->

    @include('patient.layout.footer')
  </div>

  <!-- Include DataTables CSS and JS -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/DataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

  <!-- Include Bootstrap JS for Modal -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

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