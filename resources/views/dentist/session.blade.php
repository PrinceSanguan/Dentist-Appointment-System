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
                        <tbody>
                            @foreach ($sessions as $session)
                            <tr>
                                <td>{{ $session->session_title }}</td>
                                <td>{{ \Carbon\Carbon::parse($session->schedule_date)->format('F j, Y') }}</td>
                                <td>{{ $session->memberCount() }}</td>
                                <td>
                                    <!-- The 'View' button triggers the modal, we pass the session ID -->
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewMembersModal" onclick="setModalContent({{ $session->id }})">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <form action="{{ route('dentist.cancel-session') }}" method="POST" style="display:inline;">
                                      @csrf
                                      <input type="hidden" name="session_id" value="{{ $session->id }}">
                                      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this session?')">
                                          <i class="fas fa-times"></i> Cancel
                                      </button>
                                    </form>
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

<!-- Modal for Viewing Members -->
<div class="modal fade" id="viewMembersModal" tabindex="-1" aria-labelledby="viewMembersModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewMembersModalLabel">Members Joined</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody id="members-table-body">
            <!-- Members will be dynamically loaded here -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    @include('dentist.layout.footer')
  </div>

  <script>
    // Pass the session data from PHP to JavaScript
    const sessions = @json($sessions);

    function setModalContent(sessionId) {
        // Clear the current table body
        const membersTableBody = document.getElementById('members-table-body');
        membersTableBody.innerHTML = '';

        // Find the session by its ID
        const session = sessions.find(s => s.id === sessionId);

        if (session && session.members.length > 0) {
            // Loop through each member and add a row to the table
            session.members.forEach(member => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${member.user.full_name}</td>
                    <td>${member.user.email}</td>
                `;
                membersTableBody.appendChild(row);
            });
        } else {
            // If no members, display a message
            const emptyRow = document.createElement('tr');
            emptyRow.innerHTML = '<td colspan="2">No members joined</td>';
            membersTableBody.appendChild(emptyRow);
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
