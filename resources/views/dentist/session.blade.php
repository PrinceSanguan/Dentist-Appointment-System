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
              <h1 class="m-0">My Sessions</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 text-right">
              <!-- Add Session Button -->
              <button class="btn btn-primary" data-toggle="modal" data-target="#addSessionModal">
                <i class="fas fa-plus"></i> Add Session
              </button>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Session Title</th>
                    <th>Schedule Date</th>
                    <th>Number of Join</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                @foreach ($sessions as $session)
                    <tr>
                      <td>{{$session->session_title}}</td>
                      <td>{{ \Carbon\Carbon::parse($session->schedule_date)->format('F j, Y') }}</td>
                      <td>{{ $session->memberCount() }}</td>
                      <td>
                        <button class="btn btn-info" onclick="viewSession()">
                          <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-danger" onclick="cancelSession()">
                          <i class="fas fa-times"></i> Cancel
                        </button>
                      </td>
                    </tr>
                @endforeach
                    

                </tbody>
              </table>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      <!-- Add Session Modal -->
      <div class="modal fade" id="addSessionModal" tabindex="-1" role="dialog" aria-labelledby="addSessionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addSessionModalLabel">Add Session</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('dentist.add-session')}}" method="post">
              @csrf
              <div class="modal-body">
                <div class="form-group">
                  <label for="session_title">Session Title</label>
                  <input type="text" class="form-control" id="session_title" name="session_title" required>
                </div>
                <div class="form-group">
                  <label for="schedule_date">Schedule Date</label>
                  <input type="date" class="form-control" id="schedule_date" name="schedule_date" required min="{{ now()->addDay()->toDateString() }}">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Session</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
    <!-- /.content-wrapper -->

    @include('dentist.layout.footer')
  </div>
  <script>
    function viewSession(sessionId) {
      // Implement view logic here
      alert('Viewing session ' + sessionId);
    }

    function cancelSession(sessionId) {
        // Implement cancel logic here
        if (confirm('Are you sure you want to cancel this session?')) {
          // Proceed with cancellation (e.g., AJAX request or form submission)
          alert('Session ' + sessionId + ' cancelled.');
        }
    }
  </script>

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
