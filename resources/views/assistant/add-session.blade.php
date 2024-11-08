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
              <h1 class="m-0">Add Session</h1>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSessionModal">
            Add Session
        </button>

        <table id="sessionTable" class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th>User</th>
                  <th>Session Title</th>
                  <th>Schedule Date</th>
                  <th>Remaining Slot</th>
                  <th>Price</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($appointmentSessions as $session)
              <tr>
                  <td>{{ $session->user->full_name }}</td>
                  <td>{{ $session->session_title }}</td>
                  <td>{{ \Carbon\Carbon::parse($session->schedule_date)->format('F j, Y') }}</td>
                  <td>{{ $session->number_of_member  }}</td>
                  <td>₱{{ $session->price }}.00</td>
                  <td>
                    <!-- The 'View' button triggers the modal, we pass the session ID -->
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewMembersModal" onclick="setModalContent({{ $session->id }})">
                        <i class="fas fa-eye"></i> View
                    </button>
                    <form action="{{route('assistant.cancel-session')}}" method="post" style="display:inline;">
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

        <!-- Add Session Modal -->
          <div class="modal fade" id="addSessionModal" tabindex="-1" aria-labelledby="addSessionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSessionModalLabel">Add Session</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('assistant.add-session') }}">
                      @csrf
                      <div class="modal-body">
                          <div class="mb-3">
                              <label for="dentist" class="form-label">Dentist</label>
                              <select class="form-control" id="user_id" name="user_id" required>
                                  <option selected disabled>Select Dentist</option>
                                  @foreach($dentists as $dentist)
                                      <option value="{{ $dentist->id }}">{{ $dentist->full_name }}</option>
                                  @endforeach
                              </select>
                          </div>
      
                          <div class="mb-3">
                              <label for="sessionTitle" class="form-label">Session Title</label>
                              <select class="form-control" id="sessionTitle" name="session_title" required>
                                  <option selected disabled>Select Session Title</option>
                                  @foreach($services as $service)
                                      <option value="{{ $service->service }}" data-price="{{ $service->price }}">{{ $service->service }}</option>
                                  @endforeach
                              </select>
                          </div>
      
                          <div class="mb-3">
                              <label for="price" class="form-label">Price</label>
                              <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" readonly>
                          </div>
      
                          <div class="mb-3">
                              <label for="schedule_date" class="form-label">Schedule Date</label>
                              <input type="date" class="form-control" id="schedule_date" name="schedule_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                          </div>
      
                          <div class="mb-3">
                              <label for="number_of_member" class="form-label">Number of Join</label>
                              <input type="number" min="1" max="19" class="form-control" id="number_of_member" name="number_of_member" required pattern="[0-9]+">
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </form>
                </div>
            </div>
          </div>
          <!-- Add Session Modal../ -->


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
          <!-- Modal for Viewing Members ../-->
        
        </div>
      </section>
    </div>

    @include('assistant.layout.footer')
    
  </div>

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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sessionTitleSelect = document.getElementById('sessionTitle');
        const priceInput = document.getElementById('price');

        sessionTitleSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.dataset.price;
            priceInput.value = price;
        });
    });
</script>

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

  <!-- Include DataTables CSS and JS -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

  <script>
    $(function () {
      $("#sessionTable").DataTable({
        responsive: true,
        autoWidth: false,
      });
    });
  </script>

</body>
</html>
